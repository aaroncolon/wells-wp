<?php
/**
 * Wells Theme Customizer
 *
 * @package Wells
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wells_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wells_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wells_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Add Sections
	 */
	$wp_customize->add_section( 'header_nav_settings', array(
		'title' => __( 'Header & Nav Settings', 'wells' ),
		'priority' => 160,
	) );

	/**
	 * Add Settings
	 */
	//  $wp_customize->add_setting( 'header_position', array(
 	// 	'type' => 'theme_mod',
 	// 	'capability' => 'edit_theme_options',
 	// 	'default' => 'left',
 	// 	'transport' => 'postMessage',
 	// 	'sanitize_callback' => ''
 	// ) );

	$wp_customize->add_setting( 'main_text_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#333333',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'link_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#4169e1',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'link_hover_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#191970',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'nav_link_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#4169e1',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'nav_link_hover_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#191970',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'nav_link_current_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#191970',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'mobile_nav_link_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#4169e1',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'mobile_nav_link_hover_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#191970',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'mobile_nav_link_current_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#191970',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'mobile_nav_bg_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#f1f1f1',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'h1_text_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#333333',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'h2_text_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#333333',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'h3_text_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#333333',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'h4_text_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#333333',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_setting( 'h5_text_color', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'default' => '#333333',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	/**
	 * Add Controls
	 */
	// $wp_customize->add_control( 'header_position', array(
	// 	'type' => 'radio',
	// 	'choices' => array(
	// 		'left' => 'Left',
	// 		'right' => 'Right'
	// 	),
	// 	'section' => 'header_nav_settings',
	// 	'label' => __( 'Header Position' )
	// ) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_text_color', // control id
			array(
				'label' => __( 'Main Text Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'main_text_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color', // control id
			array(
				'label' => __( 'Link Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'link_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_hover_color', // control id
			array(
				'label' => __( 'Link Hover Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'link_hover_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_link_color', // control id
			array(
				'label' => __( 'Nav Link Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'nav_link_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_link_hover_color', // control id
			array(
				'label' => __( 'Nav Link Hover Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'nav_link_hover_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'nav_link_current_color', // control id
			array(
				'label' => __( 'Nav Link Current Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'nav_link_current_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mobile_nav_link_color', // control id
			array(
				'label' => __( 'Mobile Nav Link Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'mobile_nav_link_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mobile_nav_link_hover_color', // control id
			array(
				'label' => __( 'Mobile Nav Link Hover Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'mobile_nav_link_hover_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mobile_nav_link_current_color', // control id
			array(
				'label' => __( 'Mobile Nav Link Current Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'mobile_nav_link_current_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'mobile_nav_bg_color', // control id
			array(
				'label' => __( 'Mobile Nav Background Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'mobile_nav_bg_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'h1_text_color', // control id
			array(
				'label' => __( 'Heading 1 Text Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'h1_text_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'h2_text_color', // control id
			array(
				'label' => __( 'Heading 2 Text Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'h2_text_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'h3_text_color', // control id
			array(
				'label' => __( 'Heading 3 Text Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'h3_text_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'h4_text_color', // control id
			array(
				'label' => __( 'Heading 4 Text Color', 'wells' ),
				'description' => '',
				'section' => 'colors',
				// 'priority' => '',
				'settings' => 'h4_text_color' // setting id
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'h5_text_color', // control id
			array(
				'label' => __( 'Heading 5 Text Color', 'wells' ),
				'section' => 'colors',
				'settings' => 'h5_text_color' // setting id
			)
		)
	);

}
add_action( 'customize_register', 'wells_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wells_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wells_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wells_customize_preview_js() {
	wp_enqueue_script( 'wells-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), WELLS_VERSION, true );
}
add_action( 'customize_preview_init', 'wells_customize_preview_js' );
