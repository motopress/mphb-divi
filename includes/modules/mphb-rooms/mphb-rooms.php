<?php
if(!class_exists('MPHB_Divi_Rooms_Module') && class_exists('ET_Builder_Module')):

    class MPHB_Divi_Rooms_Module extends ET_Builder_Module{

        public $slug = 'mphb-divi-accommodations';
        public $vb_support = 'on';

        function init(){

            $this->name       = esc_html__( 'Accommodations list', 'mphb-divi-integration' );

        }

        function get_fields(){

            return array(
                'title' => array(
                    'label'           => esc_html__( 'Title', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Whether to display title of the accommodation type.', 'mphb-divi-integration' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi-integration' ),
                        'off' => esc_html__( 'No', 'mphb-divi-integration' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'featured_image' => array(
                    'label'           => esc_html__( 'Featured image', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Whether to display featured image of the accommodation type.', 'mphb-divi-integration' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi-integration' ),
                        'off' => esc_html__( 'No', 'mphb-divi-integration' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'gallery' => array(
                    'label'           => esc_html__( 'Gallery', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Whether to display gallery of the accommodation type.', 'mphb-divi-integration' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi-integration' ),
                        'off' => esc_html__( 'No', 'mphb-divi-integration' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'excerpt' => array(
                    'label'           => esc_html__( 'Excerpt', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Whether to display excerpt (short description) of the accommodation type.', 'mphb-divi-integration' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi-integration' ),
                        'off' => esc_html__( 'No', 'mphb-divi-integration' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'details' => array(
                    'label'           => esc_html__( 'Details', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Whether to display details of the accommodation type.', 'mphb-divi-integration' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi-integration' ),
                        'off' => esc_html__( 'No', 'mphb-divi-integration' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'price' => array(
                    'label'           => esc_html__( 'Price', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Whether to display price of the accommodation type.', 'mphb-divi-integration' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi-integration' ),
                        'off' => esc_html__( 'No', 'mphb-divi-integration' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'view_button' => array(
                    'label'           => esc_html__( 'View Button', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Whether to display "View Details" button with the link to accommodation type.', 'mphb-divi-integration' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi-integration' ),
                        'off' => esc_html__( 'No', 'mphb-divi-integration' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'book_button' => array(
                    'label'           => esc_html__( 'Book Button', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Whether to display "Book" button.', 'mphb-divi-integration' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi-integration' ),
                        'off' => esc_html__( 'No', 'mphb-divi-integration' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'ids' => array(
                    'label'           => esc_html__( 'IDs', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Comma-separated IDs of accommodations that will be shown.', 'mphb-divi-integration' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'class' => array(
                    'label'           => esc_html__( 'Class', 'mphb-divi-integration' ),
                    'description'     => esc_html__( 'Custom CSS class for shortcode wrapper.', 'mphb-divi-integration' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                '__rooms' => array(
                    'type' => 'computed',
                    'computed_callback' => array( 'MPHB_Divi_Rooms_Module', 'get_rooms' ),
                    'computed_depends_on' => array(
                        'title',
                        'featured_image',
                        'gallery',
                        'excerpt',
                        'details',
                        'price',
                        'view_button',
                        'book_button',
                        'ids',
                        'class'
                    ),
                )

            );

        }

        function render($attrs, $content = null, $render_slug){

            $title = $this->props['title'];
            $featured_image = $this->props['featured_image'];
            $gallery = $this->props['gallery'];
            $excerpt = $this->props['excerpt'];
            $details = $this->props['details'];
            $price = $this->props['price'];
            $view_button = $this->props['view_button'];
            $book_button = $this->props['book_button'];
            $ids = $this->props['ids'];
            $class = $this->props['class'];

            return do_shortcode('[mphb_rooms title="'.$title.'" 
                                                        featured_image="'.$featured_image.'" 
                                                        gallery="'.$gallery.'" 
                                                        excerpt="'.$excerpt.'" 
                                                        details="'.$details.'" 
                                                        price="'.$price.'" 
                                                        view_button="'.$view_button.'" 
                                                        book_button="'.$book_button.'" 
                                                        ids="'.$ids.'"
                                                        class="'.$class.'"
                                                        ]');

        }

        static function get_rooms($args = array()){

            $defaults = array(
                'title' => '',
                'featured_image' => '',
                'gallery' => '',
                'excerpt' => '',
                'details' => '',
                'price' => '',
                'view_button' => '',
                'book_button' => '',
                'ids' => '',
                'class' => ''
            );

            $args = wp_parse_args($args, $defaults);

            return do_shortcode('[mphb_rooms title="'.$args['title'].'" 
                                                    featured_image="'.$args['featured_image'].'" 
                                                    gallery="'.$args['gallery'].'" 
                                                    excerpt="'.$args['excerpt'].'" 
                                                    details="'.$args['details'].'" 
                                                    price="'.$args['price'].'" 
                                                    view_button="'.$args['view_button'].'" 
                                                    book_button="'.$args['book_button'].'" 
                                                    ids="'.$args['ids'].'"
                                                    class="'.$args['class'].'"]');

        }

    }

    new MPHB_Divi_Rooms_Module;

endif;
