<?php

class MPHB_Divi extends DiviExtension {

	public $name = 'mphb-divi';
	public $gettext_domain;
	public $version;

	private static $instance = null;

	/**
	 * @return MPHB_Divi|null
	 */
	public static function getInstance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * MPHB_Divi constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'mphb-divi', $args = array() ) {

		$divi_4_dir  = plugin_dir_path( __DIR__ );
		$plugin_root = trailingslashit( dirname( $divi_4_dir ) );

		$this->plugin_dir     = $divi_4_dir;
		$this->plugin_dir_url = plugin_dir_url( __DIR__ );

		$plugin_data          = get_plugin_data( $plugin_root . 'mphb-divi.php' );
		$this->version        = isset( $plugin_data['Version'] ) ? $plugin_data['Version'] : '';
		$this->gettext_domain = isset( $plugin_data['TextDomain'] ) ? $plugin_data['TextDomain'] : '';

		add_action( 'et_fb_enqueue_assets', array( $this, 'enqueue_builder_assets' ) );

		parent::__construct( $name, $args );
	}

	public function hook_et_builder_ready() {

		if ( file_exists( trailingslashit( $this->plugin_dir ) . 'includes/loader.php' ) ) {
			require_once trailingslashit( $this->plugin_dir ) . 'includes/loader.php';
		}
	}

	public function enqueue_builder_assets() {
		wp_enqueue_script( 'mphb-flexslider' );
		wp_enqueue_style( 'mphb-flexslider-css' );
	}
}

MPHB_Divi::getInstance();
