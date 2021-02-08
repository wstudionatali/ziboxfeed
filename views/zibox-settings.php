<?php 
$checked = "";
$langs = array();
	if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
	$langs = icl_get_languages('skip_missing=0&orderby=code');
}
?>
<h2>Zi-box xml feed</h2>
<div class="row">
	<div class="col-6">

<?php  if ( empty($langs) ) {
	     	?> <p>Upload product Xml file for Zibox: <a class="button" href="<?php echo get_site_url() ?>/feed/xmlproductfeed" target="_blank">Get xml file</a></p> <?php 	  
      }  else  { 
	    foreach ($langs as $cod=>$lang){
	      $l = '?lng='.$cod;	 
	       ?> <p>Upload product Xml file for Zibox: <a class="button" href="<?php echo get_site_url() ?>/feed/xmlproductfeed<?php echo $l ?>" target="_blank">Get <?php echo $lang['translated_name'] ?> <img src="<?php echo  $lang['country_flag_url']?>"> xml file</a></p> <?php      
		 }  
      }      ?>

    <form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
	<div>To update/sinhronize zibox categories press the button "Update list"</div>
        <input type="hidden" name="action" value="updatelist" />
        <input type="submit" value="Update list" name="submit_updatelist"/>
    </form>
	
<br>	

<form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
<?php foreach ($ziboxcategories as $key => $ziboxcategory) {
$checked = ($ziboxcategory->active)? "checked" : "";
?>

    <input type="checkbox" name="mycat[]" id="miinput" value="<?php echo $ziboxcategory->id ?>" <?php echo $checked; ?>><span class="top-level-cat"><?php echo $ziboxcategory->zi_category_name ?></span></br>
<?php foreach ($subcats[$ziboxcategory->id] as $subcat) { ?>
	
	<div class="subcats-lev<?php echo $subcat['level']?>"><?php echo $subcat['name']?></div>
	
<?php } ?>
<?php } ?>
<div>To Upload/update checked categories to woocommerce producte categories press the button "Upload categories"</div>
        <input type="hidden" name="action" value="catslist" />
        <input type="submit" value="Upload categories" name="submit_cats"/>
</form>

<br>

    <form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
	<div>To upload/update zibox attributes press the button "Upload attributes"</div>
	<div>To upload/update zibox attributes values press the button "Upload attributes" a second time</div>
        <input type="hidden" name="action" value="attrlist" />
        <input type="submit" value="Upload attributes" name="submit_attributes"/>
    </form>  
<br>	
	  <form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
	<div>To upload images for product categories press the button "Upload images"</div>
        <input type="hidden" name="action" value="images" />
        <input type="submit" value="Upload images" name="submit_images"/>
    </form>
	<br>
	</div>

	
	<div class="col-6">
	    <form method="POST" action="options.php">
    <?php
    settings_fields( 'zi_box' );
    do_settings_sections( 'zi_box' );
    submit_button();
    ?>
    </form>
<div class="header-log"><strong>Warnings and notes after xml generation is done </strong> <span><a class="button" href="" onclick="Location.reload()">Refresh log</a></span></div>
<div class="log-wrapper">
<?php   
$lines = file($myfilename);
// Осуществим проход массива и выведем содержимое в виде HTML-кода вместе с номерами строк.
foreach ($lines as $line_num => $line) {
    echo "<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
}?>
</div>
<br>
	  <form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
        <input type="hidden" name="action" value="clean_log" />
        <input type="submit" value="Clean log" name="submit_clean_log"/>
    </form>
</div>
</div>