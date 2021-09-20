<?php

/**
 * Add custom attributes to widgets in Editor for visualization.
 *
 * @param $attributes
 * @param $settings
 *
 * @return mixed|string
 */
function cqs_set_product_add_to_cart_button_editor_attributes( $attributes, $settings ) {

	if ( jet_woo_builder_integration()->in_elementor() && 'yes' === $settings['enable_custom_quantity_selector'] ) {
		$qs_attrs = [
			'enable'   => $settings['enable_custom_quantity_selector'],
			'position' => $settings['quantity_buttons_position'],
			'incIcon'  => $settings['selected_quantity_increase_button_icon'],
			'decIcon'  => $settings['selected_quantity_decrease_button_icon'],
		];

		$attributes .= sprintf( ' data-editor-quantity-settings="%s" ', htmlspecialchars( json_encode( $qs_attrs ) ) );
	}

	return $attributes;

}

/**
 * Add plugins controls settings to archive add to cart widget macros settings.
 *
 * @param $macros_settings
 * @param $settings
 *
 * @return mixed
 */
function cqs_set_archive_add_to_cart_macros_settings( $macros_settings, $settings ) {

	if ( 'yes' === $settings['enable_custom_quantity_selector'] ) {
		$macros_settings['enable_custom_quantity_selector']        = $settings['enable_custom_quantity_selector'];
		$macros_settings['quantity_buttons_position']              = $settings['quantity_buttons_position'];
		$macros_settings['selected_quantity_increase_button_icon'] = $settings['selected_quantity_increase_button_icon'];
		$macros_settings['selected_quantity_decrease_button_icon'] = $settings['selected_quantity_decrease_button_icon'];
	}

	return $macros_settings;

}