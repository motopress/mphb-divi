<?php
if ( ! class_exists( 'MPHB_Divi_Booking_Form_Module' ) && class_exists( 'ET_Builder_Module' ) ) :

	class MPHB_Divi_Booking_Form_Module extends ET_Builder_Module {

		public $slug       = 'mphb-divi-booking-form';
		public $vb_support = 'on';

		public function init() {

			$this->name = esc_html__( 'HB Booking Form', 'mphb-divi' );
		}

		public function get_fields() {

			return array(
				'id'         => array(
					'label'            => esc_html__( 'ID', 'mphb-divi' ),
					'description'      => esc_html__( 'ID of accommodation type.', 'mphb-divi' ),
					'type'             => 'text',
					'default'          => '',
					'computed_affects' => array(
						'__form',
					),
				),
				'form_style' => array(
					'label'            => esc_html__( 'Style', 'mphb-divi' ),
					'type'             => 'select',
					'options'          => array(
						'default'    => esc_html__( 'Default', 'mphb-divi' ),
						'horizontal' => esc_html__( 'Horizontal', 'mphb-divi' ),
					),
					'default'          => 'default',
					'computed_affects' => array(
						'__form',
					),
				),
				'class'      => array(
					'label'            => esc_html__( 'Class', 'mphb-divi' ),
					'description'      => esc_html__( 'Custom CSS class for shortcode wrapper.', 'mphb-divi' ),
					'type'             => 'text',
					'default'          => '',
					'computed_affects' => array(
						'__form',
					),
				),
				'__form'     => array(
					'type'                => 'computed',
					'computed_callback'   => array( 'MPHB_Divi_Booking_Form_Module', 'get_booking_form' ),
					'computed_depends_on' => array(
						'class',
						'form_style',
						'id',
					),
				),

			);
		}

		public function render( $attrs, $content, $render_slug ) {

			return self::get_booking_form( $this->props );
		}


		public static function get_booking_form( $args = array() ) {
			return MPHB_Divi_Renderers::booking_form( $args );
		}
	}

	new MPHB_Divi_Booking_Form_Module();

endif;
