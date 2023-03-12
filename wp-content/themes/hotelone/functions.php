<?php 

/**
 * HotelOne functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hotelone

 */

// Theme Core Constants
define( 'HOTELONE_THEME_DIR', get_template_directory() );
define( 'HOTELONE_THEME_URI', get_template_directory_uri() );
$theme = wp_get_theme();
define( 'HOTELONE_THEME_VERSION', $theme->get('Version') );

 if( ! function_exists( 'hotelone_setup' ) ):

	function hotelone_setup() {
		
		load_theme_textdomain( 'hotelone', get_template_directory() . '/languages' );
		
		add_theme_support( 'automatic-feed-links' );

		remove_theme_support( 'widgets-block-editor' );
		
		add_theme_support( 'title-tag' );
		
		add_post_type_support( 'page', 'excerpt' );
		
		add_theme_support( 'post-thumbnails' );

		// Set content-width.
		global $content_width;
		
		if ( ! isset( $content_width ) ) {
			$content_width = 800;
		}
		
		register_nav_menus( array(
			'primary'      => esc_html__( 'Primary Menu', 'hotelone' ),
		) );
		
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		add_editor_style( array( 'css/editor-style.css', hotelone_fonts_url() ) );
		
		add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 150,
            'flex-height' => true,
            'flex-width'  => true,
        ) );
		
		$args = array(
			'width'        => 1600,
			'flex-width'   => true,
			'default-image' => get_template_directory_uri() . '/images/sub-header.jpg',
			// Header text
			'header-text'   => false,
		);
		add_theme_support( 'custom-header', $args );

		add_theme_support( 'custom-background' );
		
		add_theme_support( 'recommend-plugins', array(
			'britetechs-companion' => array(
                'name' => esc_html__( 'Britetechs Companion', 'hotelone' ),
                'active_filename' => 'britetechs-companion/britetechs-companion.php',
				'desc' => esc_html__( 'We highly recommend that you install the britetechs companion plugin to gain access to the team and testimonial sections.', 'hotelone' ),
            ),
			'motopress-hotel-booking-lite' => array(
                'name' => esc_html__( 'Motopress Hotel Booking Plugin', 'hotelone' ),
                'active_filename' => 'motopress-hotel-booking-lite/motopress-hotel-booking.php',
            ),
            'contact-form-7' => array(
                'name' => esc_html__( 'Contact Form 7', 'hotelone' ),
                'active_filename' => 'contact-form-7/wp-contact-form-7.php',
            ),
        ) );
		
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );
	}

	add_action( 'after_setup_theme', 'hotelone_setup' );

endif;

/**
 * Register default Google fonts
 */
if ( ! function_exists( 'hotelone_fonts_url' ) ) :
	
	function hotelone_fonts_url() {

	    $fonts_url = '';

	    $Lato = _x( 'on', 'Lato font: on or off', 'hotelone' );
	    $Roboto = _x( 'on', 'Roboto font: on or off', 'hotelone' );
	    $dansing = _x( 'on', 'Dansing Script font: on or off', 'hotelone' );
	    $merriweather = _x( 'on', 'Dansing Script font: on or off', 'hotelone' );

	    if ( 'off' !== $Roboto ) {
	        $font_families = array();

	        if ( 'off' !== $Roboto ) {
	            $font_families[] = 'Roboto:100,200,400,500,600,700,300,100,800,900,italic';
	        }

	        if ( 'off' !== $Lato ) {
	            $font_families[] = 'Lato:100,200,400,500,600,700,300,100,800,900,italic';
	        }

	        if ( 'off' !== $dansing ) {
	            $font_families[] = 'Dancing Script:100,200,400,500,600,700,300,100,800,900,italic';
	        }

	        if ( 'off' !== $merriweather ) {
	            $font_families[] = 'Merriweather:100,200,400,500,600,700,300,100,800,900,italic';
	        }
	        
	        $option = wp_parse_args(  get_option( 'hotelone_option', array() ), hotelone_reset_data() );
			$b_fontfamily = $option['typo_p_fontfamily'];
			if ( $b_fontfamily ) {
	            $font_families[] = $b_fontfamily . ':100,200,400,500,600,700,300,100,800,900,italic';
	        }
			$m_fontfamily = $option['typo_m_fontfamily'];
			if ( $m_fontfamily ) {
	            $font_families[] = $m_fontfamily . ':100,200,400,500,600,700,300,100,800,900,italic';
	        }
			$h_fontfamily = $option['typo_h_fontfamily'];
			if ( $h_fontfamily ) {
	            $font_families[] = $h_fontfamily . ':100,200,400,500,600,700,300,100,800,900,italic';
	        }else{
	        	$font_families[] = 'Nunito:100,200,400,500,600,700,300,100,800,900,italic';
	        }
	        
	        $subset = $option['typo_subset'];
			
	        $query_args = array(
	            'family' => urlencode( implode( '|', $font_families ) ),
	            'subset' => urlencode( $subset ),
	        );

	        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	    }

	    return esc_url_raw( $fonts_url );
	}

endif;

/**
 * Enqueue scripts and styles for the template.
 */
if( !function_exists( 'hotelone_scripts' ) ):

	function hotelone_scripts() {

		$theme = wp_get_theme( 'hotelone' );

	    $version = $theme->get( 'Version' );

		$disableGoogleFonts = get_theme_mod('hotelone_hide_g_font', 0 );

		if ( $disableGoogleFonts == false ) {

	        wp_enqueue_style('hotelone-fonts', hotelone_fonts_url(), array(), $version);

	    }
		
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() .'/css/font-awesome/css/font-awesome.css', array(), '4.4.0' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/css/bootstrap.css', array(), $version );
		wp_enqueue_style( 'animate', get_template_directory_uri() .'/css/animate.css', array(), $version );
		wp_enqueue_style( 'awebooking', get_template_directory_uri() .'/css/awebooking.css', array(), $version, true );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() .'/css/owl.carousel.css', array(), $version );
		wp_enqueue_style( 'meanmenu', get_template_directory_uri() .'/css/meanmenu.css', array(), $version );		
		wp_enqueue_style( 'hotelone-style', get_template_directory_uri() .'/style.css', array(), $version );

		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), $version, true );
		wp_enqueue_script( 'hotelone-page-scroll-js', get_template_directory_uri() . '/js/page-scroll.js', array(), $version, true );
		wp_enqueue_script( 'wow-js', get_template_directory_uri() . '/js/wow.js', array(), $version, true );
		wp_enqueue_script( 'waypoints-js', get_template_directory_uri() . '/js/jquery.waypoints.js', array(), $version, true );
		wp_enqueue_script( 'meanmenu-js', get_template_directory_uri() . '/js/jquery.meanmenu.js', array(), $version, true );
		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.js', array(), $version, true );
		wp_enqueue_script( 'parallaxie-js', get_template_directory_uri() . '/js/parallaxie.js', array(), $version, true );
		wp_enqueue_script( 'hotelone-custom', get_template_directory_uri() . '/js/custom.js', array(), $version, true );	
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		// settings.
		$custom_color_enable = get_theme_mod( 'custom_color_enable', false );
		$theme_color = get_theme_mod( 'theme_color', '#DAB26C' );
		$custom_color_scheme = get_theme_mod( 'custom_color_scheme', '#DAB26C' );

		if( $custom_color_enable == true ) {
			$color = $custom_color_scheme;
		} else {
			$color = $theme_color;
		}
			
	    $hotelone_settings = array(
	        'homeUrl'     => home_url( '/' ),
			'disable_animations' => get_theme_mod('hotelone_animation_hide',false),
			'disable_automation_effect_counters' => get_theme_mod('disable_automation_effect_counters',false),
			'client_no_of_show' => get_theme_mod('client_no_of_show',5),
			'primary_color' => esc_attr( $color ),
	    );

		wp_localize_script( 'hotelone-page-scroll-js', 'hotelone_settings', $hotelone_settings );
	}

	add_action( 'wp_enqueue_scripts', 'hotelone_scripts' );

endif;

if( ! function_exists('hotelone_admin_enqueue_script_function') ):

	function hotelone_admin_enqueue_script_function(){

		wp_enqueue_style('hotelone-drag-drop', get_template_directory_uri() . '/css/drag-drop.css');

		wp_enqueue_script( 'hotelone-admin-script', get_template_directory_uri() . '/js/hotelone-admin-script.js', array( 'jquery' ), '', true );

		wp_localize_script( 'hotelone-admin-script', 'hotelone_ajax_object',
	        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
	    );

	}

	add_action( 'admin_enqueue_scripts', 'hotelone_admin_enqueue_script_function');

endif;

if( !function_exists('hotelone_widgets_register') ):

	function hotelone_widgets_register(){
		
		register_sidebar( array(
			'name'          => esc_html__( 'Primary Sidebar', 'hotelone' ),
			'id'            => 'sidebar-1',
			'description'   => 'This sidebar contents will be show on blog archive pages',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><!-- .widget -->',
			'before_title'  => '<div class="widget_title_area"><h3 class="widget_title">',
			'after_title'   => '</h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Default Page Sidebar', 'hotelone' ),
			'id'            => 'sidebar-page',
			'description'   => 'This sidebar contents will be show on default pages',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><!-- .widget -->',
			'before_title'  => '<div class="widget_title_area"><h3 class="widget_title">',
			'after_title'   => '</h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Top Bar', 'hotelone' ),
			'id'            => 'sidebar-topbar',
			'description'   => 'This sidebar contents will be show on the top bar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><!-- .widget -->',
			'before_title'  => '<div class="widget_title_area"><h3 class="widget_title">',
			'after_title'   => '</h3></div>',
		) );
		
		for ( $i = 1; $i<= 4; $i++ ) {
			register_sidebar( array(
				'name'          => sprintf( __('Footer %s', 'hotelone'), $i ),
				'id'            => 'footer-' . $i,
				'description'   => 'This sidebar contents will be show on footer '.$i.' column area',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div><!-- .widget -->',
				'before_title'  => '<h3 class="widget_title wow animated fadeInUp">',
				'after_title'   => '</h3>',
			) );
		}
		
	}

	add_action( 'widgets_init', 'hotelone_widgets_register' );

endif;

require get_template_directory() . '/inc/default-data.php';
require get_template_directory() . '/inc/classes/class-frontend-css.php';
require get_template_directory() . '/inc/css-output.php';

/**
 * hotelone nav walker
 */
require get_template_directory() . '/inc/hotelone_default_menu_walker.php';
require get_template_directory() . '/inc/hotelone_navwalker.php';

/**
 * hotelone extra
 */
require get_template_directory() . '/inc/extra.php';

/**
 * load template tags file
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * hotelone sanitize
 */
require get_template_directory() . '/inc/sanitize.php';

/**
 * customizer register
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-selective-refresh.php';
require get_template_directory() . '/inc/install/class-install-helper.php';

if( ! file_exists( get_template_directory() . '/pro/hotelone-pro.php' ) ){
	require get_template_directory() . '/inc/frontpage-section-helpers.php';
	require get_template_directory() . '/inc/customizer-typography.php';
}

/* Booking Plugin Compatibility */
if( class_exists('Hotelier') ){

	require get_template_directory() . '/inc/hotelier/functions.php';

}

/* Include Pro Package File */
if( file_exists( get_template_directory() . '/pro/hotelone-pro.php' ) ){

	require get_template_directory() . '/pro/hotelone-pro.php';
	
}