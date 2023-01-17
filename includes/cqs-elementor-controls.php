<?php

/**
 * Register compare button display controls.
 *
 * @param null $obj
 */
function cqs_register_custom_quantity_selector_content_controls( $obj = null ) {

	if ( 'jet-single-add-to-cart' === $obj->get_name() || 'jet-cart-table' === $obj->get_name() ) {
		$obj->start_controls_section(
			'section_custom_quantity_selector',
			[
				'label' => __( 'Quantity Selector', 'jet-woo-builder' ),
			]
		);
	} else {
		$obj->start_controls_section(
			'section_custom_quantity_selector',
			[
				'label'     => __( 'Quantity Selector', 'jet-woo-builder' ),
				'condition' => [
					'show_quantity' => 'yes',
				],
			]
		);
	}

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
			'label'      => __( 'Wrapper Width (%)', 'jet-woo-builder' ),
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
			'label'      => __( 'Buttons Width (%)', 'jet-woo-builder' ),
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

/**
 * Register custom quantity selector style controls.
 *
 * @param $obj
 */
function cqs_register_custom_quantity_selector_style_controls( $obj ) {

	if ( 'jet-single-add-to-cart' === $obj->get_name() || 'jet-cart-table' === $obj->get_name() ) {
		$obj->start_controls_section(
			'section_custom_quantity_selector_styles',
			[
				'label'     => __( 'Quantity Selector', 'jet-woo-builder' ),
				'tab'       => Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_custom_quantity_selector' => 'yes',
				],
			]
		);
	} else {
		$obj->start_controls_section(
			'section_custom_quantity_selector_styles',
			[
				'label'     => __( 'Quantity Selector', 'jet-woo-builder' ),
				'tab'       => Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_quantity'                   => 'yes',
					'enable_custom_quantity_selector' => 'yes',
				],
			]
		);
	}

	$obj->add_responsive_control(
		'quantity_selector_space_between',
		[
			'type'      => Elementor\Controls_Manager::SLIDER,
			'label'     => __( 'Space Between', 'elementor' ),
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .jet-woo-quantity-button-added' => 'gap: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'quantity_buttons_position' => [ 'horizontal', 'vertical' ],
			],
		]
	);

	$obj->add_responsive_control(
		'quantity_selector_wrapper_space_between',
		[
			'type'      => Elementor\Controls_Manager::SLIDER,
			'label'     => __( 'Space Between', 'elementor' ),
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-controls-holder' => 'gap: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'quantity_buttons_position!' => [ 'horizontal', 'vertical' ],
			],
		]
	);

	$obj->add_responsive_control(
		'quantity_selector_size',
		[
			'type'      => Elementor\Controls_Manager::SLIDER,
			'label'     => __( 'Icon Size', 'elementor' ),
			'range'     => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$obj->start_controls_tabs( 'tabs_quantity_selector_style' );

	$obj->start_controls_tab(
		'tab_quantity_selector_normal',
		[
			'label' => __( 'Normal', 'jet-woo-builder' ),
		]
	);

	$obj->add_control(
		'quantity_selector_icon_color',
		[
			'label'     => __( 'Color', 'jet-woo-builder' ),
			'type'      => Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control > *' => 'fill: {{VALUE}}; color: {{VALUE}};',
			],
		]
	);

	$obj->add_group_control(
		Elementor\Group_Control_Background::get_type(),
		[
			'name'     => 'quantity_selector_background',
			'types'    => [ 'classic', 'gradient' ],
			'exclude'  => [ 'image' ],
			'selector' => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control',
		]
	);

	$obj->add_group_control(
		Elementor\Group_Control_Box_Shadow::get_type(),
		[
			'name'     => 'quantity_selector_box_shadow',
			'selector' => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control',
		]
	);

	$obj->end_controls_tab();

	$obj->start_controls_tab(
		'tab_quantity_selector_hover',
		[
			'label' => __( 'Hover', 'jet-woo-builder' ),
		]
	);

	$obj->add_control(
		'quantity_selector_icon_hover_color',
		[
			'label'     => __( 'Color', 'jet-woo-builder' ),
			'type'      => Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control:hover > *' => 'fill: {{VALUE}}; color: {{VALUE}};',
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control:focus > *' => 'fill: {{VALUE}}; color: {{VALUE}};',
			],
		]
	);

	$obj->add_group_control(
		Elementor\Group_Control_Background::get_type(),
		[
			'name'     => 'quantity_selector_hover_background',
			'types'    => [ 'classic', 'gradient' ],
			'exclude'  => [ 'image' ],
			'selector' => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control:hover, {{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control:focus',
		]
	);

	$obj->add_control(
		'quantity_selector_hover_border_color',
		[
			'label'     => __( 'Border Color', 'jet-woo-builder' ),
			'type'      => Elementor\Controls_Manager::COLOR,
			'condition' => [
				'quantity_selector_border_border!' => '',
			],
			'selectors' => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control:hover' => 'border-color: {{VALUE}};',
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control:focus' => 'border-color: {{VALUE}};',
			],
		]
	);

	$obj->add_group_control(
		Elementor\Group_Control_Box_Shadow::get_type(),
		[
			'name'     => 'quantity_selector_hover_box_shadow',
			'selector' => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control:hover, {{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control:focus',
		]
	);

	$obj->end_controls_tab();

	$obj->end_controls_tabs();

	$obj->add_group_control(
		Elementor\Group_Control_Border::get_type(),
		[
			'name'      => 'quantity_selector_border',
			'selector'  => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control',
			'separator' => 'before',
		]
	);

	$obj->add_control(
		'quantity_selector_border_radius',
		[
			'label'      => __( 'Border Radius', 'jet-woo-builder' ),
			'type'       => Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$obj->add_responsive_control(
		'quantity_selector_padding',
		[
			'label'      => __( 'Padding', 'jet-woo-builder' ),
			'type'       => Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$obj->add_control(
		'quantity_selector_specific_increase_styles',
		[
			'type'  => Elementor\Controls_Manager::SWITCHER,
			'label' => __( 'Specific Increase Button Styles', 'jet-woo-builder' ),
		]
	);

	$obj->add_group_control(
		Elementor\Group_Control_Border::get_type(),
		[
			'name'      => 'quantity_selector_increase_border',
			'selector'  => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control.increase',
			'condition' => [
				'quantity_selector_specific_increase_styles' => 'yes',
			],
		]
	);

	$obj->add_control(
		'quantity_selector_increase_border_radius',
		[
			'type'       => Elementor\Controls_Manager::DIMENSIONS,
			'label'      => __( 'Border Radius', 'jet-woo-builder' ),
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control.increase' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'  => [
				'quantity_selector_specific_increase_styles' => 'yes',
			],
		]
	);

	$obj->add_group_control(
		Elementor\Group_Control_Box_Shadow::get_type(),
		[
			'name'      => 'quantity_selector_increase_box_shadow',
			'selector'  => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-control.increase',
			'condition' => [
				'quantity_selector_specific_increase_styles' => 'yes',
			],
		]
	);

	$obj->add_control(
		'quantity_selector_wrapper_heading',
		array(
			'label'     => esc_html__( 'Quantity Buttons Wrapper', 'jet-woo-builder' ),
			'type'      => Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'quantity_buttons_position' => [ 'start', 'end', 'top', 'bottom' ],
			],
		)
	);

	$obj->add_group_control(
		Elementor\Group_Control_Background::get_type(),
		[
			'name'           => 'quantity_selector_wrapper_background',
			'label'          => __( 'Background', 'jet-woo-builder' ),
			'types'          => [ 'classic', 'gradient' ],
			'exclude'        => [ 'image' ],
			'selector'       => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-controls-holder',
			'condition'      => [
				'quantity_buttons_position' => [ 'start', 'end', 'top', 'bottom' ],
			],
			'fields_options' => [
				'background' => [
					'default' => 'classic',
				],
				'color'      => [
					'global' => [
						'default' => Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
					],
				],
			],
		]
	);

	$obj->add_group_control(
		Elementor\Group_Control_Border::get_type(),
		[
			'name'      => 'quantity_selector_wrapper_border',
			'condition' => [
				'quantity_buttons_position' => [ 'start', 'end', 'top', 'bottom' ],
			],
			'selector'  => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-controls-holder',
		]
	);

	$obj->add_control(
		'quantity_selector_wrapper_border_radius',
		[
			'label'      => __( 'Border Radius', 'jet-woo-builder' ),
			'type'       => Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'condition'  => [
				'quantity_buttons_position' => [ 'start', 'end', 'top', 'bottom' ],
			],
			'selectors'  => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-controls-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$obj->add_group_control(
		Elementor\Group_Control_Box_Shadow::get_type(),
		[
			'name'      => 'quantity_selector_wrapper_box_shadow',
			'condition' => [
				'quantity_buttons_position' => [ 'start', 'end', 'top', 'bottom' ],
			],
			'selector'  => '{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-controls-holder',
		]
	);

	$obj->add_responsive_control(
		'quantity_selector_wrapper_padding',
		[
			'label'      => __( 'Padding', 'jet-woo-builder' ),
			'type'       => Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'condition'  => [
				'quantity_buttons_position' => [ 'start', 'end', 'top', 'bottom' ],
			],
			'selectors'  => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-controls-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$obj->add_responsive_control(
		'quantity_selector_wrapper_margin',
		[
			'label'      => __( 'Margin', 'jet-woo-builder' ),
			'type'       => Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'condition'  => [
				'quantity_buttons_position' => [ 'start', 'end', 'top', 'bottom' ],
			],
			'selectors'  => [
				'{{WRAPPER}} .jet-woo-quantity-button-added .jet-woo-qty-controls-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$obj->end_controls_section();

}
