<?php
    
/**
 * JKL Page Scripts & Styles Settings
 * 
 * Allow the user to decide whether to use the metabox on Posts, Pages, or both 
 * and whether or not to use Custom CSS or Custom JS or both
 * 
 * @package     JKL_Page_Styles_Scripts
 * @subpackage  JKL_Page_Styles_Scripts/admin
 * @author      Aaron Snowberger <jekkilekki@gmail.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Page_SS_Settings' ) ) {
    
class JKL_Page_SS_Settings {
    
    /**
     * Be sure we're using the most recent version - don't load old cached files
     * @var string 
     */
    private $version;
    
    /**
     * Array to hold our plugin options
     * @var array
     */
    private $options;
    
    /**
     * CONSTRUCTOR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     * @param type $version
     */
    public function __construct( /*$version*/ ) {
        
        //$this->version = $version;
        
        // Get previously stored options
        $this->options = get_option( 'jkl_pagess_settings' );
        
        //add_action( 'init', array( &$this, 'jkl_load_settings' ) );
        add_action( 'admin_init', array( &$this, 'jkl_register_pagess_settings' ) );
        add_action( 'admin_menu', array( &$this, 'jkl_add_menus' ) );
        
    } // END __construct()
   
    /**
     * FUNCTION:
     * Register and add settings and fields
     */
    public function jkl_register_pagess_settings() {
        
        register_setting(
                'main-settings-page',
                'main-settings',
                array( $this, 'validate' )
        );
        
        /**
         * Main Section
         */
        add_settings_section( 
                'main_section',
                __( 'Plugin Settings', 'jkl-page-scripts-styles' ),
                array( $this, 'main_section_info' ),
                'main-settings-page'
        );
                
                add_settings_field(
                        'post_type',
                        __( 'Post Type', 'jkl-page-scripts-styles' ),
                        array( $this, 'choose_post_type' ),
                        'main-settings-page',
                        'main_section'
                );
                
                add_settings_field(
                        'custom_boxes',
                        __( 'Custom CSS and JS', 'jkl-page-scripts-styles' ),
                        array( $this, 'enable_boxes' ),
                        'main-settings-page',
                        'main_section'
                );
                
        /**
         * Register our settings
         */
        //register_setting( 'main-settings-page', 'post_type', array( $this, 'sanitize' ) );
        //register_setting( 'main-settings-page', 'custom_boxes', array( $this, 'sanitize' ) );
        
    } // END jkl_register_pagess_settings()
    
    /**
     * FUNCTION:
     * Create Admin Menu
     */
    public function jkl_add_menus() {
        
        /**
         * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
         * !!!! IMPORTANT: Only allows one instance of the JKL Plugins Menu  !!!!
         * !!!! Add AFTER add_submenu_page() to not duplicate the name       !!!!
         * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
         */
        if ( empty ( $GLOBALS[ 'admin_page_hooks' ][ 'jkl-plugins-main-menu' ] ) ) {
            add_menu_page(
                    __( 'JKL Plugins', 'jkl-page-scripts-styles' ),
                    __( 'JKL Plugins', 'jkl-page-scripts-styles' ),
                    'manage_options',
                    'jkl-plugins-main-menu',
                    'jkl_plugins_main_page',
                    'dashicons-admin-plugins'
            );
       }
        
        /**
         * Create a submenu for THIS plugin
         */
        add_submenu_page( 
                'jkl-plugins-main-menu',
                __( 'JKL Page Scripts and Styles Settings', 'jkl-page-scripts-styles' ),
                __( 'JKL Page Scripts', 'jkl-page-scripts-styles' ),
                'manage_options',
                'jkl_pagess_settings',
                array( $this, 'jkl_create_settings_page' )
        );
        
    } // END jkl_add_menus() 
    
    /**
     * CALLBACK:
     * Create Settings Page
     */
    public function jkl_create_settings_page() {
    ?>
        <h2>JKL Page Scripts & Styles Settings</h2>
        <div class="wrap">
            <form method="post" action="options.php">
        
            <?php
            wp_nonce_field( 'update-options' ); // This prints out hidden settings fields
            settings_fields( 'main-settings-page' );
            do_settings_sections( 'main-settings-page' );
            submit_button();
            ?>
        
            </form>
        </div>    
    <?php    
    } // END jlk_create_settings_page()
    
    /**
     * CALLBACK:
     * Validate each setting field as needed
     * 
     * @param array $input Contains all settings fields as array keys
     */
    public function validate( $input ) {
        
        // Create output array for storing the validated options
        $output = array();
        
        // Loop through each of the incoming options --> not yet
        foreach( $input as $key => $value ) {
            
            // Check to see if there is a value, if so - process it.
            if( isset( $input[ $key] ) ) {
                
                // Strip all HTML and PHP tags and properly handle quoted strings
                $output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );
                
            } // end if
            
        } // end foreach
        
        // Return the array processing any additional functions filtered by this action
        return apply_filters( 'validate', $output, $input );
        
    }
    
    /**
     * BUILD PAGE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     */
    
    /**
     * CALLBACK:
     * Print Main Section Info
     */
    
    public function main_section_info() {
        
        echo '<p>Here you can choose where to enable the Custom CSS and Custom JS boxes.</p>';
        
    } // END main_section_info()
    
    /**
     * CALLBACK:
     * Print Post Type selection boxes
     */
    public function choose_post_type() {
        
        if ( ! isset( $this->options[ 'use_on_page' ] ) ) $this->options[ 'use_on_page' ] = 0;
        if ( ! isset( $this->options[ 'use_on_post' ] ) ) $this->options[ 'use_on_post' ] = 1;
        ?>
       
            <input type="checkbox" id="use_on_page" name="use_on_page" value="1" <?php checked( $this->options[ 'use_on_page' ], 1 ); ?> />
            <label for="use_on_page" class="note"><?php _e( 'Use on Pages?', 'jkl-page-scripts-styles' ); ?></label>
            <br>
            <input type="checkbox" id="use_on_post" name="use_on_post" value="1" <?php checked( $this->options[ 'use_on_post' ], 1 ); ?> />
            <label for="use_on_post" class="note"><?php _e( 'Use on Posts?', 'jkl-page-scripts-styles' ); ?></label>
        
    <?php
    } // END choose_post_type()
    
    /**
     * CALLBACK:
     * Print Custom CSS and Custom JS selection boxes
     */
    public function enable_boxes() {
        
        if ( ! isset( $this->options[ 'use_custom_css' ] ) ) $this->options[ 'use_custom_css' ] = 1;
        if ( ! isset( $this->options[ 'use_custom_js' ] ) ) $this->options[ 'use_custom_js' ] = 1;
        ?>
        
            <input type="checkbox" id="use_custom_css" name="use_custom_css" value="1" <?php checked( $this->options[ 'use_custom_css' ], 1 ); ?> />
            <label for="use_custom_css" class="note"><?php _e( 'Enable Custom CSS Metabox', 'jkl-page-scripts-styles' ); ?></label>
            <br>
            <input type="checkbox" id="use_custom_js" name=use_custom_js" value="1" <?php checked( $this->options[ 'use_custom_js' ], 1 ); ?> />
            <label for="use_custom_js" class="note"><?php _e( 'Enable Custom JS Metabox', 'jkl-page-scripts-styles' ); ?></label>
        
    <?php    
    } // END custom_css()
    
    
} // END JKL_Page_SS_Settings
} // END if ( ! class_exists() )