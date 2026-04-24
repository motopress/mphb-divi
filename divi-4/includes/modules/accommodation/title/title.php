<?php

class MPHB_Divi_Accommodation_Type_Title_Module extends MPHB_Divi_Abstract_Accommodation_Module {

	public $slug = 'mphb-divi-accommodation-type-title';

	public function init() {
		$this->name = esc_html__( 'HB Acc. Type Title', 'mphb-divi' );
	}

	public function mphb_get_fields() {
		return array(
			'link_to_post' => array(
				'label'            => esc_html__( 'Link to post', 'mphb-divi' ),
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

	public function mphb_render_depends_on() {
		return array( 'link_to_post' );
	}

	public static function get_html( $attrs = array() ) {
		return MPHB_Divi_Renderers::accommodation_title( $attrs );
	}
}

new MPHB_Divi_Accommodation_Type_Title_Module();
