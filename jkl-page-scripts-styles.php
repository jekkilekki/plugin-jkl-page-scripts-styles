<?php
/*
 * Plugin Name: JKL Page Scripts & Styles
 * Plugin URI: https://github.com/jekkilekki/plugin-jkl-page-scripts-styles
 * Description: A simple plugin to add metaboxes to Pages (or Posts) for page specific CSS or JS.
 * Version: 0.1
 * Author: Aaron Snowberger
 * Author URI: http://www.aaronsnowberger.com
 * Text Domain: jkl-page-scripts-styles
 * License: GPL2
 * 
 * Requires at least: 3.5
 * Tested up to: 4.3.1
 * 
 * @package JKL-Page-ScriptsStyles
 * @author Aaron Snowberger
 */

/*  Copyright 2015  Aaron Snowberger

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
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Page_ScriptsStyles' ) ) {
    
    class JKL_Page_ScriptsStyles {
        
        /**
         * Current version of the plugin.
         * @var string
         */
        protected $version;
        
        
        /**
         * CONSTRUCTOR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
         */
        public function __construct() {
            
            // set the version number
            $this->version = '0.1';
            
            // Incorporate Settings
            require_once( sprintf ( "%s/inc/settings.php", dirname( __FILE__ ) ) );
            $JKL_Page_SS_Settings = new JKL_Page_SS_Settings();
            
            // Incorporate Custom CSS Styles Metabox
            require_once( sprintf ( "%s/inc/stylebox.php", dirname( __FILE__ ) ) );
            $JKL_Page_Styles = new JKL_Page_Styles();
            
            // Incorporate Custom JS Scripts Metabox
            require_once( sprintf ( "%s/inc/scriptbox.php", dirname( __FILE__ ) ) );
            $JKL_Page_Scripts = new JKL_Page_Scripts();
            
        }
        
        public static function activate() {
            
        } // END activate
        
        public static function deactivate() {
            
        } // END deactivate
        
        public function get_version() {
            return $this->version;
        }
        
    } // END class JKL_Page_ScriptsStyles
    
} // END if ( ! class_exists() )

/**
 * BUILD OBJECT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
if ( class_exists( 'JKL_Page_ScriptsStyles' ) ) {
    
    // Installation and uninstallation hooks
    register_activation_hook( __FILE__, array( 'JKL_Page_ScriptsStyles', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'JKL_Page_ScriptsStyles', 'deactivate' ) );
    
    // Instantiate the plugin class
    $JKL_Page_SS = new JKL_Page_ScriptsStyles();
    
    // Add a link to the settings page onto the plugin page
    if ( isset ( $JKL_Page_SS ) ) {
        
        // Add the settings link to the plugins page
        function jkl_plugin_settings_link( $links ) {
            $settings_link = '<a href="admin.php?page=jkl_page_ss_settings">Settings</a>';
            array_unshift( $links, $settings_link );
            return $links;
        }
        
        $plugin = plugin_basename( __FILE__ );
        add_filter( "plugin_action_links_$plugin", 'jkl_plugin_settings_link' );
    }
}