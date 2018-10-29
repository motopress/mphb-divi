<?php
/**
 * Plugin Name: Hotel Booking & Divi Integration
 * Description: This plugin integrates your Divi theme with a popular MotoPress Hotel Booking plugin.
 * Version: 1.0.0
 * Author: MotoPress
 * Author URI: https://motopress.com/
 * License: GPLv2 or later
 * Text Domain: mphb-divi
 * Domain Path: /languages
 **/

if ( !class_exists( 'MPHB_Divi' ) && class_exists( 'HotelBookingPlugin' ) ) {
    add_action( 'init', 'mphb_divi_init' );
}


if( !function_exists( 'mphb_divi_init' ) ):
    function mphb_divi_init() {
        if( ( defined( 'ET_BUILDER_THEME' ) && ET_BUILDER_THEME ) || function_exists( 'et_divi_fonts_url' ) || class_exists( 'ET_Builder_Plugin' ) ){
            require( plugin_dir_path( __FILE__ ) . 'plugin.php' );
        }
    }
endif;