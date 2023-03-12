<?php 
$disable_blog   = get_theme_mod( 'hotelone_news_hide', 0 );
$_blogtitle    = get_theme_mod( 'hotelone_news_title', wp_kses_post('Our Latest <span>News</span>','hotelone') );
$blog_subtitle    = get_theme_mod( 'hotelone_news_subtitle', wp_kses_post('Lorem ipsum dolor sit ame sed do eiusmod tempor incididunt ut labore et dolore','hotelone') );
$number    = absint( get_theme_mod( 'hotelone_news_no', '3' ) );
$column    = absint( get_theme_mod( 'hotelone_news_layout', '4' ) );
$_cat = absint( get_theme_mod( 'hotelone_news_cat' ) );
$_orderby = sanitize_text_field( get_theme_mod('hotelone_news_orderby') );
$_order = sanitize_text_field( get_theme_mod('hotelone_news_order') );
$blogmorelink    = get_theme_mod( 'hotelone_news_more_link', '' );
$blogmoretext    = get_theme_mod( 'hotelone_news_more_text', __('Read More','hotelone') );
$col = '';
if( $column == 12){
	$col = 1;
}else if( $column == 6){
	$col = 2;
}else if( $column == 4){
	$col = 3;
}else{
	$col = 4;
}

if( ! $disable_blog ){
?>
<div id="news" class="news_section section">
	
	<?php do_action('hotelone_section_before_inner', 'blog'); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php if( !empty($_blogtitle) ){ ?>
				<h2 class="section-title wow animated fadeInDown"><?php echo wp_kses_post($_blogtitle); ?></h2>
				<?php } ?>
				<?php if( !empty($blog_subtitle) ){ ?>
				<div class="seprator wow animated slideInLeft"></div>
				<p class="section-desc wow animated fadeInUp"><?php echo wp_kses_post($blog_subtitle); ?></p>
				<?php } ?>
			</div>
		</div>
		
		<div class="row">
		
			<?php
			$args = array(
				'posts_per_page' => $number,
				'suppress_filters' => 0,
			);
			if ( $_cat > 0 ) {
                            $args['category__in'] = array( $_cat );
                        }
						
			if ( $_orderby && $_orderby != 'default' ) {
				$args['orderby'] = $_orderby;
			}

			if ( $_order) {
				$args['order'] = $_order;
			}

			$query = new WP_Query( $args );
			?>
			
			<?php if ( $query->have_posts() ) : ?>
			
			<?php /* Start the Loop */  $i = 1; ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" class="col-md-<?php echo esc_attr( $column ); ?> col-sm-6 wow animated fadeInUp">
				<div class="news">
					
					<?php if( has_post_thumbnail() ): ?>
					<div class="news_thumbnial">
						<?php 
						the_post_thumbnail();
						?>
						<div class="news_overlay">
							<div class="news_overlay_inner">
								<a class="news_overlay_icon" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
							</div>
						</div>
					</div>
					<?php endif; ?>
					
					<div class="news_body">
						<div class="news_date">
							<i class="fa fa-clock-o"></i><?php the_time('M j, Y'); ?>
						</div>
						<?php 
						the_title('<a class="news_title" href="'.esc_url( get_the_permalink() ).'"><h3>','</h3></a>');
						?>
						<div class="post-content">
							<?php
								the_excerpt();
							?>
						</div>
						
					</div>
				</div><!-- .news -->
			</div>
			<?php
			if($i==$col) { echo '<div class="clearfix"></div>'; $i=0; }
			$i++; endwhile; wp_reset_postdata(); ?>
			
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
			
		</div><!-- .row -->	
		
		<?php if( $blogmorelink ){ ?>
		<div class="row">
			<div class="col-md-12 text-center" style="margin-bottom: 30px;">
				<a class="more-link mt-3" href="<?php echo esc_url( $blogmorelink); ?>"><?php printf( sprintf( wp_kses_post( $blogmoretext ) ) ); ?></a>
			</div>
		</div><!-- .row -->
		<?php } ?>
		
	</div><!-- .container -->
	
	<?php do_action('hotelone_section_after_inner', 'blog'); ?>
	
</div><!-- .news_section -->
<div class="clearfix"></div>
<?php } ?>