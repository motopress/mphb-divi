<?php
class MPHB_Divi extends DiviExtension {

    public $name = 'mphb-divi-integration';
    public $gettext_domain = 'mphb-divi-integration';
    public $version = '1.0.0';

    private static $instance = null;

    /**
     * @return MPHB_Divi|null
     */
    public static function getInstance () {

        if( ! isset ( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;

    }

    /**
     * MPHB_Divi constructor.
     */
    public function __construct ( $name = 'mphb-divi-integration', $args = array() ) {

        $this->plugin_dir = plugin_dir_path( __FILE__ );
        $this->plugin_dir_url = plugin_dir_url( __FILE__ );
        $this->addActions();
        $this->loadIncludes();

        parent::__construct($name,$args);

    }

    /**
     * Load plugin includes
     */
    private function loadIncludes () {

        include $this->plugin_dir. 'includes/functions.php';

    }

    /**
     * Add actions
     */
    public function addActions () {

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
        add_action( 'customize_preview_init', array( $this, 'enqueueCustomizerScripts' ) );
        add_action( 'et_fb_enqueue_assets', function (){
            wp_enqueue_script( 'mphb-flexslider' );
            wp_enqueue_style( 'mphb-flexslider-css' );
        });

    }

    /**
     * Enqueue scripts & styles
     */
    public function enqueueScripts () {

        wp_enqueue_style( 'mphb-divi-style', $this->plugin_dir_url . 'styles/style.css' );

    }

    /**
     * Enqueue customizer scripts
     */
    public function enqueueCustomizerScripts () {

        wp_enqueue_script( 'mphb-divi-customize-preview', $this->plugin_dir_url . 'scripts/customize-preview.js', array( 'jquery', 'customize-preview' ) );

    }

    public function hook_et_builder_modules_loaded() {

        if ( file_exists( "{$this->plugin_dir}/includes/loader.php" ) ) {

            require_once "{$this->plugin_dir}/includes/loader.php";

        }

    }

}

MPHB_Divi::getInstance();