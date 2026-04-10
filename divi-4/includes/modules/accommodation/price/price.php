<?php

use MPHB\Views\SingleRoomTypeView;

class MPHB_Divi_Accommodation_Type_Price_Module extends MPHB_Divi_Abstract_Accommodation_Module {

	public $slug = 'mphb-divi-accommodation-type-price';

	public function init() {
		$this->name = esc_html__( 'HB Acc. Type Price', 'mphb-divi' );
	}

	public static function get_html( $attrs = array() ) {
		return MPHB_Divi_Renderers::accommodation_price( $attrs );
	}
}

new MPHB_Divi_Accommodation_Type_Price_Module();
