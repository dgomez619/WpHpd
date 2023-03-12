<?php
function bc_service_default_contents(){
	return array(
            array(
            'icon'=> 'fa fa-mobile',
			'title'=> esc_html__('Your service title', 'britetechs-companion'),
			'desc'=> esc_html__('Your service description', 'britetechs-companion'),
			'link'=> '#',
            ),
            array(
            'icon'=> 'fa fa-mobile',
			'title'=> esc_html__('Your service title', 'britetechs-companion'),
			'desc'=> esc_html__('Your service description', 'britetechs-companion'),
			'link'=> '#',
            ),
            array(
            'icon'=> 'fa fa-mobile',
			'title'=> esc_html__('Your service title', 'britetechs-companion'),
			'desc'=> esc_html__('Your service description', 'britetechs-companion'),
			'link'=> '#',
            ),
            array(
            'icon'=> 'fa fa-mobile',
			'title'=> esc_html__('Your service title', 'britetechs-companion'),
			'desc'=> esc_html__('Your service description', 'britetechs-companion'),
			'link'=> '#',
            ),
        );
}

function bc_team_default_contents(){
	return array(
            array(
            'image'=> array(
					'url' => plugin_dir_url( __FILE__ ) . 'images/team1.jpg',
					'id' => '51'
				),
			'title'=> 'Your Team Name',
			'position'=> 'Designation',
			'facebook_url'=> '#',
			'twitter_url'=> '#',
			'linkedin_url'=> '#',
			'googleplus_url'=> '#',
			'link' => '#',
            ),
            array(
            'image'=> array(
					'url' => plugin_dir_url( __FILE__ ) . 'images/team2.jpg',
					'id' => ''
				),
			'title'=> 'Your Team Name',
			'position'=> 'Designation',
			'facebook_url'=> '#',
			'twitter_url'=> '#',
			'linkedin_url'=> '#',
			'googleplus_url'=> '#',
			'link' => '#',
            ),
            array(
            'image'=> array(
					'url' => plugin_dir_url( __FILE__ ) . 'images/team3.jpg',
					'id' => ''
				),
			'title'=> 'Your Team Name',
			'position'=> 'Designation',
			'facebook_url'=> '#',
			'twitter_url'=> '#',
			'linkedin_url'=> '#',
			'googleplus_url'=> '#',
			'link' => '#',
            ),
            array(
            'image'=> array(
					'url' => plugin_dir_url( __FILE__ ) . 'images/team4.jpg',
					'id' => ''
				),
			'title'=> 'Your Team Name',
			'position'=> 'Designation',
			'facebook_url'=> '#',
			'twitter_url'=> '#',
			'linkedin_url'=> '#',
			'googleplus_url'=> '#',
			'link' => '#',
            ),
        );
}

function bc_testimonial_default_contents(){
	return array(
            array(
            'image'=> array(
					'url' => plugin_dir_url( __FILE__ ) . 'images/testi1.jpg',
					'id' => ''
				),
			'title'=> 'Title',
			'position'=> 'Manager',
			'desc'=> __('Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet.','britetechs-companion'),
			'link'=> '#',
            ),
        );
}

include('section-all/section-slider.php');
include('section-all/section-service.php');
include('section-all/section-shop.php');
include('section-all/section-testimonial.php');
include('section-all/section-team.php');

function bc_jewelry_store_theme_init(){
	include('customizer/customizer-slider.php');
	include('customizer/customizer-service.php');
	include('customizer/customizer-shop.php');
	include('customizer/customizer-testimonial.php');
	include('customizer/customizer-team.php');
}
add_action('init','bc_jewelry_store_theme_init');