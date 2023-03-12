<?php 

/* Hotely Theme Setup */
function hotely_theme_setup(){

    load_child_theme_textdomain( 'hotely', get_stylesheet_directory() . '/languages' );

}

add_action( 'after_setup_theme', 'hotely_theme_setup' );

/* Enqueue style file. */
add_action( 'wp_enqueue_scripts' , 'hotely_script', 99);
function hotely_script() {
  $parent_style = 'parent-style';
  wp_enqueue_style( 'hotely-style', get_stylesheet_directory_uri(). '/style.css', $parent_style  );
}

/* Overriding custom theme color scheme of parent theme. */
add_filter('hotelone_reset_data','hotely_default_data', 999 );
function hotely_default_data( $themedata ){
	$themedata['theme_color'] = '#1ab4d2';
	$themedata['hotelone_gallery_disable'] = false;
	$themedata['hotelone_gallerytitle'] = sprintf(__('Gallery','hotely'));
	$themedata['hotelone_gallerysubtitle'] = '';
	$themedata['hotelone_gallery_pageid'] = '';
	$themedata['hotelone_gallery_column'] = 4;
	$themedata['hotelone_gallery_bgcolor'] = '#ffffff';
	$themedata['hotelone_gallery_bgimage'] = '';
	return $themedata;
}


/* Overriding custom header function of parent theme function. This kind we are use use "hotelone" prefix for this function in below. */
if( !function_exists('hotely_setup') ){
	function hotely_setup(){
		
		$args = array(
			'width'        => 1600,
			'flex-width'   => true,
			'default-image' => get_stylesheet_directory_uri() . '/images/sub-header.jpg',
			// Header text
			'header-text'   => false,
		);
		add_theme_support( 'custom-header', $args );
		
		add_theme_support( 'recommend-plugins', array(
			'britetechs-companion' => array(
                'name' => esc_html__( 'Britetechs Companion', 'hotely' ),
                'desc' => esc_html__( 'We highly recommend that you install the brietechs companion plugin to gain access to the team and testimonial sections.', 'hotely' ),
                'active_filename' => 'brietechs-companion/brietechs-companion.php',
            ),
            'contact-form-7' => array(
                'name' => esc_html__( 'Contact Form 7', 'hotely' ),
				'desc' => esc_html__( 'This is also recommended that you install the contact form plugin to show contact form on Front Page contact section and Contact custom page template.', 'hotely' ),
                'active_filename' => 'contact-form-7/wp-contact-form-7.php',
            ),
        ) );
	}
}
add_action( 'after_setup_theme', 'hotely_setup' );


/*
 * Sidebar for contact page
 * 
 * Contact page sidebar register
 * 
 * @Since 1.4
 */
add_action('widgets_init','hotely_sidebars',10);
 function hotely_sidebars(){    
    register_sidebar( array(
    'name' => __( 'Contact Page Template Sidebar', 'hotely' ),
    'id' => 'sidebar-contact',
    'description' => __( 'Contact Page Template widget area', 'hotely' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div><!-- .widget -->',
    'before_title'  => '<div class="widget_title_area"><h3 class="widget_title">',
    'after_title'   => '</h3></div>',
    ) );
 }

/*
 * Generate New Gallery
 * 
 * Creating home page gallery
 * 
 * @Since 1.3
 */
function hotely_gallery_generate( $echo = true ){
	
	$option = wp_parse_args(  get_option( 'hotelone_option', array() ), hotelone_reset_data() );
	
    $div = '';

    $data = hotely_get_section_gallery_data();
    $display_type = get_theme_mod( 'hotely_gallery_display', 'grid' );
    $lightbox = get_theme_mod( 'hotely_g_lightbox', 1 );
    $class = '';
    if ( $lightbox ) {
        $class = ' enable-lightbox ';
    }
    $col = absint( $option['hotelone_gallery_column'] );
    if ( $col <= 0 ) {
        $col = 4;
    }
    switch( $display_type ) {
        case 'masonry':
            $html = hotely_gallery_html( $data );
            if ( $html ) {
                $div .= '<div data-col="'.$col.'" class="g-zoom-in gallery-masonry '.$class.' gallery-grid g-col-'.$col.'">';
                $div .= $html;
                $div .= '</div>';
            }
            break;
        case 'carousel':
            $html = hotely_gallery_html( $data );
            if ( $html ) {
                $div .= '<div data-col="'.$col.'" class="g-zoom-in gallery-carousel owl-theme owl-carousel owl-carousel'.$class.'">';
                $div .= $html;
                $div .= '</div>';
            }
            break;
        case 'slider':
            $html = hotely_gallery_html( $data , true , 'full' );
            if ( $html ) {
                $div .= '<div class="gallery-slider owl-theme owl-carousel owl-carousel'.$class.'">';
                $div .= $html;
                $div .= '</div>';
            }
            break;
        case 'justified':
            $html = hotely_gallery_html( $data, false );
            if ( $html ) {
                $gallery_spacing = absint( get_theme_mod( 'hotely_g_spacing', 20 ) );
                $row_height = absint( get_theme_mod( 'hotely_g_row_height', 120 ) );
                $div .= '<div data-row-height="'.$row_height.'" data-spacing="'.$gallery_spacing.'" class="g-zoom-in gallery-justified'.$class.'">';
                $div .= $html;
                $div .= '</div>';
            }
            break;
        default: // grid
            $html = hotely_gallery_html( $data );
            if ( $html ) {
                $div .= '<div class="gallery-grid g-zoom-in '.$class.' g-col-'.$col .'">';
                $div .= $html;
                $div .= '</div>';
            }
            break;
    }

    if ( $echo ) {
       echo wp_kses_post( $div );
    } else {
        return wp_kses_post( $div );
    }

}

function hotely_gallery_html( $data, $inner = true, $size = 'thumbnail' ) {
    $max_item = get_theme_mod( 'hotely_g_number', 10 );
    $html = '';
    if ( ! is_array( $data ) ) {
        return $html;
    }
    $n = count( $data );
    if ( $max_item > $n ) {
        $max_item =  $n;
    }
    $i = 0;
    while( $i < $max_item ){
        $photo = current( $data );
        $i ++ ;
        if ( $size == 'full' ) {
            $thumb = $photo['full'];
        } else {
            $thumb = $photo['thumbnail'];
        }

        $html .= '<a href="'.esc_attr( $photo['full'] ).'" class="g-item" title="'.esc_attr( wp_strip_all_tags( $photo['title'] ) ).'">';
        if ( $inner ) {
            $html .= '<span class="inner">';
                $html .= '<span class="inner-content">';
                $html .= '<img src="'.esc_url( $thumb ).'" alt="">';
                $html .= '</span>';
            $html .= '</span>';
        } else {
            $html .= '<img src="'.esc_url( $thumb ).'" alt="">';
        }

        $html .= '</a>';

        next( $data );
    }
    reset( $data );

    return wp_kses_post( $html );
}


if ( ! function_exists( 'hotely_get_section_gallery_data' ) ) {
    
    function hotely_get_section_gallery_data(){
		
		$option = wp_parse_args(  get_option( 'hotelone_option', array() ), hotelone_reset_data() );

        $source = 'page';
        if( has_filter( 'hotely_get_section_gallery_data' ) ) {
            $data =  apply_filters( 'hotely_get_section_gallery_data', false );
            return $data;
        }

        $data = array();

        switch ( $source ) {
            default:
                $page_id = intval( $option['hotelone_gallery_pageid'] );

                $images = '';
                if ( $page_id ) {
                    $gallery = get_post_gallery( $page_id , false );
                    if ( $gallery ) {
                        $images = $gallery['ids'];
                    }else{
                        $post = get_post($page_id);
                        setup_postdata( $post );
                        $pattern = '
                            /
                            \{              # { character
                                (?:         # non-capturing group
                                    [^{}]   # anything that is not a { or }
                                    |       # OR
                                    (?R)    # recurses the entire pattern
                                )*          # previous group zero or more times
                            \}              # } character
                            /x
                            ';

                            preg_match_all($pattern, get_the_content(), $matches);
                            $images_arr = json_decode($matches[0][0], true);
                            $images = implode(',', $images_arr['ids']);
                    }
                }

                $display_type = get_theme_mod( 'hotely_gallery_display', 'grid' );
                if ( $display_type == 'masonry' || $display_type == ' justified' ) {
                    $size = 'large';
                } else {
                    $size = 'hotely-small';
                }

                $image_thumb_size = apply_filters( 'hotely_gallery_page_img_size', $size );

                if ( ! empty( $images ) ) {
                    $images = explode( ',', $images );
                    foreach ( $images as $post_id ) {
                        $post = get_post( $post_id );
                        if ( $post ) {
                            $img_thumb = wp_get_attachment_image_src($post_id, $image_thumb_size );
                            if ($img_thumb) {
                                $img_thumb = $img_thumb[0];
                            }

                            $img_full = wp_get_attachment_image_src( $post_id, 'full' );
                            if ($img_full) {
                                $img_full = $img_full[0];
                            }

                            if ( $img_thumb && $img_full ) {
                                $data[ $post_id ] = array(
                                    'id'        => $post_id,
                                    'thumbnail' => $img_thumb,
                                    'full'      => $img_full,
                                    'title'     => $post->post_title,
                                    'content'   => $post->post_content,
                                );
                            }
                        }
                    }
                }
            break;
        }

        return $data;

    }
}

include_once( get_stylesheet_directory() . '/inc/customizer/customizer.php' );


// Gallery section
if( !function_exists('hotelone_gallery_section') ){

    function hotelone_gallery_section(){

        $option = wp_parse_args(  get_option( 'hotelone_option', array() ), hotelone_reset_data() );
        $class = '';
        if(empty($option['hotelone_gallery_bgimage'])){
            $class = 'noneimage-padding';
        }else{
            $class = 'has_section_image';
        }
                        
        if( !$option['hotelone_gallery_disable'] ): ?>
        <div id="gallery" class="gallery_section section <?php echo esc_attr( $class ); ?>" style="background-color:<?php echo esc_attr($option['hotelone_gallery_bgcolor']); ?>;background-image:url(<?php echo esc_url($option['hotelone_gallery_bgimage']); ?>);">
            
            <?php if(!empty($option['hotelone_gallery_bgimage'])){ ?>
            <div class="sectionOverlay">
            <?php } ?>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php if( !empty( $option['hotelone_gallerytitle'] ) ){ ?>
                        <h2 class="section-title wow animated fadeInDown"><?php echo wp_kses_post( $option['hotelone_gallerytitle'] ); ?></h2>
                        <?php } ?>
                        <?php if( !empty( $option['hotelone_gallerysubtitle'] ) ){ ?>
                        <div class="seprator wow animated slideInLeft"></div>
                        <p class="section-desc wow animated fadeInUp"><?php echo wp_kses_post( $option['hotelone_gallerysubtitle'] ); ?></p>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="row">
                    <?php hotely_gallery_generate(); ?>
                </div>

            </div><!-- /.container -->
            
            <?php if(!empty($option['hotelone_gallery_bgimage'])){ ?>
            </div>
            <?php } ?>
            
        </div><!-- /.gallery_section -->
        <?php endif;

    }

}

if( function_exists('hotelone_gallery_section') ){

    $section_priority = apply_filters( 'hotelone_section_priority', 29, 'hotelone_gallery_section' );

    add_action('hotelone_sections','hotelone_gallery_section', absint($section_priority));

}