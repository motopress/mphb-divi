<?php

use MPHB\Views\SingleRoomTypeView;

class MPHB_Divi_Accommodation_Type_Attributes_Module extends MPHB_Divi_Abstract_Accommodation_Module {

	public $slug                      = 'mphb-divi-accommodation-type-attributes';
	private static $custom_attributes = array();
	private static $hidden_attributes = array();
	private static $removed_actions   = array();
	private static $setting_to_action = array(
		'adults'     => array( 'renderAdults' ),
		'children'   => array( 'renderChildren' ),
		'capacity'   => array( 'renderTotalCapacity' ),
		'amenities'  => array( 'renderFacilities' ),
		'view'       => array( 'renderView' ),
		'size'       => array( 'renderSize' ),
		'bed-types'  => array( 'renderBedType' ),
		'categories' => array( 'renderCategories' ),
	);

	public function init() {
		$this->name = esc_html__( 'HB Acc. Type Attributes', 'mphb-divi' );
	}

	public function mphb_get_fields() {

		$attributes = self::get_accommodations_attributes_to_select();

		$default = implode( ',', array_keys( $attributes ) );

		return array(
			'selected_attributes' => array(
				'label'            => esc_html__( 'Attributes', 'mphb-divi' ),
				'type'             => 'mphb_multiple_checkboxes',
				'options'          => $attributes,
				'default'          => $default,
				'computed_affects' => array(
					'__html',
				),
			),
		);
	}

	public function mphb_render_depends_on() {
		return array( 'selected_attributes' );
	}

	public static function get_html( $attrs = array() ) {
		return MPHB_Divi_Renderers::accommodation_attributes( $attrs );
	}

	private static function apply_attributes_params() {
		add_action( 'mphb_render_single_room_type_before_attributes', array( self::class, 'remove_attributes_title' ), 0 );
		add_action( 'mphb_render_single_room_type_before_attributes', array( self::class, 'filter_attributes' ) );

		// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
		global $mphbAttributes; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase.Found
		self::$custom_attributes = $mphbAttributes;

		foreach ( self::$custom_attributes as $slug => $attribute ) {
			if ( self::should_hide_attr( $slug ) ) {
				$mphbAttributes[ $slug ]['visible'] = false;
			}
		}
		// phpcs:enable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
	}

	private static function restore_attributes_params() {
		foreach ( self::$removed_actions as $action => $priority ) {
			add_action( 'mphb_render_single_room_type_attributes', array( '\MPHB\Views\SingleRoomTypeView', $action ), $priority );
		}

		// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
		global $mphbAttributes; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase.Found
		$mphbAttributes = self::$custom_attributes;
		// phpcs:enable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
	}

	public static function remove_attributes_title() {
		$title_priority = has_action( 'mphb_render_single_room_type_before_attributes', array( '\MPHB\Views\SingleRoomTypeView', '_renderAttributesTitle' ) );
		remove_action( 'mphb_render_single_room_type_before_attributes', array( '\MPHB\Views\SingleRoomTypeView', '_renderAttributesTitle' ), $title_priority );
		remove_action( 'mphb_render_single_room_type_before_attributes', array( self::class, 'remove_attributes_title' ), 0 );
	}

	public static function filter_attributes() {
		foreach ( self::$setting_to_action as $setting => $actions ) {
			if ( self::should_hide_attr( $setting ) ) {
				foreach ( $actions as $action ) {
					$priority = has_action( 'mphb_render_single_room_type_attributes', array( '\MPHB\Views\SingleRoomTypeView', $action ) );

					if ( $priority ) {
						remove_action( 'mphb_render_single_room_type_attributes', array( '\MPHB\Views\SingleRoomTypeView', $action ), $priority );
						self::$removed_actions[ $action ] = $priority;
					}
				}
			}
		}
	}

	private static function should_hide_attr( $attr ) {
		return in_array( $attr, self::$hidden_attributes, true );
	}
}

new MPHB_Divi_Accommodation_Type_Attributes_Module();
