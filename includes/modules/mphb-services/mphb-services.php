<?php
if(!class_exists('MPHB_Divi_Services_Module') && class_exists('ET_Builder_Module')):

    class MPHB_Divi_Services_Module extends ET_Builder_Module{

        public $slug = 'mphb-divi-services';
        public $vb_support = 'on';

        function init(){

            $this->name = esc_html__( 'Accom. Services', 'mphb-divi' );

        }

        function get_fields(){

            return array(
                'ids' => array(
                    'label'           => esc_html__( 'IDs', 'mphb-divi' ),
                    'description'     => esc_html__( 'Comma-separated IDs of services that will be shown. All services by default.', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__services',
                    ),
                ),
                'class' => array(
                    'label'           => esc_html__( 'Class', 'mphb-divi' ),
                    'description'     => esc_html__( 'Custom CSS class for shortcode wrapper.', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__services',
                    ),
                ),
                '__services' => array(
                    'type' => 'computed',
                    'computed_callback' => array( 'MPHB_Divi_Services_Module', 'get_services' ),
                    'computed_depends_on' => array(
                        'ids',
                        'class'
                    ),
                )

            );

        }

        function render($attrs, $content = null, $render_slug){

            $ids = $this->props['ids'];
            $class = $this->props['class'];

            return do_shortcode('[mphb_services class="'.$class.'" id="'.$ids.'"]');

        }


        static function get_services($args = array()){

            $defaults = array(
                'ids' => '',
                'class' => ''
            );

            $args = wp_parse_args($args, $defaults);

            return do_shortcode('[mphb_services class="'.$args['class'].'" ids="'.$args['ids'].'"]');

        }

    }

    new MPHB_Divi_Services_Module();

endif;
