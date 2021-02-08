<?php

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}


    // drop a custom database table
    global $wpdb;

	// drop tables
	$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "zibox_categories" );
  /*  $wpdb->query("ALTER TABLE ".{$wpdb->prefix}."woocommerce_attribute_taxonomies DROP COLUMN attrubute_zibox_id, cats;"); */


