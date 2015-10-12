<?php

/**
 * Represents the Custom CSS and JS Meta Boxes.
 * 
 * @since       0.1.0
 * 
 * @package     JKL_Page_Scripts_Styles
 * @subpackage  JKL_Page_Scripts_Styles/admin
 * @author      Aaron Snowberger <jekkilekki@gmail.com>
 */

/**
 * Represents the Custom CSS and JS Meta Boxes.
 * 
 * Registers the meta boxes with the WordPress API, sets the properties and 
 * renders the content by including the markup from its associated view.
 */

if ( ! defined( 'ABSPATH' ) ) exit;
//if ( ! class_exists( JKL_Page_SS_Meta_Box ) ) {
    
class JKL_Page_SS_Meta_Box {
    
    /**
     * Register this class with the WordPress API
     * 
     * @since   0.1.0
     */
    public function __construct() {
        
        add_action( 'add_meta_boxes', array( $this, 'jkl_add_meta_box' ) );
        add_action( 'save_post', array( $this, 'jkl_save_post' ) );
        
    } // END __construct()
    
    /**
     * This function is responsible for creating the actual meta box
     * 
     * @since 0.1.0
     */
    public function jkl_add_meta_box() {
        
        //$options = $this->get_option( 'jkl_pagess_settings' );
        
        add_meta_box(
                'jkl-page-ss',
                __( 'JKL Page Scripts & Styles', 'jkl-page-scripts-styles' ),
                array( $this, 'jkl_display_meta_box' ),
                'post',     // @TODO: Later, let the settings determine where to create this : $options[],
                'normal',
                'default'
        );
        
    } // END jkl_add_meta_box()
    
    /**
     * Render the content of the meta box
     * 
     * @since 0.1.0
     */
    public function jkl_display_meta_box() {
        
        include_once( 'views/jkl-page-ss-navigation.php' );
        
    } // END jkl_display_meta_box
    
    /**
     * Sanitizes and serializes the information associated with this post.
     * 
     * @since   0.1.0
     * 
     * @param   int     $post_id    The ID of the post that's currently being edited.
     */
    public function jkl_save_post() {
        
        // If not the right Post type or the user doesn't have privilege to save, exit
        if ( ! $this->jkl_is_valid_post_type() || ! $this->jkl_user_can_save( $post_id, 'jkl_page_ss_nonce', 'jkl_page_ss_save' ) ) {
            exit;
        }
        
    } // END jkl_save_post()
    
    /**
     * Verifies that the post type being saved is actually a Post.
     * 
     * @since   0.1.0
     * @access  private
     * @return  bool    Return true if we're in a post.
     */
    private function jkl_is_valid_post_type() {
        return ! empty( $_POST[ 'post_type' ] ) && 'post' == $_POST[ 'post_type' ];
    }
    
    /**
     * Determines whether or not this user has the ability to Save the post
     * 
     * @since   0.1.0
     * @access  private
     * @param   int     $post_id        The ID of the post being saved.
     * @param   string  $nonce_action   The name of the action associated with the nonce.
     * @param   string  $nonce_id       The ID of the nonce field.
     * @return  bool                    Whether or not the user has the ability to Save.
     */
    private function jkl_user_can_save( $post_id, $nonce_action, $nonce_id ) {
        
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ $nonce_action ] ) && wp_verify_nonce( $_POST[ $nonce_action ], $nonce_id ) );
        
        // Return true if the user is able to save
        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
        
    }
    
} // END JKL_Page_SS_Meta_Box
//} // END if ( ! class_exists() )