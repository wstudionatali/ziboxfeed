<?php
/* ----- Start of subsidiary functions  block------*/
/* get data from the table zibox_categories to render in page zi-box settings 
return $ziboxcategories - object id, zi_category_name, active
*/
class ZiboxHelper {
public static function get_ziboxcats ()
{
global $wpdb;
$table = $wpdb->prefix.'zibox_categories';
$ziboxcategories = $wpdb->get_results( "SELECT * FROM $table" );
return $ziboxcategories;
}

/* get data from the table zibox_categories to to upload
return $zibox_activ_cats - object id, zi_category_name, active
*/
public static function get_active_ziboxcats ()
{
global $wpdb;
$table = $wpdb->prefix.'zibox_categories';
$zibox_activ_cats = $wpdb->get_results( "SELECT * FROM ".$table." WHERE active = 1" );
return $zibox_activ_cats;
}
/* array cat: name, id, level, parent_id - zibox-data, $parent_id- parent term id, $updated_term_id is term_id  to uddate data  */ 
public static function cat_branch_insert ($parent_id, $cat, $updated_term_id = NULL) {
/* sanitize string name and num id before updating or inserting*/
$san_zi_cat_name = filter_var($cat['name'], FILTER_SANITIZE_STRING);
$san_zi_cat_id = (int)$cat['id']; 
 
  if (is_null($updated_term_id)) {
      $insert_data = wp_insert_term (
        $san_zi_cat_name,
        'product_cat',
           array (
             'description' => '',
             'parent' => (int) $parent_id,
			
		 ));
/*add zibox categ. id in termmete table */	
 if ( is_wp_error( $insert_data ) ) { 
			 zibox_log('Zibox cat was not inserted', $cat );
			 zibox_log('Sorry, there has been an error ', esc_html( $insert_data->get_error_message() ));		
  } else {

    $term_id = $insert_data['term_id'];
    $key='zibox_cat_id';
    $value =  $san_zi_cat_id;
    add_term_meta($term_id, wp_slash($key), (int)($value));	
	
       } 
	
  } else {
      wp_update_term( $updated_term_id->term_id, 'product_cat', array(
	      'name'   =>  $san_zi_cat_name,
	      'parent' => (int) $parent_id,
		
         ));
	   }    
}
/* inserting or updating attributes and there values*/
public static function insert_attr_values ($zibox_charact, $cats, $attr_id = 0, $old_slug = "") {
/* sanitize string name and num id before updating or inserting*/
$san_zi_charact_name = filter_var($zibox_charact['name'], FILTER_SANITIZE_STRING);
$san_zi_charact_id = (int)$zibox_charact['id']; 

  global $wpdb;
  $table = $wpdb->prefix.'term_taxonomy';
  $table1 = $wpdb->prefix.'terms';
  $table2 = $wpdb->prefix.'woocommerce_attribute_taxonomies';  
  /* updating*/
  if (strlen ($san_zi_charact_name) > 20) {
  $sl= wc_sanitize_taxonomy_name(mb_strimwidth($san_zi_charact_name, 0, 20, ' '.$san_zi_charact_id)); 
  } else { $sl=wc_sanitize_taxonomy_name($san_zi_charact_name.' '.$san_zi_charact_id); }
     $args = array (
  'id' => $attr_id,
  'name' => $san_zi_charact_name,
  'slug' => $sl,
  'old_slug' => $old_slug
     );
     $newattr_id = wc_create_attribute( $args );

	
	 if ( is_wp_error( $newattr_id ) ) { return $newattr_id;			
	} else { /*updating attr values 1.if values exist get them in array and match to $zibox_charact[values]*/
	$result = $wpdb->update( $table2,	array( 'cats' => $cats, 'zibox_attribute_id' => $san_zi_charact_id ),	array( 'attribute_id' => $newattr_id ),	array( '%s', '%d' ), array( '%d' )); 
	 $woo_attr = $wpdb->get_row( "SELECT * FROM ".$table2." WHERE attribute_id = ".$newattr_id);	
	   if (is_null($woo_attr)){
	   } else {
	  $slug = wc_attribute_taxonomy_name( $woo_attr->attribute_name ); 
    if (!$old_slug) {
      register_taxonomy(
		  $slug,
		  'product',
		  array(
				'labels'       => array(
					'name' => $woo_attr->attribute_name,
				),
				'hierarchical' => true,
				'show_ui'      => false,
				'query_var'    => true,
				'rewrite'      => false,
			)
		);
    }	  
  }
	   $attr_vals = $wpdb->get_results("SELECT ".$table1.".name AS val FROM ".$table." LEFT JOIN ".$table1." ON ".$table.".term_id = ".$table1.".term_id WHERE ".$table.".taxonomy = 'pa_".$slug."'");
	     if (is_null($attr_vals) or empty($attr_vals)) { $attr_vals = array(); /* no value exist*/ 
		 } else {
		 /*some values exist. transform array of objects $attr_vals in simple array*/
		      for ($i = 0; $i < count($attr_vals); $i++) {
		       $attr_vals[i] = $attr_vals[i]->val;}			   
			}
			
		   $zibox_charact_vals = $zibox_charact['variants'];		   
		   if (!empty($zibox_charact_vals)) {/*inserting  values*/
		      foreach ($zibox_charact_vals as $zibox_charact_val){
			 /* sanitize characteristic variant name before updating or inserting*/
           $san_zi_charact_variant = filter_var($zibox_charact_val, FILTER_SANITIZE_STRING); 
			  
			    if (!in_array($san_zi_charact_variant, $attr_vals)){ /* возможен ли поиск значения в пустом массиве? if zibox value is absent in woocpmmerse attribute values */ 
				 
		        $insert_data = wp_insert_term (
                  $san_zi_charact_variant,
                  $slug,
                     array (
                          'description' => '',            
                           'parent' => 0 ) 
		                  );						  
					   }
		           }
		    }		
	} 
  
 return $newattr_id;
}
	/*upload image by url in media library*/	
public static function upload_cat_img ($url) {	 
require_once( ABSPATH . "wp-includes/pluggable.php");
require_once( ABSPATH . 'wp-admin/includes/file.php');

$timeout_seconds = 5;
// загружаем файл во временную папку
$temp_file = download_url( $url, $timeout_seconds );
if( ! is_wp_error( $temp_file ) ){
	// соберем массив аналогичный $_FILE в PHP
	$file = array(
		'name'     => basename($url), // получит: wp-header-logo.png
		'type'     => 'image/png',
		'tmp_name' => $temp_file,
		'error'    => 0,
		'size'     => filesize($temp_file),
	);

	$overrides = array(
		// скажем WP не искать поля формы, которые обычно должны быть.
		// загружаем файл с удаленного сервера, поэтому полей формы нет.
		'test_form' => false,
	);

	// перемещаем временный файл в папку uploads
	$results = wp_handle_sideload( $file, $overrides );

	if( ! empty($results['error']) ){
		// Добавьте сюда обработчик ошибок
	}
	else {
		$filename = $results['file']; // полный путь до файла
		$local_url = $results['url']; // URL до файла в папке uploads
		$filetype = $results['type']; // MIME тип файла
	}
}
if( $results)  { 
// Получим путь до директории загрузок.
$wp_upload_dir = wp_upload_dir();

// Подготовим массив с необходимыми данными для вложения.
$attachment = array(
	'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
	'post_mime_type' => $filetype,
	'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
	'post_content'   => '',
	'post_status'    => 'inherit'
);

// Вставляем запись в базу данных.
$attach_id = wp_insert_attachment( $attachment, $filename);

// Подключим нужный файл, если он еще не подключен
// wp_generate_attachment_metadata() зависит от этого файла.
require_once( ABSPATH . 'wp-admin/includes/image.php' );

// Создадим метаданные для вложения и обновим запись в базе данных.
$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
wp_update_attachment_metadata( $attach_id, $attach_data );
}	 
return $attach_id;	
}
}


?>