<?php
/**
 *
 * @link              https://github.com/wstudionatali/ziboxfeed
 * @since             1.0.0
 * @package           WPHW
 *
 * @wordpress-plugin
 * Plugin Name:       ziboxfeed
 * Plugin URI:        https://github.com/wstudionatali/ziboxfeed
 * Description:       plugin for uploading zibox categories and attributes and building product xmlfeed for zibox
 * Version:           1.2.0
 * Author:            bcat
 * Author URI:        https://bcat.tech/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly.*/
}
define('ZIBOX_VERSION', '1.2.0' );
define('ZIBOX_PATH', realpath( dirname(__FILE__) ) );
define('ZIBOX_URL', plugins_url() . '/' . basename(dirname(__FILE__)) . '/' );
/* Activate logger*/
require_once ZIBOX_PATH . '/includes/zibox-logger.php';

require_once ZIBOX_PATH . '/includes/class-walker-category-checklist-disableparents.php';
require_once ZIBOX_PATH . '/includes/zibox-api-exporter.php';
require_once ZIBOX_PATH . '/prouct_edit_page.php';
 $api_url = get_option( 'api_url', $default = "http://api.marketplace.prod.ziboxtech.com" );
 $file_name = get_option( 'xml_file_name', $default = "product" );
 $exporter = new ZiboxApiExporter($api_url);
 $myfilename = ZIBOX_PATH . '/logs/error.log';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_zibox() {
    require_once ZIBOX_PATH . '/includes/class-zibox-activator.php';
    Zibox_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_zibox() {
    require_once ZIBOX_PATH . '/includes/class-zibox-deactivator.php';
    Zibox_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_zibox' );
register_deactivation_hook( __FILE__, 'deactivate_zibox' );

/*github updater*/

add_action( 'init', 'github_ziboxfeed_plugin_updater' );
function github_ziboxfeed_plugin_updater() {

	include_once ( ZIBOX_PATH . '/includes/updater.php');

	define( 'WP_GITHUB_FORCE_UPDATE', true );

	if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

		$config = array(                
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'ziboxfeed',
			'api_url' => 'https://api.github.com/repos/wstudionatali/ziboxfeed',
			'raw_url' => 'https://raw.github.com/wstudionatali/ziboxfeed/main',
			'github_url' => 'https://github.com/wstudionatali/ziboxfeed',
			'zip_url' => 'https://github.com/wstudionatali/ziboxfeed/archive/main.zip',
			'sslverify' => true,
			'requires' => '5.6.1',
			'tested' => '5.6.1',
			'readme' => 'README.md',
			'access_token' => '',
		);

		new WP_GitHub_Updater( $config );

	}

}
	
/* ADD page for zi-box settings
*/
add_action('admin_menu', 'ziboxfeed_admin_menu');
function ziboxfeed_admin_menu() {
global $menu;
  add_menu_page(
        'Zi-box xml feed',/* page title*/
        'Zi-box feed',/* menu title*/
        'manage_options',/* capability*/
        'zi_box',/* menu slug*/
        'display_ziboxfeed_page' /* callback function*/
    );
}

function display_ziboxfeed_page() {
global $exporter;
global $myfilename;
$ziboxcategories=get_ziboxcats();
foreach ($ziboxcategories as $ziboxcategory ) {
$subcats[$ziboxcategory->id] = $exporter->get_cat_branch_array($ziboxcategory->id);
array_shift($subcats[$ziboxcategory->id]);
}

			include( ZIBOX_PATH . '/views/zibox-settings.php' );
			
}
add_action( 'admin_enqueue_scripts', 'zibox_page_style' );
function zibox_page_style(){
	wp_register_style( 'zi_box_style', ZIBOX_URL.'css/style.css', array(), ZIBOX_VERSION );
			wp_enqueue_style( 'zi_box_style' );
		
}
/* create options for plugin */
add_action( 'admin_init', 'zibox_settings_init' );

function zibox_settings_init() {

    add_settings_section(
        'zibox_page_setting_section',
        __( 'Custom settings', 'zibox_textdomain' ),
        'zibox_setting_section_callback_function',
        'zi_box'
    );

		add_settings_field(
		   'xml_file_name',
		   __( 'XML file name', 'zibox_textdomain' ),
		   'zibox_setting_markup_xml',
		   'zi_box',
		   'zibox_page_setting_section'
		);
		
		add_settings_field(
		   'api_url',
		   __( 'API URL', 'zibox_textdomain' ),
		   'zibox_setting_markup_url',
		   'zi_box',
		   'zibox_page_setting_section'
		);

		register_setting( 'zi_box', 'xml_file_name' );
		register_setting( 'zi_box', 'api_url' );
}


function zibox_setting_section_callback_function() {
    echo '<p>(Zibox settings section)</p>';
}


function zibox_setting_markup_xml() {
    ?>
    <label for="my-input"><?php _e( 'Please name you xml file like product-your-shop-name' ); ?></label>
    <input type="text" id="xml_file_name" name="xml_file_name" value="<?php echo get_option( 'xml_file_name' ); ?>">
	
    <?php
}
function zibox_setting_markup_url() {
    ?>
	<label for="my-input"><?php _e( 'Please put here API url' ); ?></label>
    <input type="text" id="api_url" name="api_url" value="<?php echo get_option( 'api_url' ); ?>" placeholder="http://api.marketplace.prod.ziboxtech.com">
	<div>Copy and paste one of these: http://api.marketplace.prod.ziboxtech.com  </div>
    <?php
}


/* build xml product feed for zibox*/
add_action( 'init', function(){
add_feed( 'xmlproductfeed', 'xmlproductfeed_markup' );
add_feed( 'xmlproductfile', 'xmlproductfile_markup' );

});

function xmlproductfeed_markup(){
 include( ZIBOX_PATH . '/views/xmlproductfeed.php' );	
	exit;
}
function xmlproductfile_markup(){
global $file_name;
 include( ZIBOX_PATH . '/views/xmlproductfile.php' );	
	exit;
}

/* insert/update data to the table zibox_categories*/
add_action( 'admin_action_updatelist', 'updatelist_admin_action', 10 );
function updatelist_admin_action()
{
global $wpdb;
global $exporter;
if(isset($_POST['submit_updatelist'])){

$ziboxcats = $exporter->get_parsed_ziboxcats_ar();

$table = $wpdb->prefix.'zibox_categories';
$format = array('%d', '%s');

 foreach ($ziboxcats as $key => $ziboxcat) {
    $id = $wpdb->get_var( "SELECT id FROM $table WHERE id = {$ziboxcat['id']}");
	
  if ( $id ) {
          $data = array (
           'zi_category_name' => $ziboxcat['cat_name']
            );
	 $result = $wpdb->update( $table, $data, array( 'id' => $id ) );
			if ($result) zibox_log("updated existing table zibox categories - id", $id);
  } else {
	   $data = array (
            'id' => $ziboxcat['id'],
            'zi_category_name' => $ziboxcat['cat_name']
            );
        $result = $wpdb->insert( $table, $data, $format );
			$tpl_id = $wpdb->insert_id;

			 if ( ! $result ) {
				zibox_log("Failed to store field {$key} - MySQL result: ".print_r($result,1));
				zibox_log("Field data : ".print_r($ziboxcat,1));
				zibox_log("MySQL query: ".print_r($wpdb->last_query,1));
				zibox_log("MySQL error: ".print_r($wpdb->last_error,1));
			} 	else { zibox_log("added new zi-box category - id = ",  $ziboxcat['id']);}
     }	 
   }	   
  }
   wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}
/* check categories to work with. 
Save cheks in table zibox_categories.
Upload/update all checked categories and their children in woocommerce product categories */
add_action( 'admin_action_catslist', 'catslist_admin_action', 11 );
function catslist_admin_action()
{
  global $wpdb;
  global $exporter;
  $table1 = $wpdb->prefix.'zibox_categories';
  $table2 = $wpdb->prefix.'termmeta';
  if(isset($_POST['submit_cats'])){
        $mycat_ids = $_POST['mycat'];
 /*save categories as active*/
   foreach ($mycat_ids as $mycat_id) {
       $data = array (
           'active' => 1
            );    	
	  $result = $wpdb->update( $table1, $data, array( 'id' => $mycat_id ), array( '%d'), array( '%d') );

    }
/* Upload ziboxcats to woocommerce product categories. get cat branch array from zibox xml for id (loop for active cats)*/
   $zibox_active_cats=get_active_ziboxcats();
	
       foreach ($zibox_active_cats as  $zibox_active_cat) {
          $cat_branch = $exporter->get_cat_branch_array($zibox_active_cat->id);

	      foreach ($cat_branch as $cat) {
	       
            $parent_cat =  0; $woo_cat_id = NULL;	
            if ($cat['parent_id']) {     
               $parent_term =  $wpdb->get_row( "SELECT * FROM ".$table2." WHERE meta_key = 'zibox_cat_id' AND meta_value = ".$cat['parent_id'] );
	        
                if ($parent_term) {$parent_cat = $parent_term->term_id;} else {  zibox_log( "Category '".$cat['name']." zibox id=".$cat['id']."' is lost its parent in table term_taxonomy", "");
		        $parent_cat =  Null;		   
		        }
           } 
/*To avoid duplicates of inserting woocommerce categories, first check in TB termmeta and then insert or update. $wpdb->get_row('query') return NULL if empty query*/
           if (!is_null($parent_cat)) {
                 $woo_cat_id =  $wpdb->get_row( "SELECT * FROM ".$table2." WHERE meta_key = 'zibox_cat_id' AND meta_value = ".$cat['id'] );	   
                 cat_branch_insert ($parent_cat, $cat, $woo_cat_id);
            }
         } 
       }
  }
      wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit(); 
  
}
/* Upload/update attributes and values(options) */
add_action( 'admin_action_attrlist', 'attrlist_admin_action', 12 );
function attrlist_admin_action() {
 global $exporter;
 global $wpdb;
  $table2 = $wpdb->prefix.'woocommerce_attribute_taxonomies';
  $table3 = $wpdb->prefix.'termmeta';
  if(isset($_POST['submit_attributes'])){
 
  $zibox_characts = $exporter->get_zibox_characteristics();
  
    foreach ($zibox_characts as $zibox_charact) {
	 $zi_charact_cats = explode( ',', $zibox_charact['cats'] );
	 
	 
	   $i = 0;  $attr_cats = array();
	 /* replace array zi_charact_cats to term_ids woocommerce cats*/
       foreach ($zi_charact_cats as $zi_charact_cat) {
	   
	    $woo_cat =  $wpdb->get_row( "SELECT * FROM ".$table3." WHERE meta_key = 'zibox_cat_id' AND meta_value = ".$zi_charact_cat );
		
		if ($woo_cat) $attr_cats[$i] = $woo_cat->term_id;
		$i++;
       }
	   if (!empty($attr_cats)) {
	   $cats = serialize($attr_cats);	  
	   /* Check Does zibox charact. id present in TB woocommerce_attribute_taxonomies? */
	   $woo_attr =  $wpdb->get_row( "SELECT * FROM ".$table2." WHERE zibox_attribute_id = ".$zibox_charact['id']);
	 	   
	   if (is_null($woo_attr)) { /*inserting attribute and it`s values*/
	      
	   
	      $newattr_id = insert_attr_values ($zibox_charact, $cats);
		    if ( is_wp_error( $newattr_id ) ) { 
			 zibox_log('Attribute ', $zibox_charact['name'] );
			 zibox_log('Attribute id=', $zibox_charact['id'] );
			 zibox_log('Sorry, there has been an error ', esc_html( $newattr_id->get_error_message() ));			
	         }
	      } else { /*updating attrs and values*/
		  $attr_id = $woo_attr->attribute_id;
		  $old_slug = $woo_attr->attribute_name;
		  $newattr_id = insert_attr_values ($zibox_charact, $cats, $attr_id, $old_slug);
		    if ( is_wp_error( $newattr_id ) ) { 
			 zibox_log('Attribute ', $zibox_charact['name'] );
			 zibox_log('Attribute id=', $zibox_charact['id'] );
			 zibox_log('Sorry, there has been an error ', esc_html( $newattr_id->get_error_message() ));			
	         }		  
		  }
	   } 
     }
	   }
    wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}
/* test */
add_action( 'admin_action_images', 'images_admin_action', 13 );
function images_admin_action() {
if(isset($_POST['submit_images'])){
global $wpdb;
global $exporter;
$table2 = $wpdb->prefix.'termmeta';

  $zicats = $wpdb->get_results( "SELECT * FROM ".$table2." WHERE meta_key = 'zibox_cat_id'" );
 /*upload 5 images */
$k=1;
  if ($zicats) {
	 foreach ($zicats as $zicat) {
	    if ($k<6) {
			 /*check if category image exist. if do not exist upload it from zibox*/
		 $thumb_exist =  $wpdb->query( "SELECT * FROM " . $table2 . " WHERE meta_key = 'thumbnail_id' AND term_id = ".$zicat->term_id );
	
        if ($thumb_exist==0) {
		/*запросить данные категории с id=$zicat->meta_value*/
		   $getcat = $exporter->get_zibox_cat($zicat->meta_value);

			/*upload image from url $$getcat['icon_rectangle ']*/ 
		   $attach_id = upload_cat_img($getcat[0]['icon_rectangle']);
		  if ($attach_id){
            $key = 'thumbnail_id';
	        $value = $attach_id;
	        add_term_meta($zicat->term_id, wp_slash($key), (int)($value));
			$k++;
		  }
		 }
       }		
	 }
  }
}
	wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}
/*  */
add_action( 'admin_action_clean_log', 'clean_log_admin_action', 14 );
function clean_log_admin_action() {
if(isset($_POST['submit_clean_log'])){
global $myfilename;
file_put_contents($myfilename, "");
 }
  wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}


/* get data from the table zibox_categories to render in page zi-box settings 
return $ziboxcategories - object id, zi_category_name, active
*/
function get_ziboxcats ()
{
global $wpdb;
$table = $wpdb->prefix.'zibox_categories';
$ziboxcategories = $wpdb->get_results( "SELECT * FROM $table" );
return $ziboxcategories;
}

/* get data from the table zibox_categories to to upload
return $zibox_activ_cats - object id, zi_category_name, active
*/
function get_active_ziboxcats ()
{
global $wpdb;
$table = $wpdb->prefix.'zibox_categories';
$zibox_activ_cats = $wpdb->get_results( "SELECT * FROM ".$table." WHERE active = 1" );
return $zibox_activ_cats;
}


/* array cat: name, id, level, parent_id - zibox-data, $parent_id- parent term id, $updated_term_id is term_id  to uddate data  */ 
function cat_branch_insert ($parent_id, $cat, $updated_term_id = NULL) {
  if (is_null($updated_term_id)) {
      $insert_data = wp_insert_term (
        $cat['name'],
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
    $value =  $cat['id'];
    add_term_meta($term_id, wp_slash($key), (int)($value));	
	
       } 
	
  } else {
      wp_update_term( $updated_term_id->term_id, 'product_cat', array(
	      'name'   =>  $cat['name'],
	      'parent' => (int) $parent_id,
		
         ));
	   }    
}
/* inserting or updating attributes and there values*/
function insert_attr_values ($zibox_charact, $cats, $attr_id = 0, $old_slug = "") {
  global $wpdb;
  $table = $wpdb->prefix.'term_taxonomy';
  $table1 = $wpdb->prefix.'terms';
  $table2 = $wpdb->prefix.'woocommerce_attribute_taxonomies';  
  /* updating*/
  if (strlen ($zibox_charact['name']) > 20) {
  $sl= wc_sanitize_taxonomy_name(mb_strimwidth($zibox_charact['name'], 0, 20, ' '.$zibox_charact['id'])); 
  } else { $sl=wc_sanitize_taxonomy_name($zibox_charact['name'].' '.$zibox_charact['id']); }
     $args = array (
  'id' => $attr_id,
  'name' => $zibox_charact['name'],
  'slug' => $sl,
  'old_slug' => $old_slug
     );
     $newattr_id = wc_create_attribute( $args );
	 
	
	 
	 if ( is_wp_error( $newattr_id ) ) { return $newattr_id;
			
	} else { /*updating attr values 1.if values exist get them in array and match to $zibox_charact[values]*/
	$result = $wpdb->update( $table2,	array( 'cats' => $cats, 'zibox_attribute_id' => $zibox_charact['id'] ),	array( 'attribute_id' => $newattr_id ),	array( '%s', '%d' ), array( '%d' )); 
	 $woo_attr = $wpdb->get_row( "SELECT * FROM ".$table2." WHERE attribute_id = ".$newattr_id);
	
	
	   if (is_null($woo_attr)){
	   } else {
	  $slug = wc_attribute_taxonomy_name( $woo_attr->attribute_name );
         
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
			    if (!in_array($zibox_charact_val, $attr_vals)){ /* возможен ли поиск значения в пустом массиве? if zibox value is absent in woocpmmerse attribute values */ 
				 
		        $insert_data = wp_insert_term (
                  $zibox_charact_val,
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
function upload_cat_img ($url) {	 
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