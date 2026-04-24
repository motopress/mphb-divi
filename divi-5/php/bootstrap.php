<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'mphb_divi_5_get_accommodation_attribute_options' ) ) {
	function mphb_divi_5_get_accommodation_attribute_options() {
		$attributes = array(
			array(
				'slug'  => 'adults',
				'title' => __( 'Adults', 'mphb-divi' ),
			),
			array(
				'slug'  => 'children',
				'title' => __( 'Children', 'mphb-divi' ),
			),
			array(
				'slug'  => 'capacity',
				'title' => __( 'Capacity', 'mphb-divi' ),
			),
			array(
				'slug'  => 'amenities',
				'title' => __( 'Amenities', 'mphb-divi' ),
			),
			array(
				'slug'  => 'view',
				'title' => __( 'View', 'mphb-divi' ),
			),
			array(
				'slug'  => 'size',
				'title' => __( 'Size', 'mphb-divi' ),
			),
			array(
				'slug'  => 'bed-types',
				'title' => __( 'Bed Types', 'mphb-divi' ),
			),
			array(
				'slug'  => 'categories',
				'title' => __( 'Categories', 'mphb-divi' ),
			),
		);

		global $mphbAttributes; // phpcs:ignore

		foreach ( (array) $mphbAttributes as $custom_attribute ) { // phpcs:ignore
			if ( empty( $custom_attribute['attributeName'] ) ) {
				continue;
			}

			$item = array(
				'slug'  => (string) $custom_attribute['attributeName'],
				'title' => isset( $custom_attribute['title'] ) ? (string) $custom_attribute['title'] : (string) $custom_attribute['attributeName'],
			);

			$attributes[] = $item;
		}

		return $attributes;
	}
}

if ( ! function_exists( 'mphb_divi_5_get_accommodation_type_options' ) ) {
	function mphb_divi_5_get_accommodation_type_options() {
		$posts = get_posts(
			array(
				'post_type'      => 'mphb_room_type',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => array(
					'menu_order' => 'ASC',
					'title'      => 'ASC',
				),
			)
		);

		return array_map(
			static function ( $post ) {
				return array(
					'id'    => (int) $post->ID,
					'title' => get_the_title( $post ),
				);
			},
			$posts
		);
	}
}

if ( ! function_exists( 'mphb_divi_5_get_image_size_options' ) ) {
	function mphb_divi_5_get_image_size_options() {
		global $_wp_additional_image_sizes;

		$sizes = array();

		foreach ( get_intermediate_image_sizes() as $size ) {
			if ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
				$width  = (int) $_wp_additional_image_sizes[ $size ]['width'];
				$height = (int) $_wp_additional_image_sizes[ $size ]['height'];
			} else {
				$width  = (int) get_option( "{$size}_size_w" );
				$height = (int) get_option( "{$size}_size_h" );
			}

			$sizes[ $size ] = sprintf(
				'%1$s - %2$d x %3$d',
				ucwords( strtolower( preg_replace( '/[-_]/', ' ', $size ) ) ),
				$width,
				$height
			);
		}

		$sizes['full'] = __( 'Full Size', 'mphb-divi' );

		return $sizes;
	}
}

$mphb_divi_5_module_map = require __DIR__ . '/module-map.php';

add_action(
	'divi_module_library_modules_dependency_tree',
	static function ( $dependency_tree ) use ( $mphb_divi_5_module_map ) {
		if ( ! interface_exists( 'ET\\Builder\\Framework\\DependencyManagement\\Interfaces\\DependencyInterface' ) ) {
			return;
		}

		require_once __DIR__ . '/modules.php';

		$dependency_tree->add_dependency( new MPHB_Divi_5_Modules( $mphb_divi_5_module_map ) );
	}
);

add_action(
	'divi_visual_builder_assets_before_enqueue_scripts',
	static function () {
		if ( ! function_exists( 'et_core_is_fb_enabled' ) || ! et_core_is_fb_enabled() || ! function_exists( 'et_builder_d5_enabled' ) || ! et_builder_d5_enabled() ) {
			return;
		}

		$build = dirname( __DIR__ ) . '/visual-builder/build/mphb-divi-d5.js';

		if ( ! file_exists( $build ) || ! class_exists( '\ET\Builder\VisualBuilder\Assets\PackageBuildManager' ) ) {
			return;
		}

		\ET\Builder\VisualBuilder\Assets\PackageBuildManager::register_package_build(
			array(
				'name'    => 'mphb-divi-d5-visual-builder',
				'version' => MPHB_DIVI_VERSION,
				'script'  => array(
					'src'                => plugin_dir_url( dirname( __DIR__ ) ) . 'divi-5/visual-builder/build/mphb-divi-d5.js',
					'deps'               => array(
						'jquery',
						'divi-module-library',
						'divi-vendor-wp-hooks',
						'divi-rest',
					),
					'enqueue_top_window' => false,
					'enqueue_app_window' => true,
					'data_app_window'    => array(
						'accommodationAttributes' => mphb_divi_5_get_accommodation_attribute_options(),
						'accommodationTypes'      => mphb_divi_5_get_accommodation_type_options(),
						'imageSizes'              => mphb_divi_5_get_image_size_options(),
					),
				),
			)
		);

		wp_enqueue_script( 'mphb-flexslider' );
		wp_enqueue_style( 'mphb-flexslider-css' );
	}
);
