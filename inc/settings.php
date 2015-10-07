<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Page_SS_Settings' ) ) {
/**
 * JKL Page Scripts & Styles Settings
 * Doc: https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 * 
 * @package JKL-Page-ScriptsStyles
 * @author Aaron Snowberger
 */
    
class JKL_Page_SS_Settings {
    /**
     * Be sure we're using the most recent version - don't load old cached files
     * @var type 
     */
    private $version;
    
    /**
     * CONSTRUCTOR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     * @param type $version
     */
    public function __construct( /*$version*/ ) {
        
        //$this->version = $version;
        
    } // END __construct()
} // END JKL_Page_SS_Settings
} // END if ( ! class_exists() )