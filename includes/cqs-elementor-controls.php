<?php

/**
 * Register compare button display controls.
 *
 * @param null $obj
 */
function cqs_register_custom_quantity_selector_content_controls( $obj = null ) {

	$obj->start_controls_section(
		'section_custom_quantity_selector',
		[
			'label' => __( 'Quantity Selector', 'jet-woo-builder' ),
		]
	);

	$obj->add_control(
		'enable_custom_quantity_selector',
		[
			'label'              => __( 'Enable Quantity Selector', 'jet-woo-builder' ),
			'type'               => Elementor\Controls_Manager::SWITCHER,
			'frontend_available' => true,
		]
	);

	$obj->add_control(
		'quantity_buttons_position',
		[
			'label'              => __( 'Position', 'jet-woo-builder' ),
			'type'               => Elementor\Controls_Manager::SELECT,
			'default'            => 'horizontal',
			'options'            => [
				'horizontal' => __( 'Horizontal', 'jet-woo-builder' ),
				'vertical'   => __( 'Vertical', 'jet-woo-builder' ),
				'start'      => __( 'Start', 'jet-woo-builder' ),
				'end'        => __( 'End', 'jet-woo-builder' ),
				'top'        => __( 'Top', 'jet-woo-builder' ),
				'bottom'     => __( 'Bottom', 'jet-woo-builder' ),
			],
			'frontend_available' => true,
			'condition'          => [
				'enable_custom_quantity_selector' => 'yes',
			],
		]
	);

	$obj->add_control(
		'quantity_buttons_wrapper_width',
		[
			'label'      => __( 'Wrapper Width', 'jet-woo-builder' ),
			'type'       => Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range'      => [
				'%' => [
					'min' => 10,
					'max' => 100,
				],
			],
			'default'    => [
				'unit' => '%',
				'size' => '30',
			],
			'selectors'  => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-controls-holder' => 'flex: 0 0 {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'enable_custom_quantity_selector' => 'yes',
				'quantity_buttons_position'       => [ 'start', 'end' ],
			],
		]
	);

	$obj->add_control(
		'quantity_buttons_width',
		[
			'label'      => __( 'Buttons Width', 'jet-woo-builder' ),
			'type'       => Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range'      => [
				'%' => [
					'min' => 10,
					'max' => 100,
				],
			],
			'default'    => [
				'unit' => '%',
				'size' => '20',
			],
			'selectors'  => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control' => 'flex: 0 0 {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'enable_custom_quantity_selector' => 'yes',
				'quantity_buttons_position'       => [ 'horizontal' ],
			],
		]
	);

	$obj->__add_advanced_icon_control(
		'quantity_increase_button_icon',
		[
			'label'              => __( 'Increase Icon', 'jet-woo-builder' ),
			'type'               => Elementor\Controls_Manager::ICON,
			'label_block'        => true,
			'file'               => '',
			'default'            => 'fa fa-plus',
			'fa5_default'        => [
				'value'   => 'fas fa-plus',
				'library' => 'fa-solid',
			],
			'frontend_available' => true,
			'condition'          => [
				'enable_custom_quantity_selector' => 'yes',
			],
		]
	);

	$obj->__add_advanced_icon_control(
		'quantity_decrease_button_icon',
		[
			'label'              => __( 'Decrease Icon', 'jet-woo-builder' ),
			'type'               => Elementor\Controls_Manager::ICON,
			'label_block'        => true,
			'file'               => '',
			'default'            => 'fa fa-minus',
			'fa5_default'        => [
				'value'   => 'fas fa-minus',
				'library' => 'fa-solid',
			],
			'frontend_available' => true,
			'condition'          => [
				'enable_custom_quantity_selector' => 'yes',
			],
		]
	);

	$obj->end_controls_section();

}
