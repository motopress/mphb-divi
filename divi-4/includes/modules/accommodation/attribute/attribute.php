<?php

use MPHB\Views\SingleRoomTypeView;

class MPHB_Divi_Accommodation_Type_Attribute_Module extends MPHB_Divi_Abstract_Accommodation_Module {

	public $slug = 'mphb-divi-accommodation-type-attribute';


	public function init() {
		$this->name = esc_html__( 'HB Acc. Type Attribute', 'mphb-divi' );
	}

	public function mphb_get_fields() {

		$attributes = self::get_accommodations_attributes_to_select();

		return array(
			'selected_attribute' => array(
				'label'            => esc_html__( 'Attributes', 'mphb-divi' ),
				'type'             => 'select',
				'options'          => $attributes,
				'default'          => 'adults',
				'computed_affects' => array(
					'__html',
				),
			),
			'show_label'         => array(
				'label'            => esc_html__( 'Show label', 'mphb-divi' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'on'  => esc_html__( 'Yes', 'mphb-divi' ),
					'off' => esc_html__( 'No', 'mphb-divi' ),
				),
				'default'          => 'off',
				'computed_affects' => array(
					'__html',
				),
			),
		);
	}

	public static function get_html( $attrs = array() ) {
		return MPHB_Divi_Renderers::accommodation_attribute( $attrs );
	}
}

new MPHB_Divi_Accommodation_Type_Attribute_Module();
