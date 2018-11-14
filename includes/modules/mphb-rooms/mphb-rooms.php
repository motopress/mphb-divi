<?php
if(!class_exists('MPHB_Divi_Rooms_Module') && class_exists('ET_Builder_Module')):

    class MPHB_Divi_Rooms_Module extends ET_Builder_Module{

        public $slug = 'mphb-divi-accommodations';
        public $vb_support = 'on';

        function init(){

            $this->name       = esc_html__( 'HB Accom. List', 'mphb-divi' );

        }

        function get_fields(){

            return array(
                'title' => array(
                    'label'           => esc_html__( 'Title', 'mphb-divi' ),
                    'description'     => esc_html__( 'Whether to display title of the accommodation type.', 'mphb-divi' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi' ),
                        'off' => esc_html__( 'No', 'mphb-divi' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'featured_image' => array(
                    'label'           => esc_html__( 'Featured image', 'mphb-divi' ),
                    'description'     => esc_html__( 'Whether to display featured image of the accommodation type.', 'mphb-divi' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi' ),
                        'off' => esc_html__( 'No', 'mphb-divi' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'gallery' => array(
                    'label'           => esc_html__( 'Gallery', 'mphb-divi' ),
                    'description'     => esc_html__( 'Whether to display gallery of the accommodation type.', 'mphb-divi' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi' ),
                        'off' => esc_html__( 'No', 'mphb-divi' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'excerpt' => array(
                    'label'           => esc_html__( 'Excerpt', 'mphb-divi' ),
                    'description'     => esc_html__( 'Whether to display excerpt (short description) of the accommodation type.', 'mphb-divi' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi' ),
                        'off' => esc_html__( 'No', 'mphb-divi' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'details' => array(
                    'label'           => esc_html__( 'Details', 'mphb-divi' ),
                    'description'     => esc_html__( 'Whether to display details of the accommodation type.', 'mphb-divi' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi' ),
                        'off' => esc_html__( 'No', 'mphb-divi' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'price' => array(
                    'label'           => esc_html__( 'Price', 'mphb-divi' ),
                    'description'     => esc_html__( 'Whether to display price of the accommodation type.', 'mphb-divi' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi' ),
                        'off' => esc_html__( 'No', 'mphb-divi' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'view_button' => array(
                    'label'           => esc_html__( 'View Button', 'mphb-divi' ),
                    'description'     => esc_html__( 'Whether to display "View Details" button with the link to accommodation type.', 'mphb-divi' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi' ),
                        'off' => esc_html__( 'No', 'mphb-divi' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'book_button' => array(
                    'label'           => esc_html__( 'Book Button', 'mphb-divi' ),
                    'description'     => esc_html__( 'Whether to display "Book" button.', 'mphb-divi' ),
                    'type'              => 'yes_no_button',
                    'options'           => array(
                        'on'  => esc_html__( 'Yes', 'mphb-divi' ),
                        'off' => esc_html__( 'No', 'mphb-divi' ),
                    ),
                    'default_on_front'  => 'on',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'ids' => array(
                    'label'           => esc_html__( 'IDs', 'mphb-divi' ),
                    'description'     => esc_html__( 'Comma-separated IDs of accommodations that will be shown.', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'category' => array(
                    'label'           => esc_html__( 'Category', 'mphb-divi' ),
                    'description'     => esc_html__( 'Comma-separated IDs of categories that will be shown.', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'tags' => array(
                    'label'           => esc_html__( 'Tags', 'mphb-divi' ),
                    'description'     => esc_html__( 'Comma-separated IDs of tags that will be shown.', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'relation' => array(
                    'label'           => esc_html__( 'Logical relationship', 'mphb-divi' ),
                    'description'     => esc_html__( 'Logical relationship between each taxonomy when there is more than one.', 'mphb-divi' ),
                    'type'            => 'select',
                    'options'         => array(
                        'AND' => esc_html__( 'AND', 'mphb-divi' ),
                        'OR'  => esc_html__( 'OR', 'mphb-divi' ),
                    ),
                    'default'           => 'OR',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'posts_per_page' => array(
                    'label'           => esc_html__( 'Count per page', 'mphb-divi' ),
                    'description'     => esc_html__( 'Integer, -1 to display all, default: "Blog pages show at most"', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'orderby' => array(
                    'label'           => esc_html__( 'Sort by', 'mphb-divi' ),
                    'description'     => esc_html__( 'ID, title, date, menu_order...', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'order' => array(
                    'label'           => esc_html__( 'Order', 'mphb-divi' ),
                    'description'     => esc_html__( 'Designates the ascending or descending order of sorting. ASC - from lowest to highest values (1, 2, 3). DESC - from highest to lowest values (3, 2, 1).', 'mphb-divi' ),
                    'type'            => 'select',
                    'options'         => array(
                        'ASC' => esc_html__( 'ASC', 'mphb-divi' ),
                        'DESC'  => esc_html__( 'DESC', 'mphb-divi' ),
                    ),
                    'default' => 'DESC',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'meta_key' => array(
                    'label'           => esc_html__( 'Custom field name', 'mphb-divi' ),
                    'description'     => esc_html__( 'Required if "orderby" is one of the "meta_value", "meta_value_num" or "meta_value_*".', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'meta_type' => array(
                    'label'           => esc_html__( 'Custom field type', 'mphb-divi' ),
                    'description'     => esc_html__( 'Specified type of the custom field. Can be used in conjunction with orderby="meta_value".', 'mphb-divi' ),
                    'type'              => 'text',
                    'default'   => '',
                    'computed_affects'   => array(
                        '__rooms',
                    ),
                ),
                'class' => array(
                    'label'           => esc_html__( 'Class', 'mphb-divi' ),
                    'description'     => esc_html__( 'Custom CSS class for shortcode wrapper.', 'mphb-divi' ),
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
                        'category',
                        'tags',
                        'relation',
                        'posts_per_page',
                        'orderby',
                        'order',
                        'meta_key',
                        'meta_type',
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
            $category = $this->props['category'];
            $tags = $this->props['tags'];
            $relation = $this->props['relation'];
            $posts_per_page = $this->props['posts_per_page'];
            $orderby = $this->props['orderby'];
            $order = $this->props['order'];
            $meta_key = $this->props['meta_key'];
            $meta_type = $this->props['meta_type'];
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
                                                        category="'.$category.'"
                                                        tags="'.$tags.'"
                                                        relation="'.$relation.'"
                                                        posts_per_page="'.$posts_per_page.'"
                                                        orderby="'.$orderby.'"
                                                        order="'.$order.'"
                                                        meta_key="'.$meta_key.'"
                                                        meta_value="'.$meta_type.'"
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
                'category' => '',
                'tags' => '',
                'relation' => '',
                'posts_per_page' => '',
                'orderby' => '',
                'order' => '',
                'meta_key' => '',
                'meta_value' => '',
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
                                                    category="'.$args['category'].'" 
                                                    tags="'.$args['tags'].'" 
                                                    relation="'.$args['relation'].'" 
                                                    posts_per_page="'.$args['posts_per_page'].'" 
                                                    orderby="'.$args['orderby'].'" 
                                                    order="'.$args['order'].'" 
                                                    meta_key="'.$args['meta_key'].'" 
                                                    meta_value="'.$args['meta_value'].'" 
                                                    class="'.$args['class'].'"]');

        }

    }

    new MPHB_Divi_Rooms_Module;

endif;
