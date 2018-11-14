<?php
/**
 * Plugin Name: Hotel Booking & Divi Integration
 * Description: Integrates Divi theme with the MotoPress Hotel Booking plugin to modify content and styles visually via Divi builder.
 * Version: 1.0.1
 * Author: MotoPress
 * Author URI: https://motopress.com/
 * License: GPLv2 or later
 * Text Domain: mphb-divi
 * Domain Path: /languages
 **/

if ( !class_exists( 'MPHB_Divi' ) && class_exists( 'HotelBookingPlugin' ) ) {
    add_action( 'divi_extensions_init', 'mphb_divi_init' );
}


if( !function_exists( 'mphb_divi_init' ) ):
    function mphb_divi_init() {
        require( plugin_dir_path( __FILE__ ) . 'plugin.php' );
    }
endif;