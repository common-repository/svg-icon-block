<?php
/**
 * Svgib Blocks - Generate Dynamic Styles
 *
 * @since 1.0.0
 * @package SvgibBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Svgib_Block_Dynamic_Style' ) ) {

    /**
     * Svgib Blocks Dynamic Style Class
     *
     * @since 1.0.0
     * @package SvgibBlock
     */
    class Svgib_Block_Dynamic_Style {

        private $dynamic_styles = '';

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
            add_filter( 'render_block', array( $this, 'generate_dynamic_styles' ), 10, 2 );

            // Enqueue Dynamic Styles
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_dynamic_styles' ) );
        }

        /**
         * Generate Dynamic Styles
         *
         * @since 1.0.0
         * @param string $block_content Block Content.
         * @param array  $block Block Attributes.
         * @return string
         */
        public function generate_dynamic_styles( $block_content, $block ) {
            if ( isset( $block['blockName'] ) && strpos( $block['blockName'], 'svgib/' ) !== false ) {
                if ( isset( $block['attrs']['blockStyle'] ) ) {
                    $style = sanitize_text_field( $block['attrs']['blockStyle'] );
                    $this->enqueue_dynamic_styles( $style );
                }
            }
            return $block_content;
        }

        /**
         * Enqueue Dynamic Styles
         *
         * @since 1.0.0
         * @param string $style Custom CSS to be enqueued.
         * @return void
         */
        public function enqueue_dynamic_styles( $style ) {
            if ( ! empty( $style ) ) {
                $handle = 'svg-icon-block-inline-style-' . wp_rand( 100, 10000 );
                wp_register_style( $handle, false, array(), SVGIB_VERSION, 'all' );
                wp_enqueue_style( $handle );
                wp_add_inline_style( $handle, wp_strip_all_tags( $style ) );
            }
        }
    }

    new Svgib_Block_Dynamic_Style(); // Initialize the Dynamic Style class.
}