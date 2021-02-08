<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    zibox
 * @subpackage zibox/includes
 * @author     bcat
 */
class Zibox_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	    global $wpdb;

        $result = $wpdb->get_var("SHOW COLUMNS FROM {$wpdb->prefix}woocommerce_attribute_taxonomies LIKE 'zibox_attribute_id';");

        if (empty($result)) {		
							
            $wpdb->query("ALTER TABLE {$wpdb->prefix}woocommerce_attribute_taxonomies ADD zibox_attribute_id BIGINT(20) NOT NULL DEFAULT '0';");
        }
		 $result = $wpdb->get_var("SHOW COLUMNS FROM {$wpdb->prefix}woocommerce_attribute_taxonomies LIKE 'cats';");
		 if (empty($result)) {		
							
            $wpdb->query("ALTER TABLE {$wpdb->prefix}woocommerce_attribute_taxonomies ADD cats TEXT NULL;");
        }
		
		// create table: zibox_categories (only top level categries)
			$sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}zibox_categories` (
			  `id` BIGINT(20) unsigned NOT NULL DEFAULT '0',
			  `zi_category_name` varchar(255) DEFAULT NULL,	
              `active` BOOLEAN DEFAULT FALSE,			  
			  PRIMARY KEY  (`id`)
			) DEFAULT CHARSET=utf8 ;";
			$wpdb->query($sql);		
	}

}
