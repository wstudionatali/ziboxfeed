<?php
/* xml template for feed and file  */

global  $woocommerce; 
$lang = '';
if (isset($_GET["lng"])) 
{ $lang =  $_GET["lng"]; }
	status_header( 200 );
	echo '<?xml version="1.0" encoding="UTF-8"?>';
/* $cats - wooconnerce categories which are zibox too and not empty*/      
	$cats = get_terms( array(
    'taxonomy'      => 'product_cat',
	'orderby'     => 'term_id',
	'order'       => 'ASC',
	'meta_key'  => 'zibox_cat_id',
) );

				
$zicatids = array(); /*array of zibox categories ids with key = term id */
$arcats = array(); /*array of term  ids( woocommerce product categoreis) */

$all_attrs= wc_get_attribute_taxonomies();


if( $cats && ! is_wp_error($cats) ){
$i=0;	
	foreach( $cats as $cat ){
	$zibox_cat_id = get_term_meta ($cat->term_id, 'zibox_cat_id', true );
	$arcats[$i]	= $cat->term_id;
	$zicatids[$cat->term_id] = $zibox_cat_id;	
  $i++;
	}
}

$query = new WP_Query( array(
    'nopaging' => true,
    'post_type' =>  array( 'product'),
	'tax_query' => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'id',
			'terms'    => $arcats,
			'include_children' => false,
		)
	)
) );	
/* zibox_log("Count of products in xml: ".$query->post_count);*/	?>	
<products>	
	<?php
	while ( $query->have_posts() ) {
				$query->the_post();	
                $_product_def_lng = wc_get_product( get_the_ID());				
				if ($lang) {
				$transl_ID = apply_filters( 'wpml_object_id', get_the_ID(), 'product', true, $lang );
				$_product = wc_get_product( $transl_ID);
				$prod_id = $transl_ID;
				} else { $_product = $_product_def_lng; 
				 $prod_id = get_the_ID();
				}
				$stack=$_product->get_category_ids();
				$firstcat = array_shift($stack);
				if ($stack) {zibox_log("Product ". $_product->get_name()."  was included in more then one categories, the first will be used. Category ids: ", $stack);}				
				$term = get_term( $firstcat, 'product_cat' );
                $slug = $term->slug; 
				if ($slug === 'uncategorized') {
				zibox_log("Product (in ". $lang. ") ".$_product->get_name()." is uncategorized. Please assign category to this product and repeat xml generation" ) ;
				$zicatid = ''; 
				} else {
				$zicatid = $zicatids[$firstcat]; }
				 /*clean description text from [shortcode][/shortcode] and &nbsp*/
		        $description =  preg_replace('/\[.*?\]/', '', $_product->get_description());  
			    $img_url = wp_get_attachment_image_url($_product->get_image_id(), 'large');
			    $attrs = $_product->get_attributes();
				
				?>
 <product>
    <id><?php echo get_the_ID(); ?></id>
   <title><?php echo htmlspecialchars($_product->get_name(), ENT_XML1); ?></title>  
   <description><?php echo htmlspecialchars($description, ENT_XML1); ?>  </description>
   <thumb><?php echo $img_url; ?> </thumb>
   <category><?php  echo  $zicatid; ?></category>
   <price><?php echo $_product->get_price(); ?></price>
   <currency><?php echo get_woocommerce_currency(); ?></currency>
   <characteristics>
<?php 
if (!empty($attrs)) {
$meta_values = get_post_meta( $prod_id, 'attr_label_translations', true );	


foreach ($attrs as $attr) {			 
     $zibox_char_id = 0;
   if ($attr->get_id()=== 0) { 
       $name = $attr->get_name();
	   if (!empty($meta_values) && ($lang)) {
	      $attr_slug = wc_sanitize_taxonomy_name($name);
	       $name = $meta_values[$lang][$attr_slug];
	    } 
   } else {  
     $zibox_char_id=$all_attrs['id:'. $attr->get_id()]->zibox_attribute_id;
	  $name = $all_attrs['id:'. $attr->get_id()]->attribute_label;
	  $cats = unserialize($all_attrs['id:'. $attr->get_id()]->cats);
	      if ( $cats ) {
	          if (!in_array($firstcat, $cats)) {$zibox_char_id = 0;
	             zibox_log("Product ".$_product_def_lng->get_name()." has attribute ".$name." that  doesn`t belong category ".$term->name.". Please, fix it and try generate xml again") ;
	          }  
		} 
	}
	
	$values=$attr->get_options();
   if (!empty($values)) {	?>
  <characteristic>
	 <id><?php if($zibox_char_id) echo $zibox_char_id ; ?></id>
	 <name><?php echo htmlspecialchars($name, ENT_XML1)  ; ?></name>
	  <values>
			<?php
			 foreach ($values as $value) {
			 if ($attr->get_id()=== 0) { 
			 $optname = $value; 
			 } else {
			 $optname = get_term( $value)->name; }
	
			?>
		<value><?php echo htmlspecialchars($optname, ENT_XML1)  ; ?></value>
			<?php } ?>
	  </values>
	</characteristic>
	<?php 
	}
	} 
  } ?>			
  </characteristics>		
 </product>
	<?php	} ?>		
</products>
