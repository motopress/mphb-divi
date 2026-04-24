<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'mphb-divi/search-availability'          => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/search-availability',
		'renderer' => 'search_availability',
	),
	'mphb-divi/rooms'                        => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/rooms',
		'renderer' => 'rooms',
	),
	'mphb-divi/single-accommodation'         => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/single-accommodation',
		'renderer' => 'single_accommodation',
	),
	'mphb-divi/services'                     => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/services',
		'renderer' => 'services',
	),
	'mphb-divi/rates'                        => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/rates',
		'renderer' => 'rates',
	),
	'mphb-divi/booking-form'                 => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/booking-form',
		'renderer' => 'booking_form',
	),
	'mphb-divi/availability-calendar'        => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/availability-calendar',
		'renderer' => 'availability_calendar',
	),
	'mphb-divi/booking-confirmation'         => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/booking-confirmation',
		'renderer' => 'booking_confirmation',
	),
	'mphb-divi/checkout'                     => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/checkout',
		'renderer' => 'checkout',
	),
	'mphb-divi/search-results'               => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/search-results',
		'renderer' => 'search_results',
	),
	'mphb-divi/accommodation-title'          => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/accommodation-title',
		'renderer' => 'accommodation_title',
	),
	'mphb-divi/accommodation-price'          => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/accommodation-price',
		'renderer' => 'accommodation_price',
	),
	'mphb-divi/accommodation-gallery'        => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/accommodation-gallery',
		'renderer' => 'accommodation_gallery',
	),
	'mphb-divi/accommodation-featured-image' => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/accommodation-featured-image',
		'renderer' => 'accommodation_featured_image',
	),
	'mphb-divi/accommodation-content'        => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/accommodation-content',
		'renderer' => 'accommodation_content',
	),
	'mphb-divi/accommodation-attributes'     => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/accommodation-attributes',
		'renderer' => 'accommodation_attributes',
	),
	'mphb-divi/accommodation-attribute'      => array(
		'path'     => dirname( __DIR__ ) . '/visual-builder/src/modules/accommodation-attribute',
		'renderer' => 'accommodation_attribute',
	),
);
