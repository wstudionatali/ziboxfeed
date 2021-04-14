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
 * Version:           1.4.0
 * Author:            bcat
 * Author URI:        https://bcat.tech/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
		$var = filter_var("string", FILTER_SANITIZE_STRING); 

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly.*/
}
define('ZIBOX_VERSION', '1.4.0' );
define('ZIBOX_PATH', realpath( dirname(__FILE__) ) );
define('ZIBOX_URL', plugins_url() . '/' . basename(dirname(__FILE__)) . '/' );

require_once ZIBOX_PATH . '/includes/zibox-logger.php';
require_once ZIBOX_PATH . '/includes/class-walker-category-checklist-disableparents.php';
require_once ZIBOX_PATH . '/includes/zibox-api-exporter.php';
require_once ZIBOX_PATH . '/includes/prouct_edit_page.php';
require_once ZIBOX_PATH . '/helper.php';
require_once ZIBOX_PATH . '/includes/admin-actions.php';


 $api_url = get_option( 'api_url', $default = "http://api.marketplace.prod.ziboxtech.com" );
 $file_name = get_option( 'xml_file_name', $default = "product" );
 $count_limit = get_option('count_limit');
 $exporter = new ZiboxApiExporter($api_url);
 $myfilename = ZIBOX_PATH . '/logs/error.log';
 $offset_img = get_transient("offset_img"); $imgs_count = get_transient("imgs_count");
 $offset = get_transient("offset"); $chatacts_count = get_transient("chatacts_count");

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
global $exporter, $myfilename, $offset, $chatacts_count, $offset_img, $imgs_count;

$ziboxcategories = ZiboxHelper::get_ziboxcats();
foreach ($ziboxcategories as $ziboxcategory ) {
$subcats[$ziboxcategory->id] = $exporter->get_cat_branch_array($ziboxcategory->id);
array_shift($subcats[$ziboxcategory->id]);
}
$ziactivecats = ZiboxHelper::get_active_ziboxcats();

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
		
		add_settings_field(
		   'count_limit',
		   __( 'Count limit', 'zibox_textdomain' ),
		   'zibox_setting_markup_limit',
		   'zi_box',
		   'zibox_page_setting_section'
		);

		register_setting( 'zi_box', 'xml_file_name' );
		register_setting( 'zi_box', 'api_url' );
		register_setting( 'zi_box', 'count_limit' );
}


function zibox_setting_section_callback_function() {
    echo '<p>(Zibox settings section)</p>';
}


function zibox_setting_markup_xml() {
    ?>
    <label for="xml_file_name"><?php _e( 'Please name you xml file like product-your-shop-name' ); ?></label>
    <input type="text" id="xml_file_name" name="xml_file_name" value="<?php echo get_option( 'xml_file_name' ); ?>">
	
    <?php
}
function zibox_setting_markup_url() {
    ?>
	<label for="api_url"><?php _e( 'Please put here API url' ); ?></label>
    <input type="text" id="api_url" name="api_url" value="<?php echo get_option( 'api_url' ); ?>" placeholder="http://api.marketplace.prod.ziboxtech.com">
	<div>Copy and paste one of these: http://api.marketplace.prod.ziboxtech.com  </div>
    <?php
}
function zibox_setting_markup_limit() {
    ?>
	<label for="count_limit"><?php _e( 'Please put here count limit for items loading' ); ?></label>
    <input type="number" min="1" max="100" step="1" id="count_limit" name="count_limit" value="<?php echo get_option( 'count_limit' ); ?>" >
	
    <?php
}
/*end options*/

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

/*note about finishing parts loading*/
add_action( 'admin_notices', 'wpclevertap_notices', 20);
function wpclevertap_notices(){
global $offset, $chatacts_count, $offset_img, $imgs_count;
	if( isset($_GET['page']) && $_GET['page'] == 'zi_box'  ) {	
	$notice1 = get_transient("done");
	     if ( $notice1 ) {
		    echo '<h1 id="zibox_message_success" class="zi-notice notice is-dismissible">Uploading has done!</h1>';
	     delete_transient("done");	
	   }
	     if ($offset && $chatacts_count){
		   echo '<h1 id="zibox_message_not-completed" class="zi-notice notice is-dismissible">Your attribute loading is not complete. The rest of unprocessed attributes is '.($chatacts_count-$offset).' </h1>';
		 }
		  if ($imgs_count && $offset_img){
		   echo '<h1 id="zibox_message_not-completed" class="zi-notice notice is-dismissible">Your images loading is not complete. The rest of unprocessed images is '.($imgs_count-$offset_img).' </h1>';
		 }
	} 
}