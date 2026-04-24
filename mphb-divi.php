<?php
/**
 * Plugin Name: Hotel Booking & Divi Integration
 * Plugin URI: https://motopress.com/products/hotel-booking-divi-theme-integration/
 * Description: Integrates Divi theme with the MotoPress Hotel Booking plugin to modify content and styles visually via Divi builder.
 * Version: 2.0.0
 * Author: MotoPress
 * Author URI: https://motopress.com/
 * License: GPLv2 or later
 * Text Domain: mphb-divi
 * Domain Path: /languages
 **/

if ( ! defined( 'MPHB_DIVI_VERSION' ) ) {
	define( 'MPHB_DIVI_VERSION', '2.0.0' );
}

if ( ! function_exists( 'mphb_divi_init' ) && class_exists( 'HotelBookingPlugin' ) ) :

	require_once plugin_dir_path( __FILE__ ) . 'src/renderers.php';
	require_once plugin_dir_path( __FILE__ ) . 'divi-5/php/bootstrap.php';
	require_once plugin_dir_path( __FILE__ ) . 'src/functions.php';

	add_action( 'divi_extensions_init', 'mphb_divi_init' );
	add_action( 'wp_enqueue_scripts', 'mphb_divi_enqueue_assets' );
	add_action( 'customize_preview_init', 'mphb_divi_enqueue_customizer_assets' );

	function mphb_divi_init() {
		require_once plugin_dir_path( __FILE__ ) . 'divi-4/includes/mphb.php';
	}

	function mphb_divi_enqueue_assets() {
		wp_enqueue_style( 'mphb-divi-style', plugin_dir_url( __FILE__ ) . 'assets/style.css', array(), MPHB_DIVI_VERSION );
	}

	function mphb_divi_enqueue_customizer_assets() {
		wp_enqueue_script( 'mphb-divi-customize-preview', plugin_dir_url( __FILE__ ) . 'assets/customize-preview.js', array( 'jquery', 'customize-preview' ), MPHB_DIVI_VERSION, true );
	}

endif;
