<?php
/**
 * The plugin bootstrap file
 * 
 * This file is responsible for starting the plugin using the main plugin class file.
 * 
 * @since       0.1.0
 * @package     JKL_Page_Scripts_Styles
 * @author      Aaron Snowberger <jekkilekki@gmail.com>
 * 
 * @wordpress-plugin
 * Plugin Name: JKL Page Scripts & Styles
 * Plugin URI:  https://github.com/jekkilekki/plugin-jkl-page-scripts-styles
 * Description: A simple plugin to add metaboxes to Pages (or Posts) for page specific CSS or JS.
 * Version:     0.1.0
 * Author:      Aaron Snowberger
 * Author URI:  http://www.aaronsnowberger.com
 * Text Domain: jkl-page-scripts-styles
 * License:     GPL2
 * 
 * Requires at least: 3.5
 * Tested up to: 4.3.1
 */

/** Copyright 2015 Aaron Snowberger

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Prevent direct access */
if ( ! defined( 'WPINC' ) ) die;

/**
 * The class that represents the admin settings page
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/class-jkl-page-ss-settings.php';

/**
 * The class that represents the meta box that will display the fields for the meta box
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/class-jkl-page-ss-metabox.php';

/**
 * Load the core plugin class that is used to define the meta boxes, settings, etc
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/class-jkl-page-ss.php';

//if ( class_exists( 'JKL_Page_Scripts_Styles' ) ) {
    
    // Installation and uninstallation hooks
    //register_activation_hook( __FILE__, array( 'JKL_Page_ScriptsStyles', 'activate' ) );
    //register_deactivation_hook( __FILE__, array( 'JKL_Page_ScriptsStyles', 'deactivate' ) );
    function run_page_ss() {
    // Instantiate the plugin class
        $JKL_Page_SS = new JKL_Page_SS( 'jkl-page-ss', '0.1.0' );
    }
    
    run_page_ss();
    
    // Add a link to the settings page onto the plugin page
//    if ( isset ( $JKL_Page_SS ) ) {
//        
//        // Add the settings link to the plugins page
//        function jkl_plugin_settings_link( $links ) {
//            $settings_link = '<a href="admin.php?page=jkl_page_ss_settings">Settings</a>';
//            array_unshift( $links, $settings_link );
//            return $links;
//        }
//        
//        $plugin = plugin_basename( __FILE__ );
//        add_filter( "plugin_action_links_$plugin", 'jkl_plugin_settings_link' );
//    }
//}