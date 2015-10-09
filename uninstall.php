<?php
/**
 * JKL Page Scripts Styles Uninstall
 * 
 * @package JKL Page Scripts Styles
 * @author Aaron Snowberger
 */

// If uninstall not called from WordPress exit 
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit ();

// Delete option from options table 
delete_option( 'jkl_pagess_settings' );

//remove additional options and custom tables