<?php
/*---------Block admin actions-------------*/
/* admin_action - insert/update data to the table zibox_categories*/
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
	/* sanitize string name and num id before updating or inserting*/
	$san_zi_cat_name = filter_var($ziboxcat['cat_name'], FILTER_SANITIZE_STRING); 
	$san_zi_cat_id = (int)$ziboxcat['id']; 
 
    $id = $wpdb->get_var( "SELECT id FROM $table WHERE id = {$san_zi_cat_id}");

  if ( $id ) {
          $data = array (
           'zi_category_name' => $san_zi_cat_name
            );
	 $result = $wpdb->update( $table, $data, array( 'id' => $id ) );
			if ($result) zibox_log("updated existing table zibox categories - id", $id);
  } else {
	   $data = array (
            'id' => $san_zi_cat_id,
            'zi_category_name' => $san_zi_cat_name
            );
        $result = $wpdb->insert( $table, $data, $format );
			$tpl_id = $wpdb->insert_id;

			 if ( ! $result ) {
				zibox_log("Failed to store field {$key} - MySQL result: ".print_r($result,1));
				zibox_log("Field data : ".print_r($ziboxcat,1));
				zibox_log("MySQL query: ".print_r($wpdb->last_query,1));
				zibox_log("MySQL error: ".print_r($wpdb->last_error,1));
			} 	else { zibox_log("added new zi-box category - id = ",  $san_zi_cat_id);}
     }	 
   }	   
  }
   wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}
/* admin_action - check categories to work with. 
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
   $zibox_active_cats = ZiboxHelper::get_active_ziboxcats();
	
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
                 ZiboxHelper::cat_branch_insert ($parent_cat, $cat, $woo_cat_id);
            }
         } 
       }
  }
      wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit(); 
  
}
/* admin_action - Upload/update attributes and values(options) */
add_action( 'admin_action_attrlist', 'attrlist_admin_action', 12 );
function attrlist_admin_action() {
 global $wpdb, $exporter,  $count_limit, $offset, $count_limit;
  $table2 = $wpdb->prefix.'woocommerce_attribute_taxonomies';
  $table3 = $wpdb->prefix.'termmeta';
  if(isset($_POST['submit_attributes'])){
 
  $zibox_characts = $exporter->get_zibox_characteristics();
  $chatacts_count = count($zibox_characts);
  set_transient("chatacts_count", $chatacts_count, 0);
  $offset = (get_transient("offset"))?get_transient("offset"):0;
  $count_limit=($count_limit)?$count_limit:50;
  $zibox_characts = array_slice ($zibox_characts, $offset,  $count_limit);
    foreach ($zibox_characts as $zibox_charact) {
	 $zi_charact_cats = explode( ',', $zibox_charact['cats'] );
	 
	 
	   $i = 0;  $attr_cats = array();
	 /* replace array zi_charact_cats  by array term_ids woocommerce cats*/
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
	      
	   
	      $newattr_id = ZiboxHelper::insert_attr_values ($zibox_charact, $cats);
		    if ( is_wp_error( $newattr_id ) ) { 
			 zibox_log('Attribute ', $san_zi_charact_name );
			 zibox_log('Attribute id=', $zibox_charact['id'] );
			 zibox_log('Sorry, there has been an error ', esc_html( $newattr_id->get_error_message() ));			
	         }
	      } else { /*updating attrs and values*/
		  $attr_id = $woo_attr->attribute_id;
		  $old_slug = $woo_attr->attribute_name;
		  $newattr_id = ZiboxHelper::insert_attr_values ($zibox_charact, $cats, $attr_id, $old_slug);
		    if ( is_wp_error( $newattr_id ) ) { 
			 zibox_log('Attribute ', $san_zi_charact_name );
			 zibox_log('Attribute id=', $zibox_charact['id'] );
			 zibox_log('Sorry, there has been an error ', esc_html( $newattr_id->get_error_message() ));			
	         }		  
		  }
	   } 
     }
	 $offset=(get_transient("offset"))?$count_limit+get_transient("offset"):$count_limit;
	  
	  if ($offset>=$chatacts_count) {
	  delete_transient("offset"); delete_transient("chatacts_count"); set_transient("done", 1, 0);
	  } else {set_transient("offset", $offset, 0);}
  }
    wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}
/* admin_action - Upload images */
add_action( 'admin_action_images', 'images_admin_action', 13 );
function images_admin_action() {
if(isset($_POST['submit_images'])){
global $exporter, $wpdb, $count_limit, $offset_img, $imgs_count;
$table2 = $wpdb->prefix.'termmeta';

  $zicats = $wpdb->get_results( "SELECT * FROM ".$table2." WHERE meta_key = 'zibox_cat_id'" );

 /*upload 5 images */

  if ($zicats) {
  $imgs_count = count($zicats);
   set_transient("imgs_count", $imgs_count, 0);
  $offset_img = (get_transient("offset_img")===false)?0:get_transient("offset_img");
  $count_limit=($count_limit && $count_limit<10)?$count_limit:5;
  $zicats = array_slice ($zicats, $offset_img, $count_limit);
  
	 foreach ($zicats as $zicat) {
	   
			 /*check if category image exist. if do not exist upload it from zibox*/
		 $thumb_exist =  $wpdb->query( "SELECT * FROM " . $table2 . " WHERE meta_key = 'thumbnail_id' AND term_id = ".$zicat->term_id );
	
        if ($thumb_exist==0) {
		/*запросить данные категории с id=$zicat->meta_value*/
		   $getcat = $exporter->get_zibox_cat($zicat->meta_value);
			/*upload image from url $getcat['icon_rectangle ']*/ 
		   $attach_id = ZiboxHelper::upload_cat_img($getcat[0]['icon_rectangle']);
		  if ($attach_id){
            $key = 'thumbnail_id';
	        $value = $attach_id;
	        add_term_meta($zicat->term_id, wp_slash($key), (int)($value));
			
		  }
		 }
       		
	 }
	  $offset_img=(get_transient("offset_img"))?$count_limit+get_transient("offset_img"):$count_limit;	  
	  if ($offset_img>=$imgs_count) { 
	  delete_transient("offset_img"); delete_transient("imgs_count"); set_transient("done", 1, 0);
	  } else { set_transient("offset_img", $offset_img, 0); }	 
  }
}
	wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}
/* admin_action - reset upload steps */
add_action( 'admin_action_reset_steps', 'reset_steps_admin_action', 14 );
function reset_steps_admin_action() {
if(isset($_POST['submit_reset_steps'])){
delete_transient("offset_img"); delete_transient("imgs_count"); 
delete_transient("offset"); delete_transient("chatacts_count"); 
 }
  wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}

/* admin_action - clean log file /wp-content/plugins/ziboxfeed/log/error.log */
add_action( 'admin_action_clean_log', 'clean_log_admin_action', 14 );
function clean_log_admin_action() {
if(isset($_POST['submit_clean_log'])){
global $myfilename;
file_put_contents($myfilename, "");
 }
  wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}

/* admin_action - Delete categories */
add_action( 'admin_action_delcats', 'delcats_admin_action', 15 );
function delcats_admin_action()
{
  global $wpdb;
  $table1 = $wpdb->prefix.'zibox_categories';
  $table2 = $wpdb->prefix.'termmeta';
  $table3 = $wpdb->prefix.'woocommerce_attribute_taxonomies';
  if(isset($_POST['submit_del_cats'])){
        $del_cat_ids = $_POST['mydelcat'];
 /*delete categories and disable active*/
   foreach ($del_cat_ids as $del_cat_id) {
   
/*Для удаления категории и ее дерева, а также  всех привязанных к ней атрибутов*/

$woo_cat_id =  $wpdb->get_var( "SELECT term_id FROM ".$table2." WHERE meta_key = 'zibox_cat_id' AND meta_value = ".$del_cat_id );
if ($woo_cat_id) {
$parent_del_cat = get_term_by('id', $woo_cat_id, 'product_cat');
/*Ветка одной категории*/
	$del_branchcats = get_terms( array(
    'taxonomy'      => 'product_cat',
	'hide_empty' => false,
	'orderby'     => 'term_id',
	'order'       => 'ASC',
	'child_of'   => $woo_cat_id,
) );
array_unshift ($del_branchcats, $parent_del_cat);

/*Все атрибуты*/
$all_attrs= wc_get_attribute_taxonomies();
foreach ($del_branchcats as $del_cat) { 
   $cat_id = $del_cat->term_id;

   foreach ($all_attrs as $attr){
   $attr_cats = unserialize($attr->cats);
    
     foreach ($attr_cats as $key=>$attr_cat) {
	  if ($attr_cat==$cat_id) {
	  unset($attr_cats[$key]);}
	 }
	
	 if (count($attr_cats)){/*Перезаписать атрибут без удаленной категории*/
	 $cats=serialize($attr_cats);
	      $data = array (
           'cats' => $cats
            );    
		
	  $result = $wpdb->update( $table3, $data, array( 'attribute_id' => $attr->attribute_id ), array( '%s'), array( '%d') );
	  } else {$res_rel=wc_delete_attribute( $attr->attribute_id );

	  }  
   
   }
 /*После конца цикла по атрибутам удалить категорию и убрать галку*/
      $cat_uncat=get_term_by('slug', 'uncategorized', 'product_cat');
      $cat_uncat_id = $cat_uncat->term_id;
     wp_delete_term( $cat_id, 'product_cat', array('default'=>$cat_uncat_id) ); /*$cat_id - id удаляемой категории, $cat_uncat_id- id uncategorized*/
	 /* delete attachment*/
	 $attachment_id = get_term_meta( $cat_id, 'thumbnail_id', true );
     wp_delete_attachment($attachment_id, true);
      } 
 /*И убрать галку */ 
         $data = array (
           'active' => 0
            );    	
	  $result = $wpdb->update( $table1, $data, array( 'id' => $del_cat_id ), array( '%d'), array( '%d') );	  
	}  
  }  
   }
    wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit(); 
}
?>