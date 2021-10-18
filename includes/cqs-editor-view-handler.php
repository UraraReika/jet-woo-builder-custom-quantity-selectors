<?php
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