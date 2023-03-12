<?php
function hotelone_customizer_theme_option( $wp_customize ){

	require get_template_directory() . '/inc/hotelone-customizer-controls.php';
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$pages  =  get_pages();
	$hotelone_option_pages = array();
	$hotelone_option_pages[0] = esc_html__( 'Select page', 'hotelone' );
	foreach( $pages as $page ){
		$hotelone_option_pages[ $page->ID ] = $page->post_title;
	}

    $option = hotelone_reset_data();

    // site title color
    $wp_customize->add_setting( 'site_title_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
        'default' => '',
        'transport' => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
    'site_title_color',
        array(
            'label'       => esc_html__( 'Site Title Color', 'hotelone' ),
            'section'     => 'title_tagline',
        )
    ));

    // site desc color
    $wp_customize->add_setting( 'site_tagline_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
        'default' => '',
        'transport' => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
    'site_tagline_color',
        array(
            'label'       => esc_html__( 'Site Tagline Color', 'hotelone' ),
            'section'     => 'title_tagline',
        )
    ));

    if( !class_exists('Hotelone_Pro') ):
        // theme primary color
        $wp_customize->add_setting( 'theme_color', array(
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => $option['theme_color'],
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
        'theme_color',
            array(
                'label'       => esc_html__( 'Primary Color', 'hotelone' ),
                'section'     => 'colors',
            )
        ));
    endif;
	
	$wp_customize->add_panel( 'hotelone_option',
		array(
			'priority'       => 30,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Theme Options', 'hotelone' ),
		)
	);
		$wp_customize->add_section( 'globel_section' ,
			array(
				'priority'    => 5,
				'title'       => esc_html__( 'Global', 'hotelone' ),
				'panel'       => 'hotelone_option',
			)
		);
		
			$wp_customize->add_setting( 'hotelone_layout',
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'default'           => 'right',
						'transport'			=> 'postMessage'
					)
				);
			$wp_customize->add_control( 'hotelone_layout',
				array(
					'type'        => 'select',
					'label'       => esc_html__('Site Layout', 'hotelone'),
					'section'     => 'globel_section',
					'choices' => array(
						'right' => esc_html__('Right sidebar', 'hotelone'),
						'left' => esc_html__('Left sidebar', 'hotelone'),
						'none' => esc_html__('No sidebar', 'hotelone'),
					)
				)
			);
			
			$wp_customize->add_setting( 'hotelone_animation_hide',
				array(
					'sanitize_callback' => 'hotelone_sanitize_checkbox',
					'default'           => false,
				)
			);
			$wp_customize->add_control( 'hotelone_animation_hide',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Disable animation effect?', 'hotelone'),
					'section'     => 'globel_section',
				)
			);
			
			
			$wp_customize->add_setting( 'hotelone_btt_hide',
				array(
					'sanitize_callback' => 'hotelone_sanitize_checkbox',
					'default'           => false,
					'transport'			=> 'postMessage'
				)
			);
			$wp_customize->add_control( 'hotelone_btt_hide',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide footer back to top?', 'hotelone'),
					'section'     => 'globel_section',
				)
			);
			
			$wp_customize->add_setting( 'hotelone_hide_g_font',
                array(
                    'sanitize_callback' => 'hotelone_sanitize_checkbox',
                    'default'           => false,
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'hotelone_hide_g_font',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Disable Google Fonts', 'hotelone'),
                    'section'     => 'globel_section',
                )
            );
			
		$wp_customize->add_section( 'header_topbar_section' ,
			array(
				'priority'    => 10,
				'title'       => esc_html__( 'Header: Top Bar', 'hotelone' ),
				'panel'       => 'hotelone_option',
			)
		);
			$wp_customize->add_setting( 'disable_header_tb',
                array(
                    'sanitize_callback' => 'hotelone_sanitize_checkbox',
                    'default'           => false,
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'disable_header_tb',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Disable Header Top Bar?', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );
			
			$wp_customize->add_setting( 'hide_facebook_icon',
                array(
                    'sanitize_callback' => 'hotelone_sanitize_checkbox',
                    'default'           => false,
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'hide_facebook_icon',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Hide Facebook Icon', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );

			$wp_customize->add_setting( 'facebook_url',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => '#',
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'facebook_url',
                array(
                    'type'        => 'text',
                    'label'       => esc_html__('Facebook URL', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );

            $wp_customize->add_setting( 'hide_twitter_icon',
                array(
                    'sanitize_callback' => 'hotelone_sanitize_checkbox',
                    'default'           => false,
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'hide_twitter_icon',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Hide Twitter Icon', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );
			
			$wp_customize->add_setting( 'twitter_url',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => '#',
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'twitter_url',
                array(
                    'type'        => 'text',
                    'label'       => esc_html__('Twitter URL', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );

            $wp_customize->add_setting( 'hide_google_plus_icon',
                array(
                    'sanitize_callback' => 'hotelone_sanitize_checkbox',
                    'default'           => false,
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'hide_google_plus_icon',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Hide Google Plus Icon', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );
			
			$wp_customize->add_setting( 'google_plus_url',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => '#',
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'google_plus_url',
                array(
                    'type'        => 'text',
                    'label'       => esc_html__('Google Plus URL', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );

            $wp_customize->add_setting( 'hide_houzz_icon',
                array(
                    'sanitize_callback' => 'hotelone_sanitize_checkbox',
                    'default'           => false,
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 'hide_houzz_icon',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Hide Houzz Icon', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );

            $wp_customize->add_setting( 'houzz_url',
                array(
                    'sanitize_callback' => 'esc_url_raw',
                    'default'           => '#',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 'houzz_url',
                array(
                    'type'        => 'text',
                    'label'       => esc_html__('Houzz URL', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );
			
			$wp_customize->add_setting( 'social_target',
                array(
                    'sanitize_callback' => 'hotelone_sanitize_checkbox',
                    'default'           => true,
                    'transport'			=> 'postMessage'
                )
            );
            $wp_customize->add_control( 'social_target',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Social Icons Open In New Tab', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );
			
			$wp_customize->add_setting( 'phone',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => '',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 'phone',
                array(
                    'type'        => 'text',
                    'label'       => esc_html__('Phone:', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );

            $wp_customize->add_setting( 'phone_url',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => 'tel:{phone}',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 'phone_url',
                array(
                    'type'        => 'text',
                    'label'       => esc_html__('Phone Custom URL:', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );
            
            $wp_customize->add_setting( 'email',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => '',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 'email',
                array(
                    'type'        => 'text',
                    'label'       => esc_html__('Email:', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );

            $wp_customize->add_setting( 'email_url',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => 'mailto:{email}',
                    'transport'         => 'postMessage'
                )
            );
            $wp_customize->add_control( 'email_url',
                array(
                    'type'        => 'text',
                    'label'       => esc_html__('Email Custom URL:', 'hotelone'),
                    'section'     => 'header_topbar_section',
                )
            );

            // header top background color
            $wp_customize->add_setting( 'header_top_bg_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'header_top_bg_color',
                array(
                    'label'       => esc_html__( 'Background Color', 'hotelone' ),
                    'section'     => 'header_topbar_section',
                )
            ));

            // header top text color
            $wp_customize->add_setting( 'header_top_text_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'header_top_text_color',
                array(
                    'label'       => esc_html__( 'Text Color', 'hotelone' ),
                    'section'     => 'header_topbar_section',
                )
            ));
			
		$wp_customize->add_section( 'header_section' ,
			array(
				'priority'    => 15,
				'title'       => esc_html__( 'Header', 'hotelone' ),
				'description' => '',
				'panel'       => 'hotelone_option',
			)
		);
		
			$wp_customize->add_setting( 'hotelone_header_width',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => 'contained',
					'transport' => 'postMessage',
				)
			);
			$wp_customize->add_control( 'hotelone_header_width',
				array(
					'type'        => 'select',
					'label'       => esc_html__('Header Width', 'hotelone'),
					'section'     => 'header_section',
					'choices' => array(
						'full-width' => esc_html__('Full Width', 'hotelone'),
						'contained' => esc_html__('Contained', 'hotelone')
					)
				)
			);
			
			$wp_customize->add_setting( 'hotelone_header_position',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => 'top',
					'transport' => 'postMessage',
				)
			);
			$wp_customize->add_control( 'hotelone_header_position',
				array(
					'type'        => 'select',
					'label'       => esc_html__('Header Position', 'hotelone'),
					'section'     => 'header_section',
					'choices' => array(
						'top' => esc_html__('Top', 'hotelone'),
						'below_slider' => esc_html__('Below Slider', 'hotelone')
					)
				)
			);
			
			$wp_customize->add_setting( 'hotelone_sticky_header_disable',
				array(
					'sanitize_callback' => 'hotelone_sanitize_checkbox',
					'default'           => false,
					'transport' => 'postMessage',
				)
			);
			$wp_customize->add_control( 'hotelone_sticky_header_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Disable Sticky Header?', 'hotelone'),
					'section'     => 'header_section',
				)
			);
			
			$wp_customize->add_setting( 'hotelone_vertical_align_menu',
				array(
					'sanitize_callback' => 'hotelone_sanitize_checkbox',
					'default'           => false,
				)
			);
			$wp_customize->add_control( 'hotelone_vertical_align_menu',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Center vertical align for menu', 'hotelone'),
					'section'     => 'header_section',
				)
			);
			
			$wp_customize->add_setting( 'hotelone_header_scroll_logo',
				array(
					'sanitize_callback' => 'hotelone_sanitize_checkbox',
					'default'           => false,
					'active_callback'   => ''
				)
			);
			$wp_customize->add_control( 'hotelone_header_scroll_logo',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Scroll to top when click to the site logo or site title, only apply on front page.', 'hotelone'),
					'section'     => 'header_section',
				)
			);
			
		$wp_customize->add_section( 'hotelone_navbar' ,
			array(
				'priority'    => null,
				'title'       => esc_html__( 'Primary Navigation', 'hotelone' ),
				'description' => '',
				'panel'       => 'hotelone_option',
			)
		);
            // padding setting
            $wp_customize->add_setting( 'hotelone_menu_padding',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => 85,
                    'transport' => 'postMessage'
                )
            );
            $wp_customize->add_control( 'hotelone_menu_padding',
                array(
                    'label'       => esc_html__('Menu Item Padding (px)', 'hotelone'),
                    'section'     => 'hotelone_navbar',
                )
            );

            // navbar bg color
            $wp_customize->add_setting( 'navbar_bg_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'navbar_bg_color',
                array(
                    'label'       => esc_html__( 'Navbar Background Color', 'hotelone' ),
                    'section'     => 'hotelone_navbar',
                )
            ));

            // navbar link color
            $wp_customize->add_setting( 'navbar_link_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'navbar_link_color',
                array(
                    'label'       => esc_html__( 'Menu Link Color', 'hotelone' ),
                    'section'     => 'hotelone_navbar',
                )
            ));

            // navbar link hover color
            $wp_customize->add_setting( 'navbar_link_hover_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'navbar_link_hover_color',
                array(
                    'label'       => esc_html__( 'Menu Link Hover Color', 'hotelone' ),
                    'section'     => 'hotelone_navbar',
                )
            ));
			
		$wp_customize->add_section( 'hotelone_page' ,
			array(
				'priority'    => null,
				'title'       => esc_html__( 'Page Title Area', 'hotelone' ),
				'panel'       => 'hotelone_option',
			)
		);
		
			$wp_customize->add_setting( 'hotelone_page_title_bar_hide',
				array(
					'sanitize_callback' => 'hotelone_sanitize_checkbox',
					'default'           => '',
				)
			);
			$wp_customize->add_control( 'hotelone_page_title_bar_hide',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Disable Page Title bar?', 'hotelone'),
					'section'     => 'hotelone_page',
				)
			);
			
			$wp_customize->add_setting( 'hotelone_page_cover_pd_top',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => 100,
					'transport' => 'postMessage'
				)
			);
			$wp_customize->add_control( 'hotelone_page_cover_pd_top',
				array(
					'label'       => esc_html__('Padding Top', 'hotelone'),
					'section'     => 'hotelone_page',
				)
			);
			
			$wp_customize->add_setting( 'hotelone_page_cover_pd_bottom',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => 100,
					'transport' => 'postMessage'
				)
			);
			$wp_customize->add_control( 'hotelone_page_cover_pd_bottom',
				array(
					'label'       => esc_html__('Padding Bottom', 'hotelone'),
					'section'     => 'hotelone_page',
				)
			);
			
			$wp_customize->add_setting( 'hotelone_page_cover_align',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => 'center',
					'transport' => 'postMessage'
				)
			);
			$wp_customize->add_control( 'hotelone_page_cover_align',
				array(
					'label'       => esc_html__('Content Align', 'hotelone'),
					'section'     => 'hotelone_page',
					'type'        => 'select',
					'choices'     => array(
						'center' => esc_html__('Center', 'hotelone'),
						'left' => esc_html__('Left', 'hotelone'),
						'right' => esc_html__('Right', 'hotelone'),
					),
				)
			);
			
		$wp_customize->add_section( 'hotelone_single' ,
			array(
				'priority'    => null,
				'title'       => esc_html__( 'Single Post', 'hotelone' ),
				'panel'       => 'hotelone_option',
			)
		);
		
			$wp_customize->add_setting( 'single_thumbnail',
				array(
					'sanitize_callback' => 'hotelone_sanitize_checkbox',
					'default'           => '',
				)
			);
			$wp_customize->add_control( 'single_thumbnail',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Show single post thumbnail', 'hotelone'),
					'section'     => 'hotelone_single',
				)
			);
			
			$wp_customize->add_setting( 'single_meta',
				array(
					'sanitize_callback' => 'hotelone_sanitize_checkbox',
					'default'           => true,
				)
			);
			$wp_customize->add_control( 'single_meta',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Show single post meta', 'hotelone'),
					'section'     => 'hotelone_single',
				)
			);
			
		$wp_customize->add_section( 'footer_widget_section' ,
			array(
				'title'       => esc_html__( 'Footer Widgets', 'hotelone' ),
				'panel'       => 'hotelone_option',
			)
		);
		
			$wp_customize->add_setting( 'footer_column_layout',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => 4,
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control( 'footer_column_layout',
				array(
					'type'        => 'select',
					'label'       => esc_html__('Layout', 'hotelone'),
					'section'     => 'footer_widget_section',
					'default' => '0',
					'choices' => array(
						'4' => 4,
						'3' => 3,
						'2' => 2,
						'1' => 1,
						'0' => esc_html__('Disable footer widgets', 'hotelone'),
					)
				)
			);
			
			for ( $i = 1; $i<=4; $i ++ ) {
				$df = 12;
				if ( $i > 1 ) {
					$_n = 12/$i;
					$df = array();
					for ( $j = 0; $j < $i; $j++ ) {
						$df[ $j ] = $_n;
					}
					$df = join( '+', $df );
				}
				$wp_customize->add_setting('footer_custom_'.$i.'_columns',
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => $df,
						'transport' => 'postMessage',
					)
				);
				$wp_customize->add_control('footer_custom_'.$i.'_columns',
					array(
						'label' => $i == 1 ? __('Custom footer 1 column width', 'hotelone') : sprintf( __('Custom footer %s columns width', 'hotelone'), $i ),
						'section' => 'footer_widget_section',
						'description' => esc_html__('Enter int numbers and sum of them must smaller or equal 12, separated by "+"', 'hotelone'),
					)
				);
			}

            // footer widget bg color
            $wp_customize->add_setting( 'footer_widget_bg_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'footer_widget_bg_color',
                array(
                    'label'       => esc_html__( 'Background Color', 'hotelone' ),
                    'section'     => 'footer_widget_section',
                )
            ));

            // footer widget text color
            $wp_customize->add_setting( 'footer_widget_text_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'footer_widget_text_color',
                array(
                    'label'       => esc_html__( 'Text Color', 'hotelone' ),
                    'section'     => 'footer_widget_section',
                )
            ));

            // footer widget link hover color
            $wp_customize->add_setting( 'footer_widget_link_hover_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'footer_widget_link_hover_color',
                array(
                    'label'       => esc_html__( 'Link Hover Color', 'hotelone' ),
                    'section'     => 'footer_widget_section',
                )
            ));

            // footer widget title color
            $wp_customize->add_setting( 'footer_widget_title_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'footer_widget_title_color',
                array(
                    'label'       => esc_html__( 'Widget Title Color', 'hotelone' ),
                    'section'     => 'footer_widget_section',
                )
            ));
			
		$wp_customize->add_section( 'hotelone_footer_copyright' ,
			array(
				'priority'    => null,
				'title'       => esc_html__( 'Footer Copyright', 'hotelone' ),
				'panel'       => 'hotelone_option',
			)
		);
		
			$wp_customize->add_setting( 'footer_copyright_text',
				array(
					'sanitize_callback' => 'wp_kses_post',
					'default'           => '',
				)
			);

			$wp_customize->add_control( 'footer_copyright_text',
				array(
					'type'        => 'textarea',
					'label'       => esc_html__('Copyright Text', 'hotelone'),
					'section'     => 'hotelone_footer_copyright',
			) );

            // footer copyright bg color
            $wp_customize->add_setting( 'footer_copyright_bg_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'footer_copyright_bg_color',
                array(
                    'label'       => esc_html__( 'Background Color', 'hotelone' ),
                    'section'     => 'hotelone_footer_copyright',
                )
            ));

            // footer copyright text color
            $wp_customize->add_setting( 'footer_copyright_text_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'footer_copyright_text_color',
                array(
                    'label'       => esc_html__( 'Text Color', 'hotelone' ),
                    'section'     => 'hotelone_footer_copyright',
                )
            ));

            // footer copyright link color
            $wp_customize->add_setting( 'footer_copyright_link_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'footer_copyright_link_color',
                array(
                    'label'       => esc_html__( 'Link Color', 'hotelone' ),
                    'section'     => 'hotelone_footer_copyright',
                )
            ));

            // footer copyright link hover color
            $wp_customize->add_setting( 'footer_copyright_link_hover_color', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '',
                'transport' => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 
            'footer_copyright_link_hover_color',
                array(
                    'label'       => esc_html__( 'Link Hover Color', 'hotelone' ),
                    'section'     => 'hotelone_footer_copyright',
                )
            ));
            
}
add_action( 'customize_register' , 'hotelone_customizer_theme_option' );

function hotelone_frontpage_panel_register( $wp_customize ){
    
    $wp_customize->add_panel( 'frontpage_panel' ,
        array(
            'priority'        => 31,
            'title'           => esc_html__( 'Frontpage Sections', 'hotelone' ),
            'capabitity' => 'edit_theme_options',
        )
    );
}
add_action('customize_register','hotelone_frontpage_panel_register');