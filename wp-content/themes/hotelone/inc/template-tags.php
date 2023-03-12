<?php

if( !function_exists('hotelone_breadcrumbs') ) {

	function hotelone_breadcrumbs(){

		$disable_pageTitleBar = get_theme_mod('hotelone_page_title_bar_hide',false);
		if( is_page() && $disable_pageTitleBar == true ){
			return;
		}

		if( is_404() && $disable_pageTitleBar == true ){
			return;
		}

		if( is_single() && $disable_pageTitleBar == true ){
			return;
		}

		if( is_archive() && $disable_pageTitleBar == true ){
			return;
		}

		if( is_home() && $disable_pageTitleBar == true ){
			return;
		}

		$titleAlign = get_theme_mod('hotelone_page_cover_align','center');
	?>
	<div id="subheader" class="subheader" style="background-image: url(<?php header_image(); ?>);">
		<div id="subheaderInner" class="subheaderInner">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-<?php echo esc_attr( $titleAlign ); ?>">
						<div class="pageTitleArea wow animated fadeInDown">
							<h1 class="pageTitle">
								<?php 
				                if ( is_day() ) : 
				                        
				                    printf( __( 'Daily Archives: %s', 'hotelone' ), get_the_date() );
				                
				                elseif ( is_month() ) :
				                
				                    printf( __( 'Monthly Archives: %s', 'hotelone' ), (get_the_date( 'F Y' ) ));
				                    
				                elseif ( is_year() ) :
				                
				                    printf( __( 'Yearly Archives: %s', 'hotelone' ), (get_the_date( 'Y' ) ) );
				                    
				                elseif ( is_category() ) :
				                
				                    printf( __( 'Category Archives: %s', 'hotelone' ), (single_cat_title( '', false ) ));

				                elseif ( is_tag() ) :
				                
				                    printf( __( 'Tag Archives: %s', 'hotelone' ), (single_tag_title( '', false ) ));
				                    
				                elseif ( is_404() ) :

				                    printf( __( 'Error 404', 'hotelone' ));
				                    
				                elseif ( is_author() ) :
				                
				                    printf( __( 'Author: %s', 'hotelone' ), (get_the_author( '', false ) ));

				                elseif ( is_archive() ):

				                	if( is_post_type_archive() ){

				                		printf( __( '%s', 'hotelone' ), (post_type_archive_title( '', false ) ));

				                	}else{

				                		printf( __( 'Archives: %s', 'hotelone' ), (post_type_archive_title( '', false ) ));

				                	}

				                else :
				                        the_title();
				                endif;
				                ?>
							</h1>						
						</div>
						<?php 
						if( is_archive() ){
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						}
						?>

						<ul class="breadcrumbs">
			            <?php 

			            $showOnHome = 1;

			            $delimiter  = '';

			            $home       = esc_html__('Home','hotelone');

			            $showCurrent= 1;

			            $before     = '<li class="active">';
			            
			            $after      = '</li>';
			         
			            global $post;
			            $homeLink = home_url();

			            if ( is_home() || is_front_page() ) {
			         
			            if ($showOnHome == 1) echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li>';
			         
			            } else {
			         
			            echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li>';
			         
			            if ( is_category() ) {

			                $thisCat = get_category(get_query_var('cat'), false);
			                if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . ' ');
			                echo $before . esc_html__('Archive by category','hotelone').' "' . esc_html(single_cat_title('', false)) . '"' .$after;
			                
			            } elseif ( is_search() ) {

			                echo $before . esc_html__('Search results for ','hotelone').' "' . esc_html(get_search_query()) . '"' . $after;
			            
			            } elseif ( is_day() ) {

			                echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li> ';
			                echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a></li> ';
			                echo $before . esc_html(get_the_time('d')) . $after;

			            } elseif ( is_month() ) {

			                echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_attr($delimiter);
			                echo $before . esc_html(get_the_time('F')) . $after;

			            } elseif ( is_year() ) {

			                echo $before . esc_html(get_the_time('Y')) . $after;

			            } elseif ( is_single() && !is_attachment() ) {

			                if ( get_post_type() != 'post' ) {

			                    $post_type = get_post_type_object(get_post_type());
			                    $slug = $post_type->rewrite;
			                    echo '<li><a href="' . esc_url(get_post_type_archive_link( get_post_type() )) . '">' . __($post_type->labels->name,'hotelone') . '</a>';
			                    if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . $before . esc_html(get_the_title()) . $after;
			                
			                } else {

			                    $cat = get_the_category(); $cat = $cat[0];
			                    $cats = get_category_parents($cat, TRUE, '' . esc_attr($delimiter) . '');
			                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
			                    echo $before . $cats . $after;
			                    if ($showCurrent == 1) echo $before . esc_html(get_the_title()) . $after;

			                }
			         
			            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

			                if ( class_exists( 'WooCommerce' ) ) {

			                    if ( is_shop() ) {

			                        echo $before . woocommerce_page_title( false ) . $after;

			                    }else{
			                        if(get_post_type() == 'product'){
			                            $terms = get_the_terms(get_the_ID(), 'product_cat', '' , '' );
			                            if($terms) {
			                                echo '<li>';
			                                the_terms( get_the_ID() , 'product_cat' , '' , ' </li><li>' );
			                                echo ' ' . $delimiter . '<i class="fa fa-angle-double-right"></i> ' . '<span class="current">' . get_the_title() . '</span>';
			                            }else{
			                                echo '<span class="current">' . get_the_title() . '</span>';
			                            }
			                        }
			                    }           

			                } else {

			                    $post_type = get_post_type_object(get_post_type());
			                    echo $before . __($post_type->labels->name,'hotelone') . $after;

			                }   

			            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

			                $post_type = get_post_type_object(get_post_type());
			                echo $before . __($post_type->labels->singular_name,'hotelone') . $after;

			            } elseif ( is_attachment() ) {

			                $parent = get_post($post->post_parent);
			                $cat = get_the_category($parent->ID); 
			                if(!empty($cat)){
			                $cat = $cat[0];
			                echo get_category_parents($cat, TRUE, ' ' . esc_attr($delimiter) . '');
			                }
			                echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			                if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_html(get_the_title()) . $after;
			         
			            } elseif ( is_page() && !$post->post_parent ) {

			                if ($showCurrent == 1) echo $before . esc_html(get_the_title()) . $after;

			            } elseif ( is_page() && $post->post_parent ) {

			                $parent_id  = $post->post_parent;
			                $breadcrumbs = array();

			                while ($parent_id) {
			                    $page = get_page($parent_id);
			                    $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>' . '';
			                    $parent_id  = $page->post_parent;
			                }
			                
			                $breadcrumbs = array_reverse($breadcrumbs);

			                for ($i = 0; $i < count($breadcrumbs); $i++) {
			                    echo $breadcrumbs[$i];
			                    if ($i != count($breadcrumbs)-1) echo ' ' . esc_attr($delimiter) . '';
			                }

			                if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_html(get_the_title()) . $after;
			         
			            } elseif ( is_tag() ) {

			                echo $before . esc_html__('Posts tagged ','hotelone').' "' . single_tag_title('', false) . '"' . $after;
			            
			            } elseif ( is_author() ) {

			                global $author;
			                $userdata = get_userdata($author);
			                echo $before . esc_html__('Article posted by ','hotelone').'' . $userdata->display_name . $after;
			            
			            } elseif ( is_404() ) {

			                echo $before . esc_html__('Error 404 ','hotelone'). $after;

			            }
			            
			            if ( get_query_var('paged') ) {

			                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
			                echo ' ( ' . esc_html__('Page','hotelone') . '' . esc_html(get_query_var('paged')). ' )';
			                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
			            
			            }
			         
			            echo '</li>';
			         
			          }
			             ?>
			            </ul>
					</div>
				</div>
			</div><!-- .container -->
		</div>
	</div><!-- .subheader -->
	<?php
	}
}

if ( ! function_exists('hotelone_header' ) ) {
	
	function hotelone_header(){
		
		$header_pos = sanitize_text_field(get_theme_mod('hotelone_header_position', 'top'));
		
		echo '<div class="header">';
		
				do_action('hotelone_header_section_start');
				
					if ($header_pos == 'below_slider' ) {
						do_action('hotelone_header_end');
					}
			
					do_action('hotelone_site_start');
				
					if ($header_pos != 'below_slider' ) {
						do_action('hotelone_header_end');
					}

				do_action('hotelone_header_section_end');
			
		echo '</div><!-- .header -->';
	}
	
}

if ( ! function_exists('hotelone_header_top') ) {
    function hotelone_header_top(){
		hotelone_load_section( 'header_top' );
    }
}
add_action( 'hotelone_header_section_start', 'hotelone_header_top' );

if ( ! function_exists('hotelone_navigation') ) {
    function hotelone_navigation(){
		hotelone_load_section( 'navigation' );
    }
}
add_action( 'hotelone_site_start', 'hotelone_navigation' );

if ( ! function_exists('hotelone_big_section') ) {
    function hotelone_big_section(){

		if( is_front_page() && is_page_template('template-homepage.php') ){

			if( class_exists('Hotelone_Pro') ){
				get_template_part('pro/sections/section','slider');
			}else{
				hotelone_load_section('slider');
			}

		}else if( is_404() ){
			hotelone_breadcrumbs();
		}else{
			hotelone_breadcrumbs();
		}

    }
}
add_action( 'hotelone_header_end', 'hotelone_big_section' );

if ( ! function_exists( 'hotelone_logo' ) ) {
	function hotelone_logo(){
		$class = array();
		$html = '';
		
		if ( function_exists( 'has_custom_logo' ) ) {
			if ( has_custom_logo()) {
				$html .= get_custom_logo();
			}else{
				if ( is_front_page() && !is_home() ) {
					$html .= '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">' . get_bloginfo('name') . '</a></h1>';
				}else{
					$html .= '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">' . get_bloginfo('name') . '</a></h1>';
				}
				
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) {
					$html .= '<p class="site-description">'.$description.'</p>';
				}
			}
		}
		?>
		<div class="navbar-brand <?php echo esc_attr( join( ' ', $class ) ); ?>"><?php echo wp_kses_post($html); ?></div>
		<?php
	}
}

if ( ! function_exists( 'hotelone_load_section' ) ) {
	function hotelone_load_section( $Section_Id ){
		
		do_action('hotelone_before_section_' . $Section_Id);
        do_action('hotelone_before_section_part', $Section_Id);

        get_template_part('sections/section', $Section_Id );

        do_action('hotelone_after_section_part', $Section_Id);
        do_action('hotelone_after_section_' . $Section_Id);
	}
}

if( ! function_exists('hotelone_footer_widget')){
	function hotelone_footer_widget(){
		$column = absint( get_theme_mod( 'footer_column_layout' , 4 ) );
		$max_cols = 12;
        $layouts = 12;
        if ( $column > 1 ){
            $default = "12";
            switch ( $column ) {
                case 4:
                    $default = '3+3+3+3';
                    break;
                case 3:
                    $default = '4+4+4';
                    break;
                case 2:
                    $default = '6+6';
                    break;
            }
            $layouts = sanitize_text_field( get_theme_mod( 'footer_custom_'.$column.'_columns', $default ) );
        }

        $layouts = explode( '+', $layouts );
        foreach ( $layouts as $k => $v ) {
            $v = absint( trim( $v ) );
            $v =  $v >= $max_cols ? $max_cols : $v;
            $layouts[ $k ] = $v;
        }

        $have_widgets = false;

        for ( $count = 0; $count < $column; $count++ ) {
            $id = 'footer-' . ( $count + 1 );
            if ( is_active_sidebar( $id ) ) {
                $have_widgets = true;
            }
        }
		
		if ( $column > 0 && $have_widgets ) {
		?>
		<div class="footer_top">
			<div class="container">
				<div class="row">	
					<?php
					 for ( $count = 0; $count < $column; $count++ ) {
                     $col = isset( $layouts[ $count ] ) ? $layouts[ $count ] : '';
                     $id = 'footer-' . ( $count + 1 );
                     if ( $col ) {
					?>
					<div id="hotelone-footer-<?php echo esc_attr( $count + 1 ) ?>" class="col-lg-<?php echo esc_attr( $col ); ?> col-sm-6">
                        <?php dynamic_sidebar( $id ); ?>
                    </div>
					<?php 
						}
					} 
					?>
				</div><!-- .row -->	
			</div><!-- .container -->
		</div>
		<?php
		}
	}
}
add_action('hotelone_footer_site','hotelone_footer_widget', 10 );

if( ! function_exists('hotelone_footer_copyright')){
	function hotelone_footer_copyright(){
		$html = get_theme_mod( 'footer_copyright_text', wp_kses_post('&copy; 2021, Hotelone WordPress Theme by <a href="'.esc_url('http://britetechs.com').'">Britetechs</a>','hotelone' ));

		$options = array(
			'%current_year%',
			'%copy%'
		);

		$replace = array(
			date('Y'),
			'&copy;'
		);

		$copyright = str_replace( $options, $replace, $html );
		?>
		<div class="footer_bottom copy_right">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-8 col-7 m-auto text-center">						
						<p class="wow animated fadeInUp"><?php echo do_shortcode( $copyright ); ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php		
	}
}
add_action('hotelone_footer_site','hotelone_footer_copyright', 15 );

/**
 * Flush out the transients
 */
function hotelone_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hotelone_categories' );
}
add_action( 'edit_category', 'hotelone_category_transient_flusher' );
add_action( 'save_post',     'hotelone_category_transient_flusher' );

function hotelone_categorized_blog() {
	$category_count = get_transient( 'hotelone_categories' );

	if ( false === $category_count ) {
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );


		$category_count = count( $categories );

		set_transient( 'hotelone_categories', $category_count );
	}

	
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}

if ( ! function_exists( 'hotelone_lite_get_section_services_data' ) ) {
	
	function hotelone_lite_get_section_services_data(){
		$services = get_theme_mod('hotelone_services');
		if (is_string($services)) {
            $services = json_decode($services, true);
        }
		$page_ids = array();
		if (!empty($services) && is_array($services)) {
            foreach ($services as $k => $v) {
                $v['content_page'] = isset($v['content_page']) && $v['content_page'] != null ?absint($v['content_page']):0;
                $page_ids[] = wp_parse_args($v, array(
                    'icon_type' => 'icon',
                    'image' => '',
                    'icon' => 'gg',
                    'enable_link' => 0,
                    'title' => 'Service',
                    'desc' => 'Lorem ipsum dolor sit ame sed do eiusmod tempor incididunt ut labore et dolore',
                    'button_text' => 'Read More',
                    'button_url' => '#',
                    'target' => 0,
                ));
            }
        }
        return $page_ids;
	}
	
}

if ( ! function_exists( 'hotelone_lite_get_section_rooms_data' ) ) {
	
	function hotelone_lite_get_section_rooms_data(){
		$rooms = get_theme_mod('hotelone_room');
		if (is_string($rooms)) {
            $rooms = json_decode($rooms, true);
        }
		$page_ids = array();
		if (!empty($rooms) && is_array($rooms)) {
            foreach ($rooms as $k => $v) {
                $v['content_page'] = isset($v['content_page']) && $v['content_page'] != null ?absint($v['content_page']):0;
                $page_ids[] = wp_parse_args($v, array(
                	'icon_type' => 'icon',
                    'image' => '',
                    'rating' => '5',
                    'person' => 2,
                    'price' => '$100 / Per Night',
                    'enable_link' => 0,
                    'title' => 'Service',
                    'desc' => 'Lorem ipsum dolor sit ame sed do eiusmod tempor incididunt ut labore et dolore',
                    'button_text' => 'Read More',
                    'button_url' => '#',
                    'target' => 0,
                ));
            }
        }
        return $page_ids;
	}
	
}