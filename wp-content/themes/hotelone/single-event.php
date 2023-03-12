<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
 
get_header(); 
$layout = hotelone_get_layout();
$col = (is_active_sidebar( 'sidebar-1' )?'8':'12');
if($layout=='none'){
	$col = '12';
}
?>

<div id="site-content" class="site-content">
	<div class="container">
		<div class="row">
			<?php 
			if ( $layout != 'none' && $layout=='left' ) {
				get_sidebar();
			}
			?>

			<div class="col-md-<?php echo esc_attr( $col ); ?> primary">
				
				<?php
				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) : the_post();
					
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/page/content', 'event' );
						
					endwhile; wp_reset_postdata();
					
					// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						
					the_posts_pagination( array(
							'prev_text' => '<i class="fa fa-angle-double-left"></i>',
							'next_text' => '<i class="fa fa-angle-double-right"></i>',
						) );
						
						$related_events_title    = get_theme_mod( 'single_event_related_title', wp_kses_post('Related Events:','hotelone') );

						if($related_events_title){
						?>
						
						<div class="row mb-3" style="margin-top: 50px;">
							<div class="col-md-12">
								<h3><?php echo wp_kses_post($related_events_title); ?></h3>
							</div>
						</div>
						<?php } ?>

						<div class="row">	
						<?php
						$args = array(
							'post_type' => 'event',
							'posts_per_page' => -1,
							'post__not_in' => array(get_the_ID()),
						);
						$query = new WP_Query( $args );
						?>
						
						<?php if ( $query->have_posts() ) : ?>
						
						<?php /* Start the Loop */ ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						
						<?php 
						$meta = get_post_meta( get_the_ID(),'event_meta', true );
						$meta = wp_parse_args($meta, array(
										'start_date' => '',
										'end_date' => '',
										'btntext' => 'View Details',
									));
									
						$link = get_post_permalink();
						?>
						<div class="col-md-6 col-sm-6 wow animated fadeInUp">
							<div class="card-event">
									<?php 
									if( has_post_thumbnail() ) { ?>
									<div class="event_thumbnial">
										<?php the_post_thumbnail('full'); ?>
										<div class="event-overlay text-center">
											<div class="row event-data">
												<div class="col-lg-9 col-md-9 col-9">
													<?php the_title('<h4 class="event-title"><a href="'.esc_url( $link ).'">','</a></h4>'); ?>
												</div>
												<div class="col-lg-3 col-md-3 col-3">
													<span class="event-icon"><i class="fa fa-chevron-right"></i></span>
			                               		</div>
											</div>									
										</div>
									</div>
									<?php } ?>													
								</div>
						</div>
						<?php endwhile; wp_reset_postdata(); ?>
						<?php endif; ?>
						
						</div><!-- .row -->	
						<?php
						
				endif;
				?>			
				
			</div>
			
			<?php 
			if ( $layout != 'none' && $layout=='right' ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div><!-- .site-content -->
	
<?php get_footer(); ?>