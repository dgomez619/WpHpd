<?php

// Elementor section

if( !function_exists('hotelone_elementor_section') ){

	function hotelone_elementor_section(){

		get_template_part('sections/section','elementor');

	}

}

if( function_exists('hotelone_elementor_section') ){

	$section_priority = apply_filters( 'hotelone_section_priority', 11, 'hotelone_elementor_section' );

	add_action('hotelone_sections','hotelone_elementor_section', absint($section_priority));

}

// Blog section

if( !function_exists('hotelone_blog_section') ){

	function hotelone_blog_section(){

		get_template_part('sections/section','blog');

	}

}

if( function_exists('hotelone_blog_section') ){

	$section_priority = apply_filters( 'hotelone_section_priority', 100, 'hotelone_blog_section' );

	add_action('hotelone_sections','hotelone_blog_section', absint($section_priority));

}