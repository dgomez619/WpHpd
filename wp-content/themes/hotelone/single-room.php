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
				$tax = 'room_categories';

				if( class_exists('Hotelier') ){
					$tax = 'room_cat';
				}

				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) : the_post();

					$related_room_categories = array();
					$categories = get_the_terms($post->ID, $tax);
					if(!empty($categories)){
						foreach ($categories as $cat_key => $catgory) {
							if($catgory->term_id == 2 && $catgory->slug == 'all-room' ){
								continue;
							}
							$related_room_categories[] = $catgory->term_id;
						}
					}
					
					
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/post/content', 'room' );
						
					endwhile;
					
					// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						
						the_posts_pagination( array(
							'prev_text' => '<i class="fa fa-angle-double-left"></i>',
							'next_text' => '<i class="fa fa-angle-double-right"></i>',
						) );


						$args = array(
							'post_type' => 'room',
							'posts_per_page' => -1,
							'post__not_in' => array(get_the_ID()),
							'tax_query' => array(
							    array(
							    'taxonomy' => 'room_categories',
							    'field' => 'term_id',
							    'terms' => $related_room_categories
							     )
							  ),
						);
						$query = new WP_Query( $args );


						$related_room_title    = get_theme_mod( 'single_room_related_title', wp_kses_post('Related Rooms:','hotelone') );

						if($related_room_title && $query->have_posts() ){
						?>
						
						<div class="row" style="margin-top: 50px;">
							<div class="col-md-12">
								<h3><?php echo wp_kses_post($related_room_title); ?></h3>
							</div>
						</div>
						<?php } ?>
						
						<div class="row">
						<?php if ( $query->have_posts() ) : ?>
						
						<?php /* Start the Loop */ ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						
						<?php 
						$meta = get_post_meta( get_the_ID(),'room_meta', true );
						$meta = wp_parse_args($meta, array(
										'persons' => '3',
										'rent' => '$59 / Per Night',
										'rating' => '5',
										'btntext' =>__('Book Now','hotelone'),
										'btnurl' =>'',
										'btntarget' => true,
									));
									
						if($meta['btnurl']!=''){
							$link = $meta['btnurl'];
						}else{
							$link = get_post_permalink();
						}
						?>
						<div class="col-md-4 col-sm-6 wow animated rollIn">
							<div class="card-room">
								
								<?php 
								$room_overlay_hide = get_theme_mod( 'room_overlay_hide', 0 );
								if( has_post_thumbnail() ) { ?>
								<div class="room_thumbnial">
									<?php the_post_thumbnail('full'); 
									if( has_post_thumbnail() ) {
									?>
									<div class="room_overlay">
										<div class="room_overlay_inner">
											<a class="overlay-btn" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
										</div>
									</div>
									<?php } ?>
								</div>
								<?php } ?>
								
								<div class="room-content text-center">
									<div class="room_rate">
										<?php for($r=1; $r<=5; $r++){ ?>
											<?php if($r<=$meta['rating']){ ?>
											<i class="fa fa-star star_yellow"></i>
											<?php }else{ ?>
											<i class="fa fa-star"></i>
											<?php } ?>
										<?php } ?>
									</div>
									
									<a href="<?php the_permalink(); ?>">
										<?php the_title('<h4 class="room_title">','</h4>'); ?>
									</a>

									<?php 
									the_excerpt();
									?>
									
								</div>
								<div class="text-center">
									<a class="theme-btn mb-4" href="<?php echo esc_url( $link ); ?>"><?php echo $meta['btntext']; ?></a>
								</div>						
							</div>
						</div>
						<?php endwhile; ?>
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