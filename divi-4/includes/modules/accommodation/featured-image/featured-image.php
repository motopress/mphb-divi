<?php

class MPHB_Divi_Accommodation_Type_Featured_Image_Module extends MPHB_Divi_Abstract_Accommodation_Module {

	public $slug = 'mphb-divi-accommodation-type-featured-image';

	public function init() {
		$this->name = esc_html__( 'HB Acc. Type Featured Image', 'mphb-divi' );
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
			'image_size'   => array(
				'label'            => esc_html__( 'Image size', 'mphb-divi' ),
				'type'             => 'select',
				'options'          => $this->get_image_sizes_select(),
				'default'          => 'large',
				'computed_affects' => array(
					'__html',
				),
			),
		);
	}

	public function mphb_render_depends_on() {
		return array( 'link_to_post', 'image_size' );
	}

	public static function get_html( $attrs = array() ) {
		return MPHB_Divi_Renderers::accommodation_featured_image( $attrs );
	}
}

new MPHB_Divi_Accommodation_Type_Featured_Image_Module();
