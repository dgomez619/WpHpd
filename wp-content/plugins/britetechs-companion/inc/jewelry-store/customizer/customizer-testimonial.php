<?php
function jewelry_store_customizer_testimonial( $wp_customize ){

	$option = jewelry_store_reset_data();

	$wp_customize->add_panel( 'testimonial_panel',
		array(
			'priority'       => 136,
			'capability'     => 'edit_theme_options',
			'title'          => esc_html__( 'Home Page: Testimonial', 'britetechs-companion' ),
			'description'    => '',
		)
	);
		$wp_customize->add_section( 'testimonial_settings' ,
			array(
				'priority'    => 1,
				'title'       => esc_html__( 'Testimonial Settings', 'britetechs-companion' ),
				'description' => '',
				'panel'       => 'testimonial_panel',
			)
		);
			$wp_customize->add_setting( 'jewelrystore_option[testimonial_enable]',
				array(
					'sanitize_callback' => 'jewelry_store_sanitize_checkbox',
					'default'           => $option['testimonial_enable'],
					'type' => 'option',
				)
			);
			$wp_customize->add_control( 'jewelrystore_option[testimonial_enable]',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Testimonial Enable', 'britetechs-companion'),
					'section'     => 'testimonial_settings',
					'description' => '',
				)
			);
			$wp_customize->add_setting( 'jewelrystore_option[testimonial_title]',
				array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => $option['testimonial_title'],
					'type' => 'option',
				)
			);
			$wp_customize->add_control( 'jewelrystore_option[testimonial_title]',
				array(
					'type'        => 'text',
					'label'       => esc_html__('Section Title', 'britetechs-companion'),
					'section'     => 'testimonial_settings',
					'description' => '',
				)
			);
			$wp_customize->add_setting( 'jewelrystore_option[testimonial_subtitle]',
				array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => $option['testimonial_subtitle'],
					'type' => 'option',
				)
			);
			$wp_customize->add_control( 'jewelrystore_option[testimonial_subtitle]',
				array(
					'type'        => 'text',
					'label'       => esc_html__('Section Subtitle', 'britetechs-companion'),
					'section'     => 'testimonial_settings',
					'description' => '',
				)
			);
		$wp_customize->add_section( 'testimonial_content' ,
			array(
				'priority'    => 2,
				'title'       => esc_html__( 'Testimonial Contents', 'britetechs-companion' ),
				'description' => '',
				'panel'       => 'testimonial_panel',
			)
		);
			$wp_customize->add_setting(
				'jewelrystore_option[testimonial_contents]',
				array(
					'sanitize_callback' => 'jewelry_store_sanitize_repeatable_data_field',
					'transport' => 'refresh', // refresh or postMessage
					'type' => 'option',
					'default' => json_encode(bc_testimonial_default_contents()),
				) );

			$wp_customize->add_control(
				new Jewelry_Store_Customize_Repeatable_Control(
					$wp_customize,
					'jewelrystore_option[testimonial_contents]',
					array(
						'label'     => esc_html__('Testimonial Content', 'britetechs-companion'),
						'description'   => '',
						'priority'     => 40,
						'section'       => 'testimonial_content',
						'live_title_id' => 'title', // apply for unput text and textarea only
						'title_format'  => esc_html__('[live_title]', 'britetechs-companion'), // [live_title]
						'max_item'      => 1,
						'limited_msg'   => wp_kses_post( __('<a target="_blank" href="'.esc_url('https://britetechs.com/jewelry-store-pro-wordpress-theme/').'">Upgrade to PRO</a>', 'britetechs-companion' ) ),
						'fields'    => array(
							'image' => array(
								'title' => esc_html__('Client Image', 'britetechs-companion'),
								'type'  =>'media',
								'default' => array(
									'url' => '',
									'id' => ''
								)
							),
							'title' => array(
								'title' => esc_html__('Client Name', 'britetechs-companion'),
								'type'  =>'text',
								'default' => esc_html__('Client Name', 'britetechs-companion'),
							),
							'position' => array(
								'title' => esc_html__('Designation', 'britetechs-companion'),
								'type'  =>'text',
								'default' => esc_html__('Client Designation', 'britetechs-companion'),
							),
							'desc' => array(
								'title' => esc_html__('Testimonial Content', 'britetechs-companion'),
								'type'  =>'editor',
								'default' => esc_html__('Client Review Content', 'britetechs-companion'),
							),
							'link' => array(
								'title' => esc_html__('Custom Link', 'britetechs-companion'),
								'type'  =>'text',
								'default' => '#',
							),
					
						),

					)
				)
			);

			// container width
            $wp_customize->add_setting( 'jewelrystore_option[testimonial_container_width]',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => $option['testimonial_container_width'],
                    'transport'			=> 'postMessage',
                    'type' => 'option',
                )
            );
            $wp_customize->add_control( 'jewelrystore_option[testimonial_container_width]',
                array(
                    'type'        => 'radio',
                    'label'       => esc_html__('Container Width', 'britetechs-companion'),
                    'section'     => 'testimonial_content',
                    'description' => '',
                    'choices' => array(
                    	'container'=> __('Container','britetechs-companion'),
                    	'container-fluid'=> __('Container Full','britetechs-companion')
                    	),
                )
            );

            // layout
            $wp_customize->add_setting( 'jewelrystore_option[testimonial_layout]',
                array(
                    'sanitize_callback' => 'jewelry_store_sanitize_select',
                    'default'           => $option['testimonial_layout'],
                    'transport'			=> 'postMessage',
                    'type' => 'option',
                )
            );
            $wp_customize->add_control( 'jewelrystore_option[testimonial_layout]',
                array(
                    'type'        => 'select',
                    'label'       => esc_html__('Layout', 'britetechs-companion'),
                    'section'     => 'testimonial_content',
                    'description' => '',
                    'choices' => array(
                    	'layout1'=> __('Layout 1','britetechs-companion'),
                    	),
                )
            );

            // column layout
            $wp_customize->add_setting( 'jewelrystore_option[testimonial_column]',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => $option['testimonial_column'],
                    'transport'			=> 'postMessage',
                    'type' => 'option',
                )
            );
            $wp_customize->add_control( 'jewelrystore_option[testimonial_column]',
                array(
                    'type'        => 'radio',
                    'label'       => esc_html__('Column Layout', 'britetechs-companion'),
                    'section'     => 'testimonial_content',
                    'description' => '',
                    'choices' => array(
                    	2 => __('2 Column','britetechs-companion'),
                    	3 => __('3 Column','britetechs-companion'),
                    	4 => __('4 Column','britetechs-companion'),
                    	),
                )
            );

        $wp_customize->add_section( 'testimonial_background' ,
			array(
				'priority'    => 2,
				'title'       => esc_html__( 'Testimonial Section Background', 'britetechs-companion' ),
				'description' => '',
				'panel'       => 'testimonial_panel',
			)
		);
			$wp_customize->add_setting( 'jewelrystore_option[testimonial_bg_image]',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => $option['testimonial_bg_image'],
					'type' => 'option',
				)
			);
			$wp_customize->add_control( new wp_Customize_Image_Control( $wp_customize,'jewelrystore_option[testimonial_bg_image]',
				array(
					'label'       => esc_html__('Section Background Image', 'britetechs-companion'),
					'section'     => 'testimonial_background',
					'description' => '',
				) )
			);
}
add_action('customize_register','jewelry_store_customizer_testimonial');