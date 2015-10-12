<?php
/**
 * Short description.
 * 
 * Defines the plugin name, version, and hooks for enqueuing the stylesheet and JavaScript.
 * 
 * @package     JKL_Page_Scripts_Styles
 * @subpackage  JKL_Page_Scripts_Styles/admin
 * @author      Aaron Snowberger <jekkilekki@gmail.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Page_SS' ) ) {
    
    class JKL_Page_SS {
        
        /**
         * The ID of this plugin.
         * 
         * @since   0.1.0
         * @access  private
         * @var     string  $name       The ID of this plugin.
         */
        private $name;
        
        /**
         * Current version of the plugin.
         * 
         * @since   0.1.0
         * @access  private
         * @var     string  $version    The current version of this plugin.
         */
        private $version;
        
        /**
         * A reference to the meta box.
         * 
         * @since   0.1.0
         * @access  private
         * @var     JKL_Page_SS_Meta_Box    $meta_box   A reference to the meta box for the plugin.
         */
        private $meta_box;
        
        /**
         * A reference to the Settings page.
         * 
         * @since   0.1.0
         * @access  private
         * @var     JKL_Page_SS_Settings    $settings_page   A reference to the admin settings page for the plugin.
         */
        private $settings_page;
        
        
        /**
         * CONSTRUCTOR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
         * Initialize the class and set its properties
         * 
         * @since   0.1.0
         * @var     string  $name       The name of this plugin.
         * @var     string  $version    The version of this plugin.
         */
        public function __construct( $name, $version ) {
            
            // set the name and version number
            $this->name = $name;
            $this->version = $version;
            
            $this->meta_box = new JKL_Page_SS_Meta_Box();
            $this->settings_page = new JKL_Page_SS_Settings();
            
            add_action( 'admin_enqueue_scripts', array( $this, 'jkl_enqueue_admin_styles' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'jkl_enqueue_admin_scripts' ) );
            
            // Incorporate Settings
            //require_once( sprintf ( "%s/settings.php", dirname( __FILE__ ) ) );
            //$JKL_Page_SS_Settings = new JKL_Page_SS_Settings();
            
            // Incorporate Custom CSS Styles Metabox
            //require_once( sprintf ( "%s/inc/stylebox.php", dirname( __FILE__ ) ) );
            //$JKL_Page_Styles = new JKL_Page_Styles();
            
            // Incorporate Custom JS Scripts Metabox
            //require_once( sprintf ( "%s/inc/scriptbox.php", dirname( __FILE__ ) ) );
            //$JKL_Page_Scripts = new JKL_Page_Scripts();
            
        }
        
        public static function activate() {
            
        } // END activate
        
        public static function deactivate() {
            
        } // END deactivate
        
        public function get_version() {
            return $this->version;
        }
        
        /**
         * Enqueues all files specifically for the dashboard.
         * 
         * @since   0.1.0
         */
        public function jkl_enqueue_admin_styles() {
            
            wp_enqueue_style(
                    $this->name . '-admin',
                    plugins_url( 'jkl-page-scripts-styles/admin/css/admin.css' ),
                    false,
                    $this->version
            );
            
        } // END jkl_enqueue_admin_styles()
        
        /**
         * Enqueues Javascript file that is necessary to control the toggling of the meta box
         */
        public function jkl_enqueue_admin_scripts() {
            
            if ( 'post' === get_current_screen()->id ) {
                
                wp_enqueue_script(
                        $this->name . '-tabs',
                        plugins_url( 'jkl-page-scripts-styles/admin/js/tabs.js' ),
                        array( 'jquery' ),
                        $this->version
                );
                
                wp_enqueue_script(
                        $this->name . '-enqueue-files',
                        plugins_url( 'jkl-page-scripts-styles/admin/js/enqueue-files.js' ),
                        array( 'jquery' ),
                        $this->version
                );
                
            }
            
        } // END jkl_enqueue_admin_scripts()
        
    } // END class JKL_Page_ScriptsStyles
    
} // END if ( ! class_exists() )

