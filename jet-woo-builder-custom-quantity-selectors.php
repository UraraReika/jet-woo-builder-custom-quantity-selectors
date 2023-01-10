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

if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi there! I\'m just a plugin!';
	exit;
}

define( 'CQS_PLUGIN_URL', __FILE__ );

// Include files
include( 'includes/cqs-enqueue.php' );
include( 'includes/cqs-elementor-controls.php' );
include( 'includes/cqs-editor-view-handler.php' );

// Enqueue styles and scripts.
add_action( 'elementor/frontend/before_enqueue_scripts', 'cqs_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'cqs_enqueue_styles' );

// Register content controls in widgets.
add_action( 'elementor/element/jet-woo-products/section_general/after_section_end', 'cqs_register_custom_quantity_selector_content_controls', 999 );
add_action( 'elementor/element/jet-woo-products-list/section_general/after_section_end', 'cqs_register_custom_quantity_selector_content_controls', 999 );
add_action( 'elementor/element/jet-single-add-to-cart/section_add_to_cart_style/before_section_start', 'cqs_register_custom_quantity_selector_content_controls', 999 );
add_action( 'elementor/element/jet-woo-builder-archive-add-to-cart/section_archive_add_to_cart_content/after_section_end', 'cqs_register_custom_quantity_selector_content_controls', 999 );
add_action( 'elementor/element/jet-cart-table/cart_table_action_controls/after_section_end', 'cqs_register_custom_quantity_selector_content_controls', 999 );

// Register style controls in widgets.
add_action( 'elementor/element/jet-woo-products/section_not_found_message_style/after_section_end', 'cqs_register_custom_quantity_selector_style_controls', 999 );
add_action( 'elementor/element/jet-woo-products-list/section_not_found_message_style/after_section_end', 'cqs_register_custom_quantity_selector_style_controls', 999 );
add_action( 'elementor/element/jet-single-add-to-cart/section_add_to_cart_style/after_section_end', 'cqs_register_custom_quantity_selector_style_controls', 999 );
add_action( 'elementor/element/jet-woo-builder-archive-add-to-cart/section_archive_add_to_cart_style/after_section_end', 'cqs_register_custom_quantity_selector_style_controls', 999 );
add_action( 'elementor/element/jet-cart-table/cart_table_apply_coupon_styles/after_section_end', 'cqs_register_custom_quantity_selector_style_controls', 999 );

// Add plugin settings to archive widget marcos settings.
add_filter( 'jet-woo-builder/jet-woo-archive-add-to-cart/macros-settings', 'cqs_set_archive_add_to_cart_macros_settings', 10, 2 );

// Compatibility with similar option in Astra theme.
add_filter( 'astra_add_to_cart_quantity_btn_enabled', function() {
	return false;
} );