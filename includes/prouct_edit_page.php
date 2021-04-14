<?php
/* create marker (+) for zibox categories on product edit page   */ 
add_filter( 'wp_terms_checklist_args',  'marker_zibox_categories'  );
function marker_zibox_categories( $args ) {
		if ( ! empty( $args['taxonomy'] ) && 'product_cat' === $args['taxonomy'] ) {
			$args['walker'] = new Walker_Category_Checklist_Disableparents;
		}
		return $args;
	}

add_action( 'current_screen', 'fcs');
function fcs () {
$cur_screen=get_current_screen();

 if(  $cur_screen->id == 'product' or $cur_screen->id == 'edit-product') { 
 add_action('admin_print_footer_scripts', 'my_action_javascript', 99); 
 }
}
 if( wp_doing_ajax() ) add_action('wp_ajax_filterattrs', 'ajax_filterattrs');  		
	
/*	 filtering  attributes by chosen category on edit product page*/


function my_action_javascript() {
?>
<script>
jQuery( document ).ready(function() {
 
	var valcheckbox;
	jQuery('input[name="tax_input[product_cat][]"]').each(function() {  
        if (jQuery( this ).prop( "checked")== true)  { 
		valcheckbox = jQuery( this ).val(); 
		catajax(valcheckbox);
		} 
      	
  });
   if (!valcheckbox) {jQuery('select.attribute_taxonomy').empty();}	
  var valcheckboxpop;
  var loopcheckbox;
   jQuery( 'li.popular-category input[type="checkbox"]' ).click(function() {
  valcheckboxpop = jQuery( this ).val();
  jQuery('li.popular-category input[type="checkbox"]').each(function() {
  loopcheckbox = jQuery( this ).val();
        if (loopcheckbox !== valcheckboxpop) jQuery( this ).prop( "checked", false );
  });
  jQuery('input[name="tax_input[product_cat][]"]').each(function() {
  loopcheckbox = jQuery( this ).val();
        if (loopcheckbox !== valcheckboxpop) jQuery( this ).prop( "checked", false );
  });  
  catajax(valcheckboxpop);
});
/*function onlyOne(checkbox) { */
   var checkbox
  jQuery( 'input[name="tax_input[product_cat][]"]' ).click(function() {
  checkbox = jQuery( this ).val();
jQuery('input[name="tax_input[product_cat][]"]').each(function() {
  var loopcheckbox = jQuery( this ).val();
        if (loopcheckbox !== checkbox) jQuery( this ).prop( "checked", false );
  });
 jQuery('li.popular-category input[type="checkbox"]').each(function() {
  var loopcheckbox = jQuery( this ).val();
        if (loopcheckbox !== checkbox) jQuery( this ).prop( "checked", false );
  });
catajax(checkbox);
});	
});

function catajax (my_value) {
jQuery.ajax({
	type:'POST',
	url:ajaxurl,
	data:'action=filterattrs&cat_id=' + my_value,
	success:function(data_html){
//	jQuery('#warn').empty();
	jQuery('select.attribute_taxonomy').html(data_html);
	}
});
}
</script> 
<?php }  

function ajax_filterattrs(){
	$term_id = intval($_POST['cat_id']);
	remove_filter( 'woocommerce_attribute_taxonomies', 'cat_filter_atribute_taxonomies', 10 );
	/* получает атрибуты и в цикле просматриваем поле cats дессериализуем его 
	и проверяем вхождение $term_id в массив, если есть атрибут перезаписываем в новый отфильтрованный массив
	echo html для вывода атрибутов для замены  */
	global $wc_product_attributes;
	 global $wpdb;
	$table2 = $wpdb->prefix.'termmeta';	 
	$attribute_taxonomies = wc_get_attribute_taxonomies();
	$firstopt = __( 'Custom product attribute', 'woocommerce' );	
	$output = '<option value="">'.$firstopt.'</option>';			
    $woo_term =  $wpdb->query( "SELECT * FROM ".$table2." WHERE meta_key = 'zibox_cat_id' AND term_id = ".$term_id );
			if ( ! empty( $attribute_taxonomies ) ) {
				foreach ( $attribute_taxonomies as $tax ) {
				if ($tax->cats) { $cats = unserialize($tax->cats); } else { $cats = array(); }					
					if (in_array($term_id, $cats) or ($woo_term==0 && $tax->zibox_attribute_id==0 )) {
					   $attribute_taxonomy_name = wc_attribute_taxonomy_name( $tax->attribute_name );
					   $label                   = $tax->attribute_label ? $tax->attribute_label : $tax->attribute_name;
					   $output .= '<option value="' . esc_attr( $attribute_taxonomy_name ) . '">' . esc_html( $label ) . '</option>';
					}
				}				
			}	
	echo $output;	
	wp_die();
}
/*Warning At first chose category for uploading attributes */
add_action( 'woocommerce_product_options_attributes', 'warning_get_attributes', 1 );
function warning_get_attributes() 
{
 echo '<div id="warn" style="text-align:center;"><strong style="color:red;">At first, select a category! So, the list of attributes for this category will be loaded!</strong></div>';
}

require_once ZIBOX_PATH . '/includes/class-wc-admin-attributes_zibox.php';
/* add zibox-marker on edit product categories page*/
add_filter('manage_edit-product_cat_columns', 'my_extra_cat_columns');
function my_extra_cat_columns($columns) {
    $columns['zibox_id'] = 'zibox ID';
    return $columns;
}
add_action( 'manage_product_cat_custom_column', 'my_cat_column_content', 10, 3);
function my_cat_column_content($string, $column_name, $term_id) {
    if ( $column_name  !== 'zibox_id' ) return;

    //Get number of slices from post meta
    $string = get_term_meta($term_id, 'zibox_cat_id', true);
	$string = intval($string);
	if ($string) $string .= '<img src="'.ZIBOX_URL.'image/choose-platform-logo.svg" width="40">';
    echo ($string);
}
/*add zibox-marker on edit attributes page*/
add_action( 'admin_menu', 'action_function_name_8035', 999);
function action_function_name_8035(){
 remove_submenu_page( 'edit.php?post_type=product', 'product_attributes' );
}	/*Override woocommerce attribute edit-page output*/
add_action ('admin_menu', 'admin_menu_zibox', 1000 );	
function admin_menu_zibox() {
		global $menu;
		add_submenu_page( 'edit.php?post_type=product', __( 'Attributes', 'woocommerce' ),  'Attributes', 'manage_product_terms', 'zi_product_attributes',  'attributes_page'  );
	}
function attributes_page() {
		WC_Admin_Attributes_Zibox::output();
	}	