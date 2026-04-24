<?php

class MPHB_Divi_Accommodation_Type_Attributes_Module extends MPHB_Divi_Abstract_Accommodation_Module {

	public $slug = 'mphb-divi-accommodation-type-attributes';

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
}

new MPHB_Divi_Accommodation_Type_Attributes_Module();
