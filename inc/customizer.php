<?php
/**
 * Personal Theme Theme Customizer
 *
 * @package Personal Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function personaltheme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'personaltheme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function personaltheme_customize_preview_js() {
	wp_enqueue_script( 'personaltheme_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'personaltheme_customize_preview_js' );






if ( ! class_exists( 'Amerging_Theme_Customizer_Settings' ) ):

class Amerging_Theme_Customizer_Settings {

	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_customizer_fields' ) );
	}

	/**
	 *	Define the Customizer settings
	 *
	 *	@return array $settings The Customizer settings
	 */
	public function customizer_settings() {

		$settings = array(

			'panels' => array(

				// Panels
				array(
					'key' => 'personaltheme_customizer_panel',
					'priority' => 1,
					'capability' => 'edit_theme_options',
					'theme_supports' => '',
					'title' => __( 'Personal Theme', 'personaltheme' ),
					'description' => __( 'Customizer settings for the Amerging theme.', 'personaltheme' ),
					'sections' => array(

						// Panel Sections
						array(
							'key' => 'personaltheme_customizer_global',
							'title' => __( 'Global', 'personaltheme' ),
							'description' => __( 'Global settings.', 'personaltheme' ),
							'fields' => array(
								// Fields
								array(
									'type' => 'radio',
									'key' => 'personaltheme_default_layout',
									'label' => __( 'Default Layout', 'personaltheme' ),
									'description' => __( 'Default layout (e.g. no sidebar, left sidebar, or right sidebar). Can be overridden on a per post/page basis.', 'personaltheme' ),
									'choices' => array(
										'no_sidebar' => __( 'No Sidebar', 'personaltheme' ),
										'left_sidebar' => __( 'Left Sidebar', 'personaltheme' ),
										'right_sidebar' => __( 'Right Sidebar', 'personaltheme' ),
									),
									'default' => 'no_sidebar',
								),
								array(
									'type' => 'image_upload',
									'key' => 'personaltheme_favicon',
									'label' => __( 'Favicon', 'personaltheme' ),
								),
								array(
									'type' => 'image_upload',
									'key' => 'personaltheme_logo',
									'label' => __( 'Logo Image', 'personaltheme' ),
									'description' => __( '', 'personaltheme' )
								),
								array(
									'type' => 'number',
									'key' => 'personaltheme_logo_width',
									'label' => __( 'Logo Max Width', 'personaltheme' ),
									'description' => __( 'Default: 360px', 'personaltheme' )
								),
								array(
									'type' => 'number',
									'key' => 'personaltheme_logo_height',
									'label' => __( 'Logo Max Height', 'personaltheme' ),
									'description' => __( 'Default: 80px', 'personaltheme' )
								),
							),
						),
					),
				),
			),
		);

		return $settings;
	}

	/**
	 *	Add customizer controls
	 */
	public function register_customizer_fields( $wp_customize ) {

		$settings = $this->customizer_settings();

		$this->control_setup( $settings, $wp_customize );
	}

	/**
	 *	Loop through each customizer setting and set it up with the proper control
	 */
	public function control_setup( $settings, $wp_customize ) {

		foreach ( $settings['panels'] as $panel ) {

			// Create the panel(s)
			$wp_customize->add_panel( $panel['key'], array(
				'priority'       => isset( $panel['priority'] ) ? $panel['priority'] : '',
				'capability'     => isset( $panel['capability'] ) ? $panel['capability'] : '',
				'theme_supports' => isset( $panel['theme_supports'] ) ? $panel['theme_supports'] : '',
				'title'          => isset( $panel['title'] ) ? $panel['title'] : '',
				'description'    => isset( $panel['description'] ) ? $panel['description'] : '',
			) );

			foreach ( $panel['sections'] as $section ) {

				if ( ! isset( $section_priority ) ) {
					$section_priority = isset( $section['priority'] ) ? $section['priority'] : 1;
				}

				$wp_customize->add_section( $section['key'], array(
					'title' => isset( $section['title'] ) ? $section['title'] : '',
					'description' => isset( $section['description'] ) ? $section['description'] : '',
					'priority' => $section_priority,
					'panel'  => $panel['key'],
				) );

				if ( isset( $section['fields'] ) && is_array( $section['fields'] ) ) {

					foreach ( $section['fields'] as $field ) {

						if ( ! isset( $field_priority ) ) {
							$field_priority = 1;
						}

						switch ( $field['type'] ) {

							// Color picker
							case 'color':
								$wp_customize->add_setting( $field['key'], array(
									'default' => $field['default'] ? $field['default'] : '',
								) );
								$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'settings' => isset( $field['key'] ) ? $field['key'] : '',
									'priority' => $field_priority,
									'default' => isset( $field['default'] ) ? $field['default'] : '',
								) ) );
								break;

							// Text
							case 'text':
								$wp_customize->add_setting( $field['key'], array(
									'default' => isset( $field['default'] ) ? $field['default'] : '',
									'sanitize_callback' => array( $this, 'sanitize_number' ),
							    ) );
								$wp_customize->add_control( $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'type' => 'text',
									'priority' => $field_priority,
								) );
								break;

							// Numbers
							case 'number':
								$wp_customize->add_setting( $field['key'], array(
									'default' => isset( $field['default'] ) ? $field['default'] : '',
							    ) );
								$wp_customize->add_control( $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'type' => 'number',
									'priority' => $field_priority,
								) );
								break;

							// Checkbox
							case 'checkbox':
								$wp_customize->add_setting( $field['key'], array(
									'default' => isset( $field['default'] ) ? $field['default'] : '',
							    ) );
								$wp_customize->add_control( $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'type' => 'checkbox',
									'priority' => $field_priority,
								) );
								break;

							// Radio buttons
							case 'radio':
								$wp_customize->add_setting( $field['key'], array(
									'default' => isset( $field['default'] ) ? $field['default'] : '',
							    ) );
								$wp_customize->add_control( $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'type' => 'radio',
									'priority' => $field_priority,
									'choices' => isset( $field['choices'] ) ? $field['choices'] : array(),
								) );
								break;

							// Image uploader
							case 'image_upload':
								$wp_customize->add_setting( $field['key'] );
								$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
									$field['key'],
									array(
										'label' => isset( $field['label'] ) ? $field['label'] : '',
										'description' => isset( $field['description'] ) ? $field['description'] : '',
										'section'  => $section['key'],
										'settings' => $field['key'],
										'priority' => $field_priority,
									) ) );
								break;
							
							default:
								break;
						}

						$field_priority++;
					}
				}

				$section_priority++;
			}
		}
	}
}

endif;

new Amerging_Theme_Customizer_Settings;