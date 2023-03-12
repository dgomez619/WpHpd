<?php
if ( ! function_exists( 'hotelone_get_layout' ) ) {

    function hotelone_get_layout( $default = 'right' ) {

        $layout = get_theme_mod( 'hotelone_layout', 'right' );
        return apply_filters( 'hotelone_get_layout', $layout, $default );

    }
    
}

if ( ! function_exists( 'hotelone_get_media_url' ) ) {

    function hotelone_get_media_url($media = array(), $size = 'full' ) {

        $media = wp_parse_args( $media, array('url' => '', 'id' => ''));
        $url = '';
        if ($media['id'] != '') {
            if ( strpos( get_post_mime_type( $media['id'] ), 'image' ) !== false ) {
                $image = wp_get_attachment_image_src( $media['id'],  $size );
                if ( $image ){
                    $url = $image[0];
                }
            } else {
                $url = wp_get_attachment_url( $media['id'] );
            }
        }

        if ($url == '' && $media['url'] != '') {
            $id = attachment_url_to_postid( $media['url'] );
            if ( $id ) {
                if ( strpos( get_post_mime_type( $id ), 'image' ) !== false ) {
                    $image = wp_get_attachment_image_src( $id,  $size );
                    if ( $image ){
                        $url = $image[0];
                    }
                } else {
                    $url = wp_get_attachment_url( $id );
                }
            } else {
                $url = $media['url'];
            }
        }
        return $url;
    }
}

/**
 * Custom excerpt length
 */
if ( ! function_exists( 'hotelone_custom_excerpt_length' ) ) :

    add_filter( 'excerpt_length', 'hotelone_custom_excerpt_length', 100 );

    function hotelone_custom_excerpt_length( $length ) {
    	
    	global $post;

    	if( 
            $post->post_type == 'room' || 
            $post->post_type == 'event' ||
            $post->post_type == 'recipe'
        ){

    		return 10;

    	}

        $excerpt_length = get_theme_mod('archive_excerpt_length', 15 );

    	return absint( apply_filters( 'hotelone_excerpt_length', $excerpt_length ) );
    }

endif;

/**
 * Remove […]
 */
if ( ! function_exists( 'hotelone_new_excerpt_more' ) ) :

    add_filter('excerpt_more', 'hotelone_new_excerpt_more', 15 );

    function hotelone_new_excerpt_more( $more ) {
    	
        $service_more_text = get_theme_mod( 'hotelone_service_more_text', __('Read More','hotelone') );

        $read_more_text = get_theme_mod( 'read_more_button_text', __('Read More','hotelone') );

    	global $post;
    	
    	if( 
            is_front_page() && 
            is_home() || 
            is_page_template('template-service.php'
        ) ){
    		$textagign = 'center';
    	}else{
    		$textagign = 'center';
    	}
 
        if( $post->post_type == 'recipe' ){
            $textagign = 'left';
        }
    	
    	if( $post->post_type == 'room' ){
    		return '...';
    	}

        if( $post->post_type == 'event' ){
            $textagign = 'center';
            return apply_filters( 'hotelone_excerpt_more_output', sprintf(
            ' ... <div class="text-'.esc_attr( $textagign ).'"><a class="theme-btn" href="%s">%1s</a></div>',
            esc_url( get_the_permalink() ),
            __('View Details','hotelone')
            ) );
        }

        if( $post->post_type == 'page' ){
            $textagign = 'center';
            return apply_filters( 'hotelone_excerpt_more_output', sprintf(
            ' ... <div class="text-'.esc_attr( $textagign ).'"><a class="theme-btn" href="%s">%1s</a></div>',
            esc_url( get_the_permalink() ),
            $service_more_text
            ) );
        }
    	
    	return apply_filters( 'hotelone_excerpt_more_output', sprintf(
    		' ... <div class="text-'.esc_attr( $textagign ).'"><a class="more-link" href="%s">%1s</a></div>',
    		esc_url( get_the_permalink() ),
    		$read_more_text
    		) );
    }

endif;

/* Content Read More */

if ( ! function_exists( 'hotelone_blog_content_more' ) ) :

    add_filter( 'the_content_more_link', 'hotelone_blog_content_more', 15 );

    function hotelone_blog_content_more( $more ) {

        $excerpt_readmore = get_theme_mod('archive_readmore_label');

        // If empty, return

        if ( '' == $excerpt_readmore ) {

            return '';

        }

        return apply_filters( 'hotelone_content_more_link_output', sprintf( '<p class="more-link-container"><a title="%1$s" class="more-link content-more-link" href="%2$s">%3$s%4$s <i class="fa fa-long-arrow-right"></i></a></p>',
            the_title_attribute( 'echo=0' ),
            esc_url( get_permalink( get_the_ID() ) . apply_filters( 'hotelone_more_jump','#more-' . get_the_ID() ) ),
            wp_kses_post( $excerpt_readmore ),
            '<span class="screen-reader-text">' . get_the_title() . '</span>'
        ) );

    }

endif;

add_filter( 'hotelone_excerpt_more_output', 'hotelone_blog_read_more_button' );
add_filter( 'hotelone_content_more_link_output', 'hotelone_blog_read_more_button' );

function hotelone_blog_read_more_button( $output ) {

    $archive_readmore_button = get_theme_mod('archive_readmore_label');

    $excerpt_readmore = get_theme_mod('archive_readmore_label');

    $archive_readmore_button = get_theme_mod('archive_readmore_button');

    $class='';

    if($archive_readmore_button){

        $class = 'button';

    }

    if ( !$archive_readmore_button ) {

        return $output;

    }

    return sprintf( '%5$s<p class="more-link-container"><a title="%1$s" class="more-link %6$s" href="%2$s">%3$s%4$s <i class="fa fa-long-arrow-right"></i></a></p>',
        the_title_attribute( 'echo=0' ),
        esc_url( get_permalink( get_the_ID() ) . apply_filters( 'hotelone_more_jump','#more-' . get_the_ID() ) ),
        wp_kses_post( $excerpt_readmore ),
        '<span class="screen-reader-text">' . get_the_title() . '</span>',
        'hotelone_excerpt_more_output' == current_filter() ? ' ... ' : '',
        esc_attr($class)
    );

}

// Get Started Notice

add_action( 'wp_ajax_hotelone_dismissed_notice_handler', 'hotelone_ajax_notice_handler' );
function hotelone_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function hotelone_deprecated_hook_admin_notice() {
        if ( ! get_option('dismissed-get_started', FALSE ) ) {
            ?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="hotelone-getting-started-notice clearfix">
                    <div class="hotelone-theme-screenshot">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png" class="screenshot" alt="<?php esc_attr_e( 'Theme Screenshot', 'hotelone' ); ?>" />
                    </div>
                    <div class="hotelone-theme-notice-content">
                        <h2 class="hotelone-notice-h2">
                            <?php
                        printf(
                            /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__( 'Welcome! Thank you for choosing %1$s!', 'hotelone' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                        ?>
                        </h2>

                        <p class="plugin-install-notice"><?php echo sprintf(__('Install and activate <strong>Britetechs Companion</strong> plugin for taking full advantage of all the features this theme has to offer.', 'hotelone')) ?></p>

                        <a class="hotelone-btn-get-started button button-primary button-hero hotelone-button-padding" href="#" data-name="" data-slug=""><?php esc_html_e( 'Get started with hotelone', 'hotelone' ) ?></a><span class="hotelone-push-down">
                        <?php
                            /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                            printf(
                                'or %1$sCustomize theme%2$s</a></span>',
                                '<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
                                '</a>'
                            );
                        ?>
                    </div>
                </div>
            </div>
        <?php }
}
add_action( 'admin_notices', 'hotelone_deprecated_hook_admin_notice' );

// Plugin Installer

function hotelone_admin_install_plugin() {

    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if ( ! file_exists( WP_PLUGIN_DIR . '/britetechs-companion' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'britetechs-companion' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }

    // Activate plugin.
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'britetechs-companion/britetechs-companion.php' );
    }
}
add_action( 'wp_ajax_install_act_plugin', 'hotelone_admin_install_plugin' );