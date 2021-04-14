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
	     	?> <p>Upload product XML file for Zibox: <a class="button" href="<?php echo get_site_url() ?>/feed/xmlproductfile" target="_blank">Get xml file</a></p>
               <p>Get product XML feed by url: <a class="link" href="<?php echo get_site_url() ?>/feed/xmlproductfeed" target="_blank"><?php echo get_site_url() ?>/feed/xmlproductfeed</a></p>
			<?php 	  
      }  else  { 
	    foreach ($langs as $cod=>$lang){
	      $l = '?lng='.$cod;	 
	       ?> <p>Upload product XML file for Zibox: <a class="button" href="<?php echo get_site_url() ?>/feed/xmlproductfile<?php echo $l ?>" target="_blank">Get <?php echo $lang['translated_name'] ?> <img src="<?php echo  $lang['country_flag_url']?>"> xml file</a></p> 
		   <p>Get <?php echo $lang['translated_name'] ?> <img src="<?php echo  $lang['country_flag_url']?>"> product XML feed by url: <a class="link" href="<?php echo get_site_url() ?>/feed/xmlproductfeed<?php echo $l ?>" target="_blank"><?php echo get_site_url() ?>/feed/xmlproductfeed<?php echo $l ?></a></p> 
		   <?php      
		 }  
      }      ?>

    <form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
	<div class="notice-text">To update/sinhronize zibox categories press the button "Update list"</div>
        <input type="hidden" name="action" value="updatelist" />
        <input type="submit" value="Update list" name="submit_updatelist"/>
    </form>
	
<br>	

<form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
<?php foreach ($ziboxcategories as $key => $ziboxcategory) {
$checked = ($ziboxcategory->active)? "checked" : "";
?>

    <input type="checkbox" name="mycat[]" id="catinput_<?php echo $key?>" value="<?php echo $ziboxcategory->id ?>" <?php echo $checked; ?>><span class="top-level-cat"><?php echo $ziboxcategory->zi_category_name ?></span></br>
<?php foreach ($subcats[$ziboxcategory->id] as $subcat) { ?>
	
	<div class="subcats-lev<?php echo $subcat['level']?>"><?php echo $subcat['name']?></div>
	
<?php } ?>
<?php } ?>
<div class="notice-text">To Upload/update checked categories to woocommerce producte categories press the button "Upload categories"</div>
        <input type="hidden" name="action" value="catslist" />
        <input type="submit" value="Upload categories" name="submit_cats"/>
</form>

<br>

    <form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
	<div class="notice-text">To upload/update zibox attributes press the button "Upload attributes". Loading is carried out by default 50 items at a time</div>

        <input type="hidden" name="action" value="attrlist" />
        <input type="submit" value="Upload attributes" name="submit_attributes"/>
	<span class="steps"><?php 
	if ($offset && $chatacts_count)  echo "The rest is ".($chatacts_count-$offset)." Total amount is ".$chatacts_count. ". Reset steps to dismiss";	
	?></span>		
    </form>  
<br>	
	  <form method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
	<div class="notice-text">To upload images for product categories press the button "Upload images". Loading is carried out by default 5 items at a time</div>

        <input type="hidden" name="action" value="images" />
        <input type="submit" value="Upload images" name="submit_images"/><span class="steps"><?php 
	 if ($offset_img && $imgs_count) echo " The rest is ".($imgs_count-$offset_img)." Total amount is ".$imgs_count. ". Reset steps to dismiss";	
	?></span>
    </form>
	<br>
	
	
 <form id="reset_steps" method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
        <input type="hidden" name="action" value="reset_steps" />
        <input class="reset_steps" type="submit" value="Reset steps" name="submit_reset_steps"/>
    </form>
</br>	
	
	
	</div>

	
	<div class="col-6">
	    <form id="opt" method="POST" action="options.php">
    <?php
    settings_fields( 'zi_box' );
    do_settings_sections( 'zi_box' );
		?> <div>If you have an error by executive time while loading categories, attributes or images, reload the page, decrease count limit option, save it and try to load again.</div> <?php
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
	  <form id="clean_log" method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
        <input type="hidden" name="action" value="clean_log" />
        <input type="submit" value="Clean log" name="submit_clean_log"/>
    </form>
<br>
<form id="del_cats" method="POST" action="<?php echo admin_url( 'admin.php' ) ?>">
<?php foreach ($ziactivecats as $key => $ziactivecat) {
?>

    <input type="checkbox" name="mydelcat[]" id="delinput_<?php echo $key?>" value="<?php echo $ziactivecat->id ?>" ><span class="top-level-cat"><?php echo $ziactivecat->zi_category_name ?></span></br>

<?php } ?>
<div>To delete checked categories from woocommerce producte categories press the button "Delete categories". Please be careful. Categories are removed along with attributes</div>
        <input type="hidden" name="action" value="delcats" />
        <input type="submit" value="Delete categories" name="submit_del_cats"/>
</form>	
</div>
</div>
