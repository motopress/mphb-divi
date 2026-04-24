<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MPHB\Views\LoopRoomTypeView;
use MPHB\Views\SingleRoomTypeView;

if ( ! class_exists( 'MPHB_Divi_Renderers' ) ) {
	class MPHB_Divi_Renderers {
		private static $gallery_params               = array();
		private static $gallery_is_slider            = false;
		private static $attributes_custom            = array();
		private static $attributes_hidden            = array();
		private static $attributes_removed_actions   = array();
		private static $attribute_removed_actions    = array();
		private static $attribute_actions            = array(
			'adults'     => array(
				'label'   => array(
					'mphb_render_single_room_type_before_adults' => '_renderAdultsTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_adults' => '_renderAdultsListItemOpen',
					'mphb_render_single_room_type_after_adults'  => '_renderAdultsListItemClose',
				),
			),
			'children'   => array(
				'label'   => array(
					'mphb_render_single_room_type_before_children' => '_renderChildrenTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_children' => '_renderChildrenListItemOpen',
					'mphb_render_single_room_type_after_children'  => '_renderChildrenListItemClose',
				),
			),
			'capacity'   => array(
				'label'   => array(
					'mphb_render_single_room_type_before_total_capacity' => '_renderTotalCapacityTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_total_capacity' => '_renderTotalCapacityListItemOpen',
					'mphb_render_single_room_type_after_total_capacity'  => '_renderTotalCapacityListItemClose',
				),
			),
			'amenities'  => array(
				'label'   => array(
					'mphb_render_single_room_type_before_facilities' => '_renderFacilitiesTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_facilities' => '_renderFacilitiesListItemOpen',
					'mphb_render_single_room_type_after_facilities'  => '_renderFacilitiesListItemClose',
				),
			),
			'view'       => array(
				'label'   => array(
					'mphb_render_single_room_type_before_view' => '_renderViewTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_view' => '_renderViewListItemOpen',
					'mphb_render_single_room_type_after_view'  => '_renderViewListItemClose',
				),
			),
			'size'       => array(
				'label'   => array(
					'mphb_render_single_room_type_before_size' => '_renderSizeTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_size' => '_renderSizeListItemOpen',
					'mphb_render_single_room_type_after_size'  => '_renderSizeListItemClose',
				),
			),
			'bed-types'  => array(
				'label'   => array(
					'mphb_render_single_room_type_before_bed_type' => '_renderBedTypeTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_bed_type' => '_renderBedTypeListItemOpen',
					'mphb_render_single_room_type_after_bed_type'  => '_renderBedTypeListItemClose',
				),
			),
			'categories' => array(
				'label'   => array(
					'mphb_render_single_room_type_before_categories' => '_renderCategoriesTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_categories' => '_renderCategoriesListItemOpen',
					'mphb_render_single_room_type_after_categories'  => '_renderCategoriesListItemClose',
				),
			),
			'custom'     => array(
				'label'   => array(
					'mphb_render_single_room_type_before_custom_attribute' => '_renderCustomAttributesTitle',
				),
				'default' => array(
					'mphb_render_single_room_type_before_custom_attribute' => '_renderCustomAttributesListItemOpen',
					'mphb_render_single_room_type_after_custom_attribute'  => '_renderCustomAttributesListItemClose',
				),
			),
		);
		private static $attributes_setting_to_action = array(
			'adults'     => array( 'renderAdults' ),
			'children'   => array( 'renderChildren' ),
			'capacity'   => array( 'renderTotalCapacity' ),
			'amenities'  => array( 'renderFacilities' ),
			'view'       => array( 'renderView' ),
			'size'       => array( 'renderSize' ),
			'bed-types'  => array( 'renderBedType' ),
			'categories' => array( 'renderCategories' ),
		);

		public static function search_availability( $args = array() ) {
			$defaults = array(
				'check_in_date'  => '',
				'check_out_date' => '',
				'adults'         => '',
				'children'       => '',
				'attributes'     => '',
				'form_style'     => 'default',
				'class'          => '',
			);

			$args = wp_parse_args( $args, $defaults );

			if ( 'default' !== $args['form_style'] ) {
				$args['class'] .= ' ' . $args['form_style'];
			}

			return do_shortcode(
				self::build_shortcode(
					'mphb_availability_search',
					array(
						'attributes'     => $args['attributes'],
						'check_in_date'  => $args['check_in_date'],
						'check_out_date' => $args['check_out_date'],
						'adults'         => $args['adults'],
						'children'       => $args['children'],
						'class'          => trim( $args['class'] ),
					)
				)
			);
		}

		public static function rooms( $args = array() ) {
			$defaults = array(
				'title'          => '',
				'featured_image' => '',
				'gallery'        => '',
				'excerpt'        => '',
				'details'        => '',
				'price'          => '',
				'view_button'    => '',
				'book_button'    => '',
				'ids'            => '',
				'category'       => '',
				'tags'           => '',
				'relation'       => '',
				'posts_per_page' => '',
				'orderby'        => '',
				'order'          => '',
				'meta_key'       => '',
				'meta_value'     => '',
				'class'          => '',
			);

			$args = wp_parse_args( $args, $defaults );

			return do_shortcode( self::build_shortcode( 'mphb_rooms', $args ) );
		}

		public static function single_accommodation( $args = array() ) {
			$defaults = array(
				'title'          => '',
				'featured_image' => '',
				'gallery'        => '',
				'excerpt'        => '',
				'details'        => '',
				'price'          => '',
				'view_button'    => '',
				'book_button'    => '',
				'id'             => '',
				'class'          => '',
			);

			$args = wp_parse_args( $args, $defaults );

			if ( '' === $args['id'] ) {
				return esc_html__( 'Please insert accommodation id.', 'mphb-divi' );
			}

			return do_shortcode( self::build_shortcode( 'mphb_room', $args ) );
		}

		public static function services( $args = array() ) {
			$defaults = array(
				'ids'            => '',
				'class'          => '',
				'posts_per_page' => '',
				'orderby'        => '',
				'order'          => '',
				'meta_key'       => '',
				'meta_type'      => '',
			);

			$args = wp_parse_args( $args, $defaults );

			return do_shortcode( self::build_shortcode( 'mphb_services', $args ) );
		}

		public static function rates( $args = array() ) {
			$defaults = array(
				'id'    => '',
				'class' => '',
			);

			$args = wp_parse_args( $args, $defaults );

			if ( '' === $args['id'] ) {
				return esc_html__( 'Please insert accommodation id.', 'mphb-divi' );
			}

			return do_shortcode( self::build_shortcode( 'mphb_rates', $args ) );
		}

		public static function booking_form( $args = array() ) {
			$defaults = array(
				'id'         => '',
				'class'      => '',
				'form_style' => 'default',
			);

			$args = wp_parse_args( $args, $defaults );

			if ( 'default' !== $args['form_style'] ) {
				$args['class'] .= ' ' . $args['form_style'];
			}

			if ( '' === $args['id'] ) {
				return esc_html__( 'Please insert accommodation id.', 'mphb-divi' );
			}

			return do_shortcode(
				self::build_shortcode(
					'mphb_availability',
					array(
						'class' => trim( $args['class'] ),
						'id'    => $args['id'],
					)
				)
			);
		}

		public static function availability_calendar( $args = array() ) {
			$defaults = array(
				'id'               => '',
				'monthstoshow'     => '2,3',
				'display_price'    => false,
				'truncate_price'   => true,
				'display_currency' => false,
				'class'            => '',
			);

			$args = wp_parse_args( $args, $defaults );

			if ( '' === $args['id'] ) {
				return esc_html__( 'Please insert accommodation id.', 'mphb-divi' );
			}

			return do_shortcode(
				self::build_shortcode(
					'mphb_availability_calendar',
					array(
						'class'            => $args['class'],
						'id'               => $args['id'],
						'monthstoshow'     => $args['monthstoshow'],
						'display_price'    => 'on' === $args['display_price'] ? 1 : 0,
						'truncate_price'   => 'on' === $args['truncate_price'] ? 1 : 0,
						'display_currency' => 'on' === $args['display_currency'] ? 1 : 0,
					)
				)
			);
		}

		public static function booking_confirmation( $args = array() ) {
			$args = wp_parse_args( $args, array( 'class' => '' ) );
			return do_shortcode( self::build_shortcode( 'mphb_booking_confirmation', $args ) );
		}

		public static function checkout( $args = array() ) {
			$args = wp_parse_args( $args, array( 'class' => '' ) );
			return do_shortcode( self::build_shortcode( 'mphb_checkout', $args ) );
		}

		public static function search_results( $args = array() ) {
			$defaults = array(
				'title'           => '',
				'featured_image'  => '',
				'gallery'         => '',
				'excerpt'         => '',
				'details'         => '',
				'price'           => '',
				'view_button'     => '',
				'book_button'     => '',
				'orderby'         => '',
				'order'           => '',
				'meta_key'        => '',
				'meta_type'       => '',
				'default_sorting' => '',
				'class'           => '',
			);

			$args = wp_parse_args( $args, $defaults );

			return do_shortcode( self::build_shortcode( 'mphb_search_results', $args ) );
		}

		public static function accommodation_title( $attrs = array() ) {
			$id = self::resolve_accommodation_id( $attrs );

			if ( ! self::is_valid_room_type( $id ) ) {
				return '';
			}

			$link_to_post = isset( $attrs['link_to_post'] ) && 'on' === $attrs['link_to_post'];

			if ( $link_to_post ) {
				add_action( 'mphb_render_single_room_type_before_title', array( __CLASS__, 'render_link_open' ), 15 );
				add_action( 'mphb_render_single_room_type_after_title', array( __CLASS__, 'render_link_close' ), 5 );
			}

			try {
				return self::render_room_type_query(
					$id,
					static function () {
						SingleRoomTypeView::renderTitle();
					}
				);
			} finally {
				if ( $link_to_post ) {
					remove_action( 'mphb_render_single_room_type_before_title', array( __CLASS__, 'render_link_open' ), 15 );
					remove_action( 'mphb_render_single_room_type_after_title', array( __CLASS__, 'render_link_close' ), 5 );
				}
			}
		}

		public static function accommodation_featured_image( $attrs = array() ) {
			$id = self::resolve_accommodation_id( $attrs );

			if ( ! self::is_valid_room_type( $id ) ) {
				return '';
			}

			$link_to_post = isset( $attrs['link_to_post'] ) && 'on' === $attrs['link_to_post'];
			$size         = isset( $attrs['image_size'] ) ? $attrs['image_size'] : 'large';

			return self::capture(
				static function () use ( $id, $link_to_post, $size ) {
					?>
				<div class="mphb-single-room-type-thumbnail">
					<?php if ( $link_to_post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
					<?php endif; ?>
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo mphb_tmpl_get_room_type_image( $id, $size );
					?>
					<?php if ( $link_to_post ) : ?>
						</a>
					<?php endif; ?>
				</div>
					<?php
				}
			);
		}

		public static function accommodation_content( $attrs = array() ) {
			$id = self::resolve_accommodation_id( $attrs );

			if ( ! self::is_valid_room_type( $id ) ) {
				return '';
			}

			$query = new WP_Query(
				array(
					'p'         => $id,
					'post_type' => 'mphb_room_type',
				)
			);

			$output = self::capture(
				static function () use ( $query ) {
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							the_content();
						}
					}
				}
			);

			wp_reset_postdata();

			return $output;
		}

		public static function accommodation_price( $attrs = array() ) {
			$id = self::resolve_accommodation_id( $attrs );

			if ( ! self::is_valid_room_type( $id ) ) {
				return '';
			}

			return self::with_room_type(
				$id,
				static function () {
					return self::capture(
						static function () {
							SingleRoomTypeView::renderDefaultOrForDatesPrice();
						}
					);
				}
			);
		}

		public static function accommodation_gallery( $attrs = array() ) {
			$id = self::resolve_accommodation_id( $attrs );

			if ( ! self::is_valid_room_type( $id ) ) {
				return '';
			}

			$defaults = array(
				'link_to'     => '',
				'columns'     => '4',
				'image_size'  => '',
				'is_lightbox' => '',
			);

			self::$gallery_params    = wp_parse_args( $attrs, $defaults );
			self::$gallery_is_slider = isset( $attrs['is_slider'] ) && 'on' === $attrs['is_slider'];

			return self::with_room_type(
				$id,
				static function () {
					self::apply_gallery_filters();

					try {
						return self::capture(
							static function () {
								if ( self::$gallery_is_slider ) {
									LoopRoomTypeView::renderGallery();
								} else {
									SingleRoomTypeView::renderGallery();
								}
							}
						);
					} finally {
						self::restore_gallery_filters();
					}
				}
			);
		}

		public static function accommodation_attributes( $attrs = array() ) {
			$id = self::resolve_accommodation_id( $attrs );

			if ( ! self::is_valid_room_type( $id ) ) {
				return '';
			}

			$available_attributes             = array_keys( self::get_accommodation_attributes() );
			$selected_attributes              = ! empty( $attrs['selected_attributes'] ) ? explode( ',', $attrs['selected_attributes'] ) : $available_attributes;
			self::$attributes_hidden          = array_diff( $available_attributes, $selected_attributes );
			self::$attributes_removed_actions = array();

			return self::with_room_type(
				$id,
				static function () {
					self::apply_attributes_filters();

					try {
						return self::capture(
							static function () {
								SingleRoomTypeView::renderAttributes();
							}
						);
					} finally {
						self::restore_attributes_filters();
					}
				}
			);
		}

		public static function accommodation_attribute( $attrs = array() ) {
			$id = self::resolve_accommodation_id( $attrs );

			if ( ! self::is_valid_room_type( $id ) ) {
				return '';
			}

			$attribute                       = isset( $attrs['selected_attribute'] ) ? $attrs['selected_attribute'] : 'adults';
			$show_label                      = isset( $attrs['show_label'] ) && in_array( $attrs['show_label'], array( 'on', 'yes' ), true );
			self::$attribute_removed_actions = array();

			return self::with_room_type(
				$id,
				static function () use ( $attribute, $show_label ) {
					return self::capture(
						static function () use ( $attribute, $show_label ) {
							self::render_attribute( $attribute, $show_label );
						}
					);
				}
			);
		}

		public static function render_link_open() {
			?>
			<a href="<?php the_permalink(); ?>">
			<?php
		}

		public static function render_link_close() {
			?>
			</a>
			<?php
		}

		public static function filter_gallery_link( $link ) {
			if ( ! empty( self::$gallery_params['link_to'] ) ) {
				$link = self::$gallery_params['link_to'];
			}

			if ( self::$gallery_is_slider ) {
				$link = 'none';
			}

			return $link;
		}

		public static function filter_gallery_columns( $columns ) {
			if ( ! empty( self::$gallery_params['columns'] ) ) {
				$columns = self::$gallery_params['columns'];
			}

			return $columns;
		}

		public static function filter_gallery_image_size( $size ) {
			if ( ! empty( self::$gallery_params['image_size'] ) ) {
				return self::$gallery_params['image_size'];
			}

			return $size;
		}

		public static function filter_gallery_lightbox( $lightbox ) {
			if ( isset( self::$gallery_params['is_lightbox'] ) && '' !== self::$gallery_params['is_lightbox'] ) {
				return 'on' === self::$gallery_params['is_lightbox'];
			}

			return $lightbox;
		}

		public static function filter_gallery_nav_slider() {
			return false;
		}

		public static function remove_default_slider_wrapper() {
			remove_action( 'mphb_render_loop_room_type_before_gallery', array( '\MPHB\Views\LoopRoomTypeView', '_renderImagesWrapperOpen' ), 10 );
			remove_action( 'mphb_render_loop_room_type_after_gallery', array( '\MPHB\Views\LoopRoomTypeView', '_renderImagesWrapperClose' ), 20 );
		}

		public static function filter_slider_classes( $slider_class ) {
			return 'mphb-flexslider-gallery-wrapper';
		}

		public static function render_slider_wrapper_open() {
			?>
			<div class="mphb-room-type-gallery-wrapper mphb-single-room-type-gallery-wrapper">
			<?php
		}

		public static function render_slider_wrapper_close() {
			?>
			</div>
			<?php
		}

		public static function filter_slider_attributes( $atts ) {
			$atts['minItems']  = 1;
			$atts['maxItems']  = (int) self::$gallery_params['columns'] ? (int) self::$gallery_params['columns'] : 1;
			$atts['move']      = 1;
			$atts['itemWidth'] = floor( 100 / $atts['maxItems'] );

			return $atts;
		}

		public static function remove_attributes_title() {
			$title_priority = has_action( 'mphb_render_single_room_type_before_attributes', array( '\MPHB\Views\SingleRoomTypeView', '_renderAttributesTitle' ) );

			if ( $title_priority ) {
				remove_action( 'mphb_render_single_room_type_before_attributes', array( '\MPHB\Views\SingleRoomTypeView', '_renderAttributesTitle' ), $title_priority );
			}

			remove_action( 'mphb_render_single_room_type_before_attributes', array( __CLASS__, 'remove_attributes_title' ), 0 );
		}

		public static function filter_attributes() {
			foreach ( self::$attributes_setting_to_action as $setting => $actions ) {
				if ( ! in_array( $setting, self::$attributes_hidden, true ) ) {
					continue;
				}

				foreach ( $actions as $action ) {
					$priority = has_action( 'mphb_render_single_room_type_attributes', array( '\MPHB\Views\SingleRoomTypeView', $action ) );

					if ( $priority ) {
						remove_action( 'mphb_render_single_room_type_attributes', array( '\MPHB\Views\SingleRoomTypeView', $action ), $priority );
						self::$attributes_removed_actions[ $action ] = $priority;
					}
				}
			}
		}

		private static function build_shortcode( $tag, $attrs ) {
			$parts = array();

			foreach ( $attrs as $name => $value ) {
				$parts[] = sprintf( '%s="%s"', $name, esc_attr( (string) $value ) );
			}

			return '[' . $tag . ' ' . implode( ' ', $parts ) . ']';
		}

		private static function resolve_accommodation_id( $attrs ) {
			if ( isset( $attrs['accommodation_id'] ) && 'current' !== $attrs['accommodation_id'] ) {
				return (int) $attrs['accommodation_id'];
			}

			return self::current_post_id();
		}

		private static function current_post_id() {
			$post_id = get_the_ID();

			if ( $post_id ) {
				return (int) $post_id;
			}

			$post_id = get_queried_object_id();

			if ( $post_id ) {
				return (int) $post_id;
			}

			global $post;

			return isset( $post->ID ) ? (int) $post->ID : 0;
		}

		private static function is_valid_room_type( $id ) {
			return $id && 'mphb_room_type' === get_post_type( $id );
		}

		private static function capture( $callback ) {
			ob_start();
			$callback();
			return ob_get_clean();
		}

		private static function with_room_type( $id, $callback ) {
			$current_room_type = MPHB()->getCurrentRoomType();
			$fallback_id       = self::current_post_id();

			MPHB()->setCurrentRoomType( $id );

			try {
				return $callback();
			} finally {
				MPHB()->setCurrentRoomType( $current_room_type ? $current_room_type->getId() : $fallback_id );
			}
		}

		private static function render_room_type_query( $id, $callback ) {
			$query = new WP_Query(
				array(
					'p'         => $id,
					'post_type' => 'mphb_room_type',
				)
			);

			$output = self::capture(
				static function () use ( $query, $callback ) {
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							$callback();
						}
					}
				}
			);

			wp_reset_postdata();

			return $output;
		}

		private static function get_accommodation_attributes() {
			// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
			global $mphbAttributes; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase.Found

			$attributes = array(
				'adults'     => __( 'Adults', 'mphb-divi' ),
				'children'   => __( 'Children', 'mphb-divi' ),
				'capacity'   => __( 'Capacity', 'mphb-divi' ),
				'amenities'  => __( 'Amenities', 'mphb-divi' ),
				'view'       => __( 'View', 'mphb-divi' ),
				'size'       => __( 'Size', 'mphb-divi' ),
				'bed-types'  => __( 'Bed Types', 'mphb-divi' ),
				'categories' => __( 'Categories', 'mphb-divi' ),
			);

			foreach ( (array) $mphbAttributes as $custom_attribute ) {
				$attributes[ $custom_attribute['attributeName'] ] = $custom_attribute['title'];
			}
			// phpcs:enable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase

			return $attributes;
		}

		private static function apply_gallery_filters() {
			if ( self::$gallery_is_slider ) {
				add_filter( 'mphb_loop_room_type_gallery_main_slider_image_link', array( __CLASS__, 'filter_gallery_link' ) );
				add_filter( 'mphb_loop_room_type_gallery_main_slider_columns', array( __CLASS__, 'filter_gallery_columns' ) );
				add_filter( 'mphb_loop_room_type_gallery_main_slider_image_size', array( __CLASS__, 'filter_gallery_image_size' ) );
				add_filter( 'mphb_loop_room_type_gallery_use_nav_slider', array( __CLASS__, 'filter_gallery_nav_slider' ) );
				add_action( 'mphb_render_loop_room_type_before_gallery', array( __CLASS__, 'remove_default_slider_wrapper' ), 1 );
				add_action( 'mphb_render_loop_room_type_before_gallery', array( __CLASS__, 'render_slider_wrapper_open' ) );
				add_action( 'mphb_render_loop_room_type_after_gallery', array( __CLASS__, 'render_slider_wrapper_close' ) );
				add_filter( 'mphb_loop_room_type_gallery_main_slider_wrapper_class', array( __CLASS__, 'filter_slider_classes' ) );
				add_filter( 'mphb_loop_room_type_gallery_main_slider_flexslider_options', array( __CLASS__, 'filter_slider_attributes' ) );
			} else {
				add_filter( 'mphb_single_room_type_gallery_image_link', array( __CLASS__, 'filter_gallery_link' ) );
				add_filter( 'mphb_single_room_type_gallery_columns', array( __CLASS__, 'filter_gallery_columns' ) );
				add_filter( 'mphb_single_room_type_gallery_image_size', array( __CLASS__, 'filter_gallery_image_size' ) );
				add_filter( 'mphb_single_room_type_gallery_use_magnific', array( __CLASS__, 'filter_gallery_lightbox' ) );
			}
		}

		private static function restore_gallery_filters() {
			if ( self::$gallery_is_slider ) {
				remove_filter( 'mphb_loop_room_type_gallery_main_slider_image_link', array( __CLASS__, 'filter_gallery_link' ) );
				remove_filter( 'mphb_loop_room_type_gallery_main_slider_columns', array( __CLASS__, 'filter_gallery_columns' ) );
				remove_filter( 'mphb_loop_room_type_gallery_main_slider_image_size', array( __CLASS__, 'filter_gallery_image_size' ) );
				remove_filter( 'mphb_loop_room_type_gallery_use_nav_slider', array( __CLASS__, 'filter_gallery_nav_slider' ) );
				remove_action( 'mphb_render_loop_room_type_before_gallery', array( __CLASS__, 'remove_default_slider_wrapper' ), 1 );
				remove_action( 'mphb_render_loop_room_type_before_gallery', array( __CLASS__, 'render_slider_wrapper_open' ) );
				remove_action( 'mphb_render_loop_room_type_after_gallery', array( __CLASS__, 'render_slider_wrapper_close' ) );
				remove_filter( 'mphb_loop_room_type_gallery_main_slider_wrapper_class', array( __CLASS__, 'filter_slider_classes' ) );
				remove_filter( 'mphb_loop_room_type_gallery_main_slider_flexslider_options', array( __CLASS__, 'filter_slider_attributes' ) );
			} else {
				remove_filter( 'mphb_single_room_type_gallery_image_link', array( __CLASS__, 'filter_gallery_link' ) );
				remove_filter( 'mphb_single_room_type_gallery_columns', array( __CLASS__, 'filter_gallery_columns' ) );
				remove_filter( 'mphb_single_room_type_gallery_image_size', array( __CLASS__, 'filter_gallery_image_size' ) );
				remove_filter( 'mphb_single_room_type_gallery_use_magnific', array( __CLASS__, 'filter_gallery_lightbox' ) );
			}

			self::$gallery_params    = array();
			self::$gallery_is_slider = false;
		}

		private static function apply_attributes_filters() {
			add_action( 'mphb_render_single_room_type_before_attributes', array( __CLASS__, 'remove_attributes_title' ), 0 );
			add_action( 'mphb_render_single_room_type_before_attributes', array( __CLASS__, 'filter_attributes' ) );

			// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
			global $mphbAttributes;
			self::$attributes_custom = $mphbAttributes;

			foreach ( self::$attributes_custom as $slug => $attribute ) {
				if ( in_array( $slug, self::$attributes_hidden, true ) ) {
					$mphbAttributes[ $slug ]['visible'] = false;
				}
			}
			// phpcs:enable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
		}

		private static function restore_attributes_filters() {
			foreach ( self::$attributes_removed_actions as $action => $priority ) {
				add_action( 'mphb_render_single_room_type_attributes', array( '\MPHB\Views\SingleRoomTypeView', $action ), $priority );
			}

			// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
			global $mphbAttributes; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase.Found
			$mphbAttributes = self::$attributes_custom;
			// phpcs:enable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase

			remove_action( 'mphb_render_single_room_type_before_attributes', array( __CLASS__, 'remove_attributes_title' ), 0 );
			remove_action( 'mphb_render_single_room_type_before_attributes', array( __CLASS__, 'filter_attributes' ) );

			self::$attributes_custom          = array();
			self::$attributes_hidden          = array();
			self::$attributes_removed_actions = array();
		}

		private static function render_attribute( $attribute, $show_label ) {
			$custom_attribute = '';
			$all_attributes   = self::get_accommodation_attributes();

			// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
			global $mphbAttributes; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase.Found
			$original_attributes = $mphbAttributes;
			// phpcs:enable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase

			if ( isset( $all_attributes[ $attribute ] ) && ! isset( self::$attribute_actions[ $attribute ] ) ) {
				$custom_attribute = $attribute;
				$attribute        = 'custom';
			}

			// phpcs:ignore WordPress.NamingConventions
			do_action( 'mphb-templates/blocks/attribute/before', $attribute, $custom_attribute );

			try {
				self::before_attribute_render( $attribute, $show_label, $custom_attribute );

				switch ( $attribute ) {
					case 'adults':
						self::render_attribute_wrap(
							'mphb-room-type-adults-capacity',
							static function () {
								SingleRoomTypeView::renderAdults();
							}
						);
						break;
					case 'children':
						self::render_attribute_wrap(
							'mphb-room-type-children-capacity',
							static function () {
								SingleRoomTypeView::renderChildren();
							}
						);
						break;
					case 'capacity':
						self::render_attribute_wrap(
							'mphb-room-type-total-capacity',
							static function () {
								SingleRoomTypeView::renderTotalCapacity();
							}
						);
						break;
					case 'amenities':
						self::render_attribute_wrap(
							'mphb-room-type-facilities',
							static function () {
								SingleRoomTypeView::renderFacilities();
							}
						);
						break;
					case 'view':
						self::render_attribute_wrap(
							'mphb-room-type-view',
							static function () {
								SingleRoomTypeView::renderView();
							}
						);
						break;
					case 'size':
						self::render_attribute_wrap(
							'mphb-room-type-size',
							static function () {
								SingleRoomTypeView::renderSize();
							}
						);
						break;
					case 'bed-types':
						self::render_attribute_wrap(
							'mphb-room-type-bed-type',
							static function () {
								SingleRoomTypeView::renderBedType();
							}
						);
						break;
					case 'categories':
						self::render_attribute_wrap(
							'mphb-room-type-categories',
							static function () {
								SingleRoomTypeView::renderCategories();
							}
						);
						break;
					case 'custom':
						self::render_attribute_wrap(
							'mphb-room-type-' . $custom_attribute . ' mphb-room-type-custom-attribute',
							static function () {
								SingleRoomTypeView::renderCustomAttributes();
							}
						);
						break;
					default:
						?>
						<div class="mphb-single-room-type-attribute mphb-room-type-undefined-attribute">
							<?php esc_html_e( 'Please choose an attribute from available ones.', 'mphb-divi' ); ?>
						</div>
						<?php
						break;
				}
			} finally {
				// phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
				$mphbAttributes = $original_attributes;
				self::after_attribute_render();
			}

			// phpcs:ignore WordPress.NamingConventions
			do_action( 'mphb-templates/blocks/attribute/after', $attribute, $custom_attribute );
		}

		private static function render_attribute_wrap( $class_name, $callback ) {
			?>
			<div class="mphb-single-room-type-attribute <?php echo esc_attr( $class_name ); ?>">
				<?php $callback(); ?>
			</div>
			<?php
		}

		private static function before_attribute_render( $attribute, $show_label, $custom_attribute ) {
			if ( ! isset( self::$attribute_actions[ $attribute ] ) ) {
				return;
			}

			foreach ( self::$attribute_actions[ $attribute ]['default'] as $action => $callback ) {
				$priority = has_action( $action, array( '\MPHB\Views\SingleRoomTypeView', $callback ) );

				if ( $priority ) {
					remove_action( $action, array( '\MPHB\Views\SingleRoomTypeView', $callback ), $priority );
					self::$attribute_removed_actions[ $callback ] = array(
						'action'   => $action,
						'priority' => $priority,
					);
				}
			}

			if ( ! $show_label ) {
				foreach ( self::$attribute_actions[ $attribute ]['label'] as $action => $callback ) {
					$priority = has_action( $action, array( '\MPHB\Views\SingleRoomTypeView', $callback ) );

					if ( $priority ) {
						remove_action( $action, array( '\MPHB\Views\SingleRoomTypeView', $callback ), $priority );
						self::$attribute_removed_actions[ $callback ] = array(
							'action'   => $action,
							'priority' => $priority,
						);
					}
				}
			}

			if ( 'custom' === $attribute ) {
				// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
				global $mphbAttributes; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase.Found

				foreach ( (array) $mphbAttributes as $key => $current_attribute ) {
					if ( $key !== $custom_attribute ) {
						$mphbAttributes[ $key ]['visible'] = false;
					}
				}
				// phpcs:enable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
			}
		}

		private static function after_attribute_render() {
			foreach ( self::$attribute_removed_actions as $callback => $hook ) {
				add_action( $hook['action'], array( '\MPHB\Views\SingleRoomTypeView', $callback ), $hook['priority'] );
			}

			self::$attribute_removed_actions = array();
		}
	}
}
