<?php

/**
 * Enqueue main script file.
 */
function cqs_enqueue_scripts() {

	wp_register_script(
		'cqs_main',
		plugins_url( 'assets/js/main.js', CQS_PLUGIN_URL ),
		[ 'jquery', 'elementor-frontend' ],
		'1.0.0',
		true
	);

	wp_enqueue_script( 'cqs_main' );

}

/**
 * Enqueue main style file.
 */
function cqs_enqueue_styles() {

	wp_register_style(
		'cqs_styles',
		plugins_url( 'assets/css/styles.min.css',CQS_PLUGIN_URL )
	);

	wp_enqueue_style( 'cqs_styles' );

}
