<?php
/**
 * Svgib Blocks Enqueue Assets
 *
 * @package SvgibBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Svgib_Block_Assets' ) ) {

	/**
	 * Svgib Blocks Enqueue Assets Class
	 *
	 * @since 1.0.0
	 * @package SvgibBlock
	 */

	class Svgib_Block_Assets {

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function __construct() {
			$this->init();
		}

		/**
		 * Initialize the Class
		 *
		 * @since 1.0.0
		 * @return void
		 */
		private function init() {
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ), 2 ); // Editor Assets.
		}

		/**
		 * Enqueue Editor Assets
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function enqueue_editor_assets() {

			if ( ! is_admin() ) {
				return;
			}
			
			// global
			if ( file_exists( trailingslashit( SVGIB_PLUGIN_DIR ) . '/build/global/index.asset.php' ) ) {
				$globalDependencies = require_once trailingslashit( SVGIB_PLUGIN_DIR ) . '/build/global/index.asset.php';
				wp_enqueue_script(
					'svg-icon-block-global-script',
					trailingslashit( SVGIB_URL_FILE ) . 'build/global/index.js',
					$globalDependencies['dependencies'],
					SVGIB_VERSION,
					false
				);
				wp_enqueue_style(
					'svg-icon-block-global-style',
					trailingslashit( SVGIB_URL_FILE ) . 'build/global/index.css',
					array(),
					SVGIB_VERSION,
					'all'
				);
			}
		}

	}

	new Svgib_Block_Assets(); // Initialize the class.
}

