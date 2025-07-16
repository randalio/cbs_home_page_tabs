<?php
/**
 * Plugin Name: Elementor Tabbed Slider
 * Description: A custom Elementor widget that creates a tabbed slider with background images, text, and links
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: elementor-tabbed-slider
 * Elementor tested up to: 3.18.0
 * Elementor Pro tested up to: 3.18.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Elementor Tabbed Slider Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_elementor_tabbed_slider_widget( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/tabbed-slider-widget.php' );

    $widgets_manager->register( new \Elementor_Tabbed_Slider_Widget() );

}
add_action( 'elementor/widgets/register', 'register_elementor_tabbed_slider_widget' );

/**
 * Register Widget Scripts
 */
function elementor_tabbed_slider_scripts() {
    wp_enqueue_script( 'elementor-tabbed-slider', plugins_url( '/dist/js/main.js', __FILE__ ), [ 'jquery' ], time(), true );
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [ 'jquery' ], time(), true );
    
}
add_action( 'wp_enqueue_scripts', 'elementor_tabbed_slider_scripts' );


/**
 * Register Widget Styles
 */
function elementor_tabbed_slider_styles() {
    wp_enqueue_style( 'elementor-tabbed-slider', plugins_url( '/dist/css/main.css', __FILE__ ), [], time() );
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], time() );
}
add_action( 'wp_enqueue_scripts', 'elementor_tabbed_slider_styles' );

