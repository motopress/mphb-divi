<?php
if(!class_exists('MPHB_Divi_Search_Availability_Module') && class_exists('ET_Builder_Module')):

    class MPHB_Divi_Search_Availability_Module extends ET_Builder_Module {

        public $slug = 'mphb-divi-availability-search';
        public $vb_support = 'on';

        function init(){

            $this->name       = esc_html__( 'Availability Search Form', 'mphb-divi-integration' );
            $this->plural     = esc_html__( 'Availability Search Forms', 'mphb-divi-integration' );

        }

        function get_fields(){

            return array(
                'check_in_date' => array(
                    'label'           => esc_html__( 'Check-in date', 'mphb-divi-integration' ),
                    'type'            => 'text',
                    'default'           => '',
                    'description'     => esc_html__( 'Check-in date presetted in the search form. Format: d/m/Y', 'mphb-divi-integration' ),
                    'computed_affects'   => array(
                        '__form',
                    ),
                ),
                'check_out_date' => array(
                    'label'           => esc_html__( 'Check-out date', 'mphb-divi-integration' ),
                    'type'            => 'text',
                    'default'           => '',
                    'description'     => esc_html__( 'Check-out date presetted in the search form. Format: d/m/Y', 'mphb-divi-integration' ),
                    'computed_affects'   => array(
                        '__form',
                    ),
                ),
                'adults' => array(
                    'label'           => esc_html__( 'Adults', 'mphb-divi-integration' ),
                    'type'            => 'text',
                    'default'           => '',
                    'description'     => esc_html__( 'The number of adults presetted in the search form.', 'mphb-divi-integration' ),
                    'computed_affects'   => array(
                        '__form',
                    ),
                ),
                'children' => array(
                    'label'           => esc_html__( 'Children', 'mphb-divi-integration' ),
                    'type'            => 'input',
                    'default'           => '',
                    'description'     => esc_html__( 'The number of children presetted in the search form.', 'mphb-divi-integration' ),
                    'computed_affects'   => array(
                        '__form',
                    ),
                ),
                'attributes' => array(
                    'label'           => esc_html__( 'Attributes', 'mphb-divi-integration' ),
                    'type'            => 'textarea',
                    'description'     => esc_html__( 'Comma separated list of attributes.', 'mphb-divi-integration' ),
                    'computed_affects'   => array(
                        '__form',
                    ),
                ),
                'class' => array(
                    'label'           => esc_html__( 'Class', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Custom CSS class for shortcode wrapper.', 'mphb-divi-integration' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__form',
                    ),
                ),
                '__form' => array(
                    'type' => 'computed',
                    'computed_callback' => array( 'MPHB_Divi_Search_Availability_Module', 'get_form' ),
                    'computed_depends_on' => array(
                        'check_in_date',
                        'check_out_date',
                        'adults',
                        'children',
                        'attributes',
                        'class'
                    ),
                )
            );

        }

        function render($attrs, $content = null, $render_slug){

            $attributes = $this->props['attributes'];
            $check_in_date = $this->props['check_in_date'];
            $check_out_date = $this->props['check_out_date'];
            $adults = $this->props['adults'];
            $children = $this->props['children'];

            return do_shortcode('[mphb_availability_search attributes="'.$attributes.'"
                                                                    check_in_date="'.$check_in_date.'"
                                                                    check_out_date="'.$check_out_date.'"
                                                                    adults="'.$adults.'"
                                                                    children="'.$children.'"
                                                                    ]');

        }

        static function get_form($args = array()){

            $defaults = array(
                'check_in_date' => '',
                'check_out_date' => '',
                'adults' => '',
                'children' => '',
                'attributes' => '',
            );

            $args = wp_parse_args($args, $defaults);

            return do_shortcode('[mphb_availability_search attributes="'.$args['attributes'].'" 
                                                                    check_in_date="'.$args['check_in_date'].'" 
                                                                    check_out_date="'.$args['check_out_date'].'" 
                                                                    adults="'.$args['adults'].'" 
                                                                    children="'.$args['children'].'" 
                                                                    ]');

        }

    }

    new MPHB_Divi_Search_Availability_Module;

endif;
