<?php
/**
 * Plugin Name: SVG Icon Block
 * Description: Easily add SVG icons to your Gutenberg block editor with the SVG Icon Block. 
 * Author: Zakaria Binsaifullah
 * Author URI: https://www.makegutenblock.com
 * Version: 1.0.0
 * Text Domain: svg-icon-block
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package SvgibBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Svgib_Block ' ) ) {

	/**
	 * Svgib Blocks Final Class
	 *
	 * @since 1.0.0
	 * @package SvgibBlock
	 */
	final class Svgib_Block {

		/**
		 * Svgib Blocks Instance
		 *
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Svgib Blocks Constructor
		 *
		 * @since 1.0.0
		 * @return void
		 */
		private function __construct() {
			$this->constants();
			$this->init();
			$this->includes();
		}

		/**
		 * Svgib Blocks Define Constants
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function constants() {
			if ( ! defined( 'SVGIB_VERSION' ) ) {
				define( 'SVGIB_VERSION', '1.0.0' );
			}

			if ( ! defined( 'SVGIB__FILE__' ) ) {
				define( 'SVGIB__FILE__', __FILE__ );
			}

			if ( ! defined( 'SVGIB_URL_FILE' ) ) {
				define( 'SVGIB_URL_FILE', plugin_dir_url( SVGIB__FILE__ ) );
			}

			if ( ! defined( 'SVGIB_PLUGIN_DIR' ) ) {
				define( 'SVGIB_PLUGIN_DIR', plugin_dir_path( SVGIB__FILE__ ) );
			}

			if ( ! defined( 'SVGIB_URL' ) ) {
				define( 'SVGIB_URL', plugins_url( '/', SVGIB_PLUGIN_DIR ) );
			}
		}

		/**
		 * Svgib Blocks Init
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function init() {
			add_action( 'init', array( $this, 'load_textdomain' ) );
		}

		/**
		 * Svgib Blocks Load Text Domain
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'svg-icon-block', false, basename( SVGIB_PLUGIN_DIR ) . '/languages' );
		}

		/**
		 * Svgib Blocks Instance
		 *
		 * @since 1.0.0
		 * @return SvgibBlock
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Svgib Blocks Includes Files
		 *
		 * @since 1.0.0
		 * @return void
		 */
		private function includes() {
			require_once trailingslashit( SVGIB_PLUGIN_DIR ) . 'inc/svg-icon-block-loader.php';
		}
	}

}

/**
 * Svgib Block Instance
 *
 * @since 1.0.0
 * @return SvgibBlock
 */
function svgib_block_init() {
	return Svgib_Block::get_instance();
}

/**
 * Initialize Svgib Block Plugin
 * 
 * @since 1.0.0
 */
svgib_block_init(); // Initialize the Svgib Blocks class.
