<?php

class MPHB_Divi_Accommodation_Type_Content_Module extends MPHB_Divi_Abstract_Accommodation_Module {

	public $slug = 'mphb-divi-accommodation-type-content';

	public function init() {
		$this->name = esc_html__( 'HB Acc. Type Content', 'mphb-divi' );
	}

	public static function get_html( $attrs = array() ) {
		return MPHB_Divi_Renderers::accommodation_content( $attrs );
	}
}

new MPHB_Divi_Accommodation_Type_Content_Module();
