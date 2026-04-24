<?php

use MPHB\Views\LoopRoomTypeView;
use MPHB\Views\SingleRoomTypeView;

class MPHB_Divi_Accommodation_Type_Gallery_Module extends MPHB_Divi_Abstract_Accommodation_Module {

	public $slug = 'mphb-divi-accommodation-type-gallery';

	public function init() {
		$this->name = esc_html__( 'HB Acc. Type Gallery', 'mphb-divi' );
	}

	public function mphb_get_fields() {
		return array(
			'image_size'  => array(
				'label'            => esc_html__( 'Image size', 'mphb-divi' ),
				'type'             => 'select',
				'options'          => $this->get_image_sizes_select(),
				'computed_affects' => array(
					'__html',
				),
			),
			'is_slider'   => array(
				'label'            => esc_html__( 'Display as slider', 'mphb-divi' ),
				'description'      => esc_html__( 'Check it out on the frontend once applied.', 'mphb-divi' ),
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
			'columns'     => array(
				'label'            => esc_html__( 'Columns', 'mphb-divi' ),
				'type'             => 'range',
				'default'          => '4',
				'range_settings'   => array(
					'min'  => '1',
					'max'  => '9',
					'step' => '1',
				),
				'computed_affects' => array(
					'__html',
				),
			),
			'link_to'     => array(
				'label'            => esc_html__( 'Link to', 'mphb-divi' ),
				'type'             => 'select',
				'options'          => array(
					''     => esc_html__( 'Default', 'mphb-divi' ),
					'none' => esc_html__( 'None', 'mphb-divi' ),
					'file' => esc_html__( 'File', 'mphb-divi' ),
				),
				'computed_affects' => array(
					'__html',
				),
			),
			'is_lightbox' => array(
				'label'            => esc_html__( 'Open in lightbox', 'mphb-divi' ),
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
		return array( 'columns', 'image_size', 'link_to', 'is_lightbox' );
	}

	public static function get_html( $attrs = array() ) {
		return MPHB_Divi_Renderers::accommodation_gallery( $attrs );
	}
}

new MPHB_Divi_Accommodation_Type_Gallery_Module();
