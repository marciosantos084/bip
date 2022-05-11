<?php
/**
 * bip Theme Customizer
 *
 * @package bip
 */

$bip_sections = array( 'info', 'demo' );

foreach( $bip_sections as $s ){
    require get_template_directory() . '/lib/customizer/' . $s . '.php';
}

function bip_customizer_scripts() {
    wp_enqueue_style( 'bip-customize',get_template_directory_uri().'/lib/customizer/css/customize.css', '', 'screen' );
    wp_enqueue_script( 'bip-customize', get_template_directory_uri() . '/lib/customizer/js/customize.js', array( 'jquery' ), '20170404', true );
}
add_action( 'customize_controls_enqueue_scripts', 'bip_customizer_scripts' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/lib/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/lib/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

$config_customizer = array(
	'recommended_plugins' => array( 
		'elementor' => array(
			'recommended' => true,
			/* translators: %s: "Elementor Page Builder" string */
			'description' => sprintf( esc_html__( 'To take full advantage of all the features this theme has to offer, please install and activate the %s plugin.', 'bip' ), '<strong>Elementor Page Builder</strong>' ),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended plugin', 'bip' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'bip' ),
	'activate_button_label'     => esc_html__( 'Activate', 'bip' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'bip' ),
);
bip_Customizer_Notice::init( apply_filters( 'bip_customizer_notice_array', $config_customizer ) );
