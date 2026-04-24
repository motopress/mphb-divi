<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;
use ET\Builder\FrontEnd\Module\Style;
use ET\Builder\Framework\Utility\HTMLUtility;
use ET\Builder\Packages\Module\Module;
use ET\Builder\Packages\Module\Options\Css\CssStyle;
use ET\Builder\Packages\Module\Options\Element\ElementClassnames;
use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;

if ( ! class_exists( 'MPHB_Divi_5_Modules' ) ) {
	class MPHB_Divi_5_Modules implements DependencyInterface {
		private $module_map = array();

		public function __construct( $module_map ) {
			$this->module_map = $module_map;
		}

		public function load() {
			add_action( 'init', array( $this, 'register_modules' ) );
			add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
		}

		public function register_rest_routes() {
			register_rest_route(
				'mphb-divi/v1',
				'/render-module',
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'render_module_rest' ),
					'permission_callback' => static function () {
						return current_user_can( 'edit_posts' );
					},
				)
			);
		}

		public function register_modules() {
			foreach ( $this->module_map as $module_name => $config ) {
				$module_json = trailingslashit( $config['path'] ) . 'module.json';

				if ( ! file_exists( $module_json ) ) {
					continue;
				}

				ModuleRegistration::register_module(
					$config['path'],
					array(
						'render_callback' => function ( $attrs = array(), $content = '', $block = null, $elements = null ) use ( $module_name ) {
							return $this->render_module( $module_name, $attrs, $content, $block, $elements );
						},
					)
				);
			}
		}

		public function render_module( $module_name, $attrs, $content = '', $block = null, $elements = null ) {
			if ( ! isset( $this->module_map[ $module_name ]['renderer'] ) ) {
				return '';
			}

			$renderer = $this->module_map[ $module_name ]['renderer'];

			if ( ! is_callable( array( 'MPHB_Divi_Renderers', $renderer ) ) ) {
				return '';
			}

			$normalized = $this->normalize_module_atts( $attrs );
			$html       = call_user_func( array( 'MPHB_Divi_Renderers', $renderer ), $normalized );

			if ( ! $block || ! $elements || ! class_exists( Module::class ) ) {
				return $html;
			}

			$module_inner = HTMLUtility::render(
				array(
					'tag'               => 'div',
					'attributes'        => array(
						'class' => 'et_pb_module_inner',
					),
					'childrenSanitizer' => 'et_core_esc_previously',
					'children'          => $html,
				)
			);

			return Module::render(
				array(
					'orderIndex'          => $block->parsed_block['orderIndex'] ?? 0,
					'storeInstance'       => $block->parsed_block['storeInstance'] ?? null,
					'attrs'               => $attrs,
					'elements'            => $elements,
					'id'                  => $block->parsed_block['id'] ?? '',
					'name'                => $block->block_type->name ?? $module_name,
					'moduleCategory'      => $block->block_type->category ?? 'module',
					'classnamesFunction'  => array( __CLASS__, 'module_classnames' ),
					'stylesComponent'     => array( __CLASS__, 'module_styles' ),
					'scriptDataComponent' => array( __CLASS__, 'module_script_data' ),
					'children'            => $module_inner,
				)
			);
		}

		public function render_module_rest( $request ) {
			$module_name = $request->get_param( 'moduleName' );
			$attrs       = $request->get_param( 'attrs' );

			if ( ! is_string( $module_name ) || ! isset( $this->module_map[ $module_name ] ) ) {
				return new \WP_Error(
					'mphb_divi_invalid_module',
					esc_html__( 'Invalid Divi module.', 'mphb-divi' ),
					array(
						'status' => 400,
					)
				);
			}

			if ( ! is_array( $attrs ) ) {
				$attrs = array();
			}

			return rest_ensure_response(
				array(
					'html' => $this->render_module( $module_name, $attrs ),
				)
			);
		}

		public static function module_styles( $args ) {
			$elements = $args['elements'];

			Style::add(
				array(
					'id'            => $args['id'],
					'name'          => $args['name'],
					'orderIndex'    => $args['orderIndex'],
					'storeInstance' => $args['storeInstance'],
					'styles'        => array(
						$elements->style(
							array(
								'attrName'   => 'module',
								'styleProps' => array(
									'disabledOn'     => array(
										'disabledModuleVisibility' => $args['settings']['disabledModuleVisibility'] ?? null,
									),
								),
							)
						),
						CssStyle::style(
							array(
								'selector'  => $args['orderClass'],
								'attr'      => $args['attrs']['css'] ?? array(),
								'cssFields' => \WP_Block_Type_Registry::get_instance()->get_registered( $args['name'] )->customCssFields,
							)
						),
					),
				)
			);
		}

		public static function module_script_data( $args ) {
			$args['elements']->script_data(
				array(
					'attrName' => 'module',
				)
			);
		}

		public static function module_classnames( $args ) {
			$args['classnamesInstance']->add(
				ElementClassnames::classnames(
					array(
						'attrs' => $args['attrs']['module']['decoration'] ?? array(),
					)
				)
			);
		}

		public function normalize_module_atts( $attrs ) {

			if ( ! isset( $attrs['shortcode']['advanced'] ) ) {
				return $attrs;
			}

			$normalized = array();

			foreach ( $attrs['shortcode']['advanced'] as $attr => $value ) {

				if ( isset( $value['desktop']['value'] ) ) {
					$normalized[ $attr ] = $value['desktop']['value'];
				} else {
					$normalized[ $attr ] = $value;
				}

				if ( 'selected_attributes' === $attr && is_array( $normalized[ $attr ] ) ) {
					$normalized[ $attr ] = implode(
						',',
						array_filter(
							array_map( 'strval', $normalized[ $attr ] )
						)
					);
				}

				if ( 'selected_attribute' === $attr && is_array( $normalized[ $attr ] ) ) {
					$normalized[ $attr ] = ! empty( $normalized[ $attr ] ) ? (string) reset( $normalized[ $attr ] ) : '';
				}
			}

			return $normalized;
		}
	}
}
