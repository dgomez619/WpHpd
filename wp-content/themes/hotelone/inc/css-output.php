<?php

if ( ! function_exists( 'hotelone_get_dynamic_css' ) ) :

	function hotelone_get_dynamic_css() {

		$option = wp_parse_args(  get_option( 'hotelone_option', array() ), hotelone_reset_data() );

		$custom_color_enable = get_theme_mod( 'custom_color_enable', false );
		$theme_color = get_theme_mod( 'theme_color', $option['theme_color'] );
		$custom_color_scheme = get_theme_mod( 'custom_color_scheme', $option['theme_color'] );

		if( $custom_color_enable == true ) {
			$color = $custom_color_scheme;
		} else {
			$color = $theme_color;
		}

		list($r, $g, $b) = sscanf( $color, "#%02x%02x%02x" );

		// Calling Hotelone_CSS class for generate dynamic css
		$pro_css = new Hotelone_CSS;

		$pro_css->set_selector( ':root' );
		$pro_css->add_property( '--primary-color', $color );
		$pro_css->add_property( '--r', $r );
		$pro_css->add_property( '--g', $g );
		$pro_css->add_property( '--b', $b );
		$pro_css->add_property( '--border-color', '#ececec' );
		$pro_css->add_property( '--body-text-color', '#161c2d' );
		$pro_css->add_property( '--body-link-color', $color );
		$pro_css->add_property( '--body-link-hover-color', '#161c2d' );
		$pro_css->add_property( '--heading-text-color', '#161C2D' );
		$pro_css->add_property( '--section-title-color', '#161C2D' );
		$pro_css->add_property( '--section-desc-color', '#161C2D' );

		if(get_theme_mod('header_top_bg_color') !== null ){
			$pro_css->add_property( '--header-top-bg-color', get_theme_mod('header_top_bg_color') );
		}

		if(get_theme_mod('header_top_text_color') !== null ){
			$pro_css->add_property( '--header-top-text-color', get_theme_mod('header_top_text_color') );
		}

		if(get_theme_mod('site_title_color') !== null ){
			$pro_css->add_property( '--site-title-color', get_theme_mod('site_title_color') );
		}

		if(get_theme_mod('site_tagline_color') !== null ){
			$pro_css->add_property( '--site-tagline-color', get_theme_mod('site_tagline_color') );
		}

		if(get_theme_mod('navbar_bg_color') !== null ){
			$pro_css->add_property( '--navbar-bg-color', get_theme_mod('navbar_bg_color') );
		}

		if(get_theme_mod('navbar_link_color') !== null ){
			$pro_css->add_property( '--navbar-link-color', get_theme_mod('navbar_link_color') );
		}

		if(get_theme_mod('navbar_link_hover_color') !== null ){
			$pro_css->add_property( '--navbar-link-hover-color', get_theme_mod('navbar_link_hover_color') );
		}

		if(get_theme_mod('footer_widget_bg_color') !== null ){
			$pro_css->add_property( '--footer-widget-bg-color', get_theme_mod('footer_widget_bg_color') );
		}

		if(get_theme_mod('footer_widget_text_color') !== null ){
			$pro_css->add_property( '--footer-widget-text-color', get_theme_mod('footer_widget_text_color') );
		}

		if(get_theme_mod('footer_widget_link_hover_color') !== null ){
			$pro_css->add_property( '--footer-widget-link-hover-color', get_theme_mod('footer_widget_link_hover_color') );
		}

		if(get_theme_mod('footer_widget_title_color') !== null ){
			$pro_css->add_property( '--footer-widget-title-color', get_theme_mod('footer_widget_title_color') );
		}

		if(get_theme_mod('footer_copyright_bg_color') !== null ){
			$pro_css->add_property( '--footer-copyright-bg-color', get_theme_mod('footer_copyright_bg_color') );
		}

		if(get_theme_mod('footer_copyright_text_color') !== null ){
			$pro_css->add_property( '--footer-copyright-text-color', get_theme_mod('footer_copyright_text_color') );
		}

		if(get_theme_mod('footer_copyright_link_color') !== null ){
			$pro_css->add_property( '--footer-copyright-link-color', get_theme_mod('footer_copyright_link_color') );
		}

		if(get_theme_mod('footer_copyright_link_hover_color') !== null ){
			$pro_css->add_property( '--footer-copyright-link-hover-color', get_theme_mod('footer_copyright_link_hover_color') );
		}

		$pro_css->add_property( '--team-overlay-effect', get_theme_mod('hotelone_team_overlay_effect')?'scale(0)':'scale(1)' );
		$pro_css->add_property( '--team-overlay-color', get_theme_mod('hotelone_team_overlay_color')?get_theme_mod('hotelone_team_overlay_color'):'rgba(0,0,0,.4)' );

		if(get_theme_mod('hotelone_logo_height')){
			$pro_css->set_selector( '.navbar-brand img' );
			$pro_css->add_property( 'max-height', absint( get_theme_mod('hotelone_logo_height', 50 ) ) . 'px' );
		}

		$pro_css->set_selector( '.navbar-nav > li > a' );
		$pro_css->add_property( 'padding', '0 ' . absint( get_theme_mod('hotelone_menu_width', 15 ) ) . 'px' );
		$pro_css->add_property( 'line-height', absint( get_theme_mod('hotelone_menu_padding', 85 ) ) . 'px' );

		$pro_css->set_selector( '.subheader .subheaderInner' );
		$pro_css->add_property( 'padding-top', absint( get_theme_mod('hotelone_page_cover_pd_top', 100 ) ) . 'px' );
		$pro_css->add_property( 'padding-bottom', absint( get_theme_mod('hotelone_page_cover_pd_bottom', 100 ) ) . 'px' );

		$b_fontfamily = $option['typo_p_fontfamily']; 
		$b_fontsize = $option['typo_p_fontsize']; 
		$b_fontweight = $option['typo_p_fontweight']; 
		$b_lineheight = $option['typo_p_lineheight']; 
		$b_letterspace = $option['typo_p_letterspace']; 
		$b_textdecoration = $option['typo_p_textdecoration']; 
		$b_texttransform = $option['typo_p_texttransform']; 
		$b_color = $option['typo_p_color'];
		
		$m_fontfamily = $option['typo_m_fontfamily']; 
		$m_fontsize = $option['typo_m_fontsize']; 
		$m_fontweight = $option['typo_m_fontweight']; 
		$m_lineheight = $option['typo_m_lineheight']; 
		$m_letterspace = $option['typo_m_letterspace']; 
		$m_textdecoration = $option['typo_m_textdecoration']; 
		$m_texttransform = $option['typo_m_texttransform']; 
		$m_color = $option['typo_m_color'];
		
		$h_fontfamily = $option['typo_h_fontfamily'];
		$h1_fontsize = $option['typo_h1_fontsize'];
		$h2_fontsize = $option['typo_h2_fontsize'];
		$h3_fontsize = $option['typo_h3_fontsize'];
		$h4_fontsize = $option['typo_h4_fontsize'];
		$h5_fontsize = $option['typo_h5_fontsize'];
		$h6_fontsize = $option['typo_h6_fontsize'];

		$page_background_color = get_theme_mod('page_bg_color','#ffffff');

		$pro_css->set_selector( 'body' );

		if(isset($b_fontfamily)){
			$pro_css->add_property( 'font-family', $b_fontfamily . ', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"' );
		}

		if(isset($b_fontsize)){
			$pro_css->add_property( 'font-size', $b_fontsize . 'px' );
		}

		if(isset($b_fontweight)){
			$pro_css->add_property( 'font-weight', $b_fontweight );
		}

		if(isset($b_lineheight)){
			$pro_css->add_property( 'line-height', $b_lineheight . 'px' );
		}

		if(isset($b_letterspace)){
			$pro_css->add_property( 'letter-spacing', $b_letterspace . 'px' );
		}

		if(isset($b_texttransform)){
			$pro_css->add_property( 'text-transform', $b_texttransform );
		}

		if(isset($b_color)){
			$pro_css->add_property( 'color', $b_color );
		}

		$pro_css->set_selector( 'body a' );

		if(isset($b_textdecoration)){
			$pro_css->add_property( 'text-decoration', $b_textdecoration );
		}

		$pro_css->set_selector( '.navbar-nav > li > a, .dropdown-menu > li > a' );
		
		if(isset($m_fontfamily)){
			$pro_css->add_property( 'font-family', $m_fontfamily . ', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"' );
		}

		if(isset($m_fontsize)){
			$pro_css->add_property( 'font-size', $m_fontsize . 'px' );
		}

		if(isset($m_fontweight)){
			$pro_css->add_property( 'font-weight', $m_fontweight );
		}

		if(isset($m_lineheight)){
			$pro_css->add_property( 'line-height', $m_lineheight . 'px' );
		}

		if(isset($m_letterspace)){
			$pro_css->add_property( 'letter-spacing', $m_letterspace . 'px' );
		}

		if(isset($m_texttransform)){
			$pro_css->add_property( 'text-transform', $m_texttransform );
		}

		if(isset($m_color)){
			$pro_css->add_property( 'color', $m_color );
		}

		$pro_css->set_selector( 'h1, h2, h3, h4, h5, h6' );

		if( isset($h_fontfamily) ){
			$pro_css->set_selector( 'h1, h2, h3, h4, h5, h6' );
			$pro_css->add_property( 'font-family', $h_fontfamily . ', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"' );
		}

		if(isset($h1_fontsize)){
			$pro_css->set_selector( 'h1' );
			$pro_css->add_property( 'font-size', $h1_fontsize . 'px' );
		}

		if(isset($h2_fontsize)){
			$pro_css->set_selector( 'h2' );
			$pro_css->add_property( 'font-size', $h1_fontsize . 'px' );
		}

		if(isset($h3_fontsize)){
			$pro_css->set_selector( 'h3' );
			$pro_css->add_property( 'font-size', $h1_fontsize . 'px' );
		}

		if(isset($h4_fontsize)){
			$pro_css->set_selector( 'h4' );
			$pro_css->add_property( 'font-size', $h1_fontsize . 'px' );
		}

		if(isset($h5_fontsize)){
			$pro_css->set_selector( 'h5' );
			$pro_css->add_property( 'font-size', $h1_fontsize . 'px' );
		}

		if(isset($h6_fontsize)){
			$pro_css->set_selector( 'h6' );
			$pro_css->add_property( 'font-size', $h1_fontsize . 'px' );
		}

		if(isset($page_background_color)){
			$pro_css->set_selector( '.site-content' );
			$pro_css->add_property( 'background-color', $page_background_color );
		}

		$pro_css->set_selector( '.site-content > a:hover, .site-content > a:focus' );
		$pro_css->add_property( 'color', 'var(--primary-color)' );

		if( get_theme_mod('hotelone_recipe_read_more') == false ){
			$pro_css->set_selector( '.recipe-des .text-center .more-link' );
			$pro_css->add_property( 'display', 'none' );
		}

		if( get_theme_mod('hotelone_recipe_desc') == false ){
			$pro_css->set_selector( '.recipe-des' );
			$pro_css->add_property( 'display', 'none' );
		}

		$fcopy_padding = (get_theme_mod('footer_copyright_padding')?get_theme_mod('footer_copyright_padding'):'25, , 25, ');
		if(isset($fcopy_padding)){
			$fcopy_padding = explode(', ', $fcopy_padding);
			$pro_css->set_selector( '.footer_section .copy_right' );
			$pro_css->add_property( 'padding-top', absint( $fcopy_padding[0] ) . 'px' );
			$pro_css->add_property( 'padding-right', absint( $fcopy_padding[1] ) . 'px' );
			$pro_css->add_property( 'padding-bottom', absint( $fcopy_padding[2] ) . 'px' );
			$pro_css->add_property( 'padding-left', absint( $fcopy_padding[3] ) . 'px' );
		}

		$pro_css->set_selector( '.theme-btn,
		.more-link,
		button,
		.button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"]' );
		$pro_css->add_property( 'background-color', 'var(--primary-color)' );
		$pro_css->add_property( 'border', '1px solid var(--primary-color)' );
		$pro_css->add_property( 'border-radius', '4px' );
		$pro_css->add_property( 'box-sizing', 'border-box' );
		$pro_css->add_property( 'color', '#fff' );
		$pro_css->add_property( 'cursor', 'pointer' );
		$pro_css->add_property( 'font-size', '16px' );
		$pro_css->add_property( 'font-weight', 'normal' );
		$pro_css->add_property( 'padding', '10px 25px' );
		$pro_css->add_property( 'text-align', 'center' );
		$pro_css->add_property( 'transform', 'translateY(0)' );
		$pro_css->add_property( 'transition', 'transform 150ms, box-shadow 150ms' );
		$pro_css->add_property( 'user-select', 'none' );
		$pro_css->add_property( '-webkit-user-select', 'none' );
		$pro_css->add_property( 'touch-action', 'manipulation' );
		

		$pro_css->set_selector( '.theme-btn:hover,
		.theme-btn:focus,
		.more-link:hover,
		.more-link:focus,
		button:hover,
		button:focus,
		.button:hover,
		.button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.wp-block-search .wp-block-search__button:hover,
		.wp-block-search .wp-block-search__button:focus');
		$pro_css->add_property( 'box-shadow', 'rgba(0, 0, 0, .15) 0 3px 9px 0' );
		$pro_css->add_property( 'color', '#ffffff');

		return apply_filters( 'hotelone_pro_dynamic_css', wp_strip_all_tags( $pro_css->css_output() ) );
	}

endif;

if ( ! function_exists( 'hotelone_enqueue_dynamic_css' ) ) :

	function hotelone_enqueue_dynamic_css() {

		$css = hotelone_get_dynamic_css();
		wp_register_style( 'hotelone-style', false );
		wp_enqueue_style( 'hotelone-style' );

		wp_add_inline_style( 'hotelone-style', wp_strip_all_tags( $css ) );

	}

	add_action( 'wp_enqueue_scripts', 'hotelone_enqueue_dynamic_css');
	
endif;