<?php



 /**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.

 * @wordpress-plugin
 * Plugin Name:       interactive-geo-maps      
 * Plugin URI:        https://wordpress.org/plugins/search/interactive-geo-maps-wp/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Robin
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.robin.org/licenses/gpl-2.0.txt
 * Text Domain:       ikrgeo
 * Domain Path:       /languages
 */

 
define("RBOIN_DIR_PATH", plugin_dir_path(__FILE__));

include_once RBOIN_DIR_PATH . './functions/functions.php';
function rdata_add_menu_page()
{
   add_menu_page('submit from data', 'submit from data', 'manage_options', 'submit-from-data', 'rdata_add_admin_menu_page', '', 101);
   add_submenu_page('submit-from-data', 'submit from', 'submit from', 'manage_options', 'submit-from-data', '', 'rdata_add_admin_menu_page');

   // add show data submenu 
   add_submenu_page('submit-from-data', 'show data', 'show data', 'manage_options', 'submit-from-data-show', 'rdata_add_show_data', 101);


}


add_action('admin_menu', 'rdata_add_menu_page');




function rdata_add_show_data()
{

   ?>
   <h1> show from data</h1>
   <?php

   include_once RBOIN_DIR_PATH . './views/show-form-data.php';
   ?>



   

   <?php

}


include_once RBOIN_DIR_PATH . './utlits/db.php';

register_activation_hook( __FILE__, 'rdata_plugin_create_tables' );


?>

