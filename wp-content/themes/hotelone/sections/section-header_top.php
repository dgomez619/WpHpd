<?php 
$disable_tb       = get_theme_mod( 'disable_header_tb', 0 );

$facebook_icon       = get_theme_mod( 'hide_facebook_icon', 0 );
$facebook_url     = get_theme_mod( 'facebook_url', '#' );

$twitter_icon       = get_theme_mod( 'hide_twitter_icon', 0 );
$twitter_url      = get_theme_mod( 'twitter_url', '#' );

$dribbble_icon       = get_theme_mod( 'hide_dribbble_icon', 0 );
$dribbble_url     = get_theme_mod( 'dribbble_url', '#' );

$linkedin_icon       = get_theme_mod( 'hide_linkedin_icon', 0 );
$linkedin_url     = get_theme_mod( 'linkedin_url', '#' );

$youtube_icon       = get_theme_mod( 'hide_youtube_icon', 0 );
$youtube_url      = get_theme_mod( 'youtube_url', '#' );

$google_plus_icon       = get_theme_mod( 'hide_google_plus_icon', 0 );
$google_plus_url  = get_theme_mod( 'google_plus_url', '#' );

$instagram_icon       = get_theme_mod( 'hide_instagram_icon', 0 );
$instagram_url    = get_theme_mod( 'instagram_url', '#' );

$flickr_icon       = get_theme_mod( 'hide_flickr_icon', 0 );
$flickr_url       = get_theme_mod( 'flickr_url', '#' );

$spotify_icon       = get_theme_mod( 'hide_spotify_icon', 0 );
$spotify_url       = get_theme_mod( 'spotify_url', '#' );

$social_target    = get_theme_mod( 'social_target', 0 );
$phone            = get_theme_mod( 'phone', ' +33 555 66 777' );
$phone_url        = get_theme_mod( 'phone_url', 'tel: +33 555 66 777' );
$email            = get_theme_mod( 'email', 'info@example.com' );
$email_url        = get_theme_mod( 'email_url', 'mailto:info@example.com' );

$houzz_icon       = get_theme_mod( 'hide_houzz_icon', 0 );
$houzz_url       = get_theme_mod( 'houzz_url', '#' );

$header_contained            = get_theme_mod( 'hotelone_header_width', 'contained' );
$header_container = 'container-fluid';
if( $header_contained == 'contained' ){
	$header_container = 'container';
}

$header_pos = sanitize_text_field(get_theme_mod('hotelone_header_position', 'top'));
if ($header_pos == 'below_slider' ) {
	$disable_tb = true;
}
if( !$disable_tb ){
?>
<div class="header-top">
	<div class="<?php echo esc_attr( $header_container ); ?>">

		<?php if ( is_active_sidebar( 'sidebar-topbar' ) ) { ?>
		<div class="row">
			<div class="col">
				<?php dynamic_sidebar( 'sidebar-topbar' ); ?>
			</div>
		</div>
		<?php } ?>

		<div class="row">
			<div class="col-lg-6 col-sm-6 col-12">
				<ul class="header-social">

					<?php if( $facebook_icon == false ){ ?>
					<li class="facebook"><a href="<?php echo esc_url( $facebook_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-facebook"></i></a></li>
					<?php } ?>

					<?php if( $twitter_icon == false ){ ?>
					<li class="twitter"><a href="<?php echo esc_url( $twitter_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-twitter"></i></a></li>
					<?php } ?>

					<?php if( $google_plus_icon == false ){ ?>
					<li class="google-plus"><a href="<?php echo esc_url( $google_plus_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-google-plus"></i></a></li>
					<?php } ?>

					<?php if( $houzz_icon == false ){ ?>
					<li class="houzz"><a href="<?php echo esc_url( $houzz_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-houzz"></i></a></li>
					<?php } ?>

					<?php if( class_exists('Hotelone_Pro') ): ?>

						<?php if( $dribbble_icon == false ){ ?>
						<li class="dribbble"><a href="<?php echo esc_url( $dribbble_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-dribbble"></i></a></li>
						<?php } ?>

						<?php if( $linkedin_icon == false ){ ?>
						<li class="linkedin"><a href="<?php echo esc_url( $linkedin_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-linkedin"></i></a></li>
						<?php } ?>

						<?php if( $youtube_icon == false ){ ?>
						<li class="youtube"><a href="<?php echo esc_url( $youtube_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-youtube"></i></a></li>
						<?php } ?>					

						<?php if( $instagram_icon == false ){ ?>
						<li class="instagram"><a href="<?php echo esc_url( $instagram_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-instagram"></i></a></li>
						<?php } ?>

						<?php if( $flickr_icon == false ){ ?>
						<li class="flickr"><a href="<?php echo esc_url( $flickr_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-flickr"></i></a></li>
						<?php } ?>

						<?php if( $spotify_icon == false ){ ?>
						<li class="spotify"><a href="<?php echo esc_url( $spotify_url ); ?>" <?php if($social_target){ echo 'target="_blank"'; }?>><i class="fa fa-spotify"></i></a></li>
						<?php } ?>

					<?php endif; ?>

				</ul>
			</div>
			<div class="col-lg-6 col-sm-6 col-12">
				<ul class="header-info">
					<?php if( $phone ){ ?>
					<li><a href="<?php echo esc_url( $phone_url ); ?>"><i class="fa fa-phone"></i> <?php echo esc_html( $phone ); ?></a></li>
					<?php } ?>
					<?php if( $email ){ ?>
					<li><a href="<?php echo esc_url( $email_url ); ?>"><i class="fa fa-envelope"></i> <?php echo esc_html( $email ); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div><!-- .container -->
</div><!-- .header-top -->
<?php } ?>