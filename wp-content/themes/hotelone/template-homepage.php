<?php 
/*
 * Template Name: Front Page
 */
if ( is_page_template() ) {
	
	get_header();

		do_action( 'hotelone_sections', false );
		
	get_footer();
	
} else {
	
	include( get_page_template() );
	
}