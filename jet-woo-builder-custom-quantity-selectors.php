<?php
/**
 * Plugin Name: JetWooBuilder - Custom Quantity Selector
 * Plugin URI: https://github.com/UraraReika/jet-woo-builder-custom-quantity-selectors
 * Description: Add possibility of having a different selection for adding quantities of product.
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-woo-builder
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

define( 'CQS_PLUGIN_URL', __FILE__ );

if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi there! I\'m just a plugin!';
	exit;
}

// Include files
include( 'includes/cqs-enqueue.php' );
include( 'includes/cqs-elementor-controls.php' );

// Enqueue styles and scripts.
add_action( 'elementor/frontend/before_enqueue_scripts', 'cqs_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'cqs_enqueue_styles' );

// Register content controls in widgets.
add_action( 'elementor/element/jet-woo-products/section_general/after_section_end', 'cqs_register_custom_quantity_selector_content_controls', 999 );
add_action( 'elementor/element/jet-woo-products-list/section_general/after_section_end', 'cqs_register_custom_quantity_selector_content_controls', 999 );
add_action( 'elementor/element/jet-single-add-to-cart/section_add_to_cart_style/before_section_start', 'cqs_register_custom_quantity_selector_content_controls', 999 );
add_action( 'elementor/element/jet-woo-builder-archive-add-to-cart/section_archive_add_to_cart_content/after_section_end', 'cqs_register_custom_quantity_selector_content_controls', 999 );