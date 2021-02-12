<?php
/**
 * Template Name: product XML Template - xmlproductfile
 */
 header('Content-type: text/xml; charset=utf-8');
 header('Content-Disposition: attachment; filename='.$file_name.'.xml'); 
 include( ZIBOX_PATH . '/views/xmltmpl.php' );	
 ?>