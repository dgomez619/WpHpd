<?php

function hotelone_reset_data(){

	$default_data = array(

		'switcher_hide' => true,
		'room_overlay_hide' => false,
		'theme_color' => '#DAB26C',

		'button_font_size' => 16,
		'button_bg_color' => '',		
		'button_text_color' => '',
		'button_bg_hover_color' => '',
		'button_text_hover_color' => '',
		'button_border_color' => '',
		'button_border_hover_color' => '',
		'button_bold' => 'bold', // normal
		'button_padding' => '5, 10, 5, 10',
		'button_border_radius' => 2,

		'typo_subset' => 'latin',
		'typo_p_fontfamily' => 'Roboto',
		'typo_p_fontsize' => '',
		'typo_p_fontweight' => '',
		'typo_p_lineheight' => '',
		'typo_p_letterspace' => '',
		'typo_p_textdecoration' => '',
		'typo_p_texttransform' => '',
		'typo_p_color' => '',
		
		'typo_m_fontfamily' => 'Roboto',
		'typo_m_fontsize' => '',
		'typo_m_fontweight' => '',
		'typo_m_lineheight' => '',
		'typo_m_letterspace' => '',
		'typo_m_textdecoration' => '',
		'typo_m_texttransform' => '',
		'typo_m_color' => '',
		
		'typo_h_fontfamily' => 'Roboto',
		'typo_h1_fontsize' => '',
		'typo_h2_fontsize' => '',
		'typo_h3_fontsize' => '',
		'typo_h4_fontsize' => '',
		'typo_h5_fontsize' => '',
		'typo_h6_fontsize' => '',
	);

	$default_data = apply_filters('hotelone_reset_data',$default_data);
	return $default_data;
}