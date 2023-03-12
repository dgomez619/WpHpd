<?php
/**
 * This template for displaying custom archive texonomy page
 *
 */
 
get_header();
?>
<div class="galleryPage">
	<div class="container">
		
		<div class="row">
						
			<?php 
			if ( have_posts() ) :
			
			/* Start the Loop */
			$i = 1;
			
			while( have_posts() ): the_post(); ?>
			<div class="col-md-4 col-sm-4">
				<div class="gallery-area">
					
					<?php if( has_post_thumbnail() ): ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
					<?php endif; ?>
					
					<div class="gallery-overlay">
						<div class="gallery-overlay-inner">
							<?php 
							  $thumbId = get_post_thumbnail_id();
							  $thumbnailUrl = wp_get_attachment_url( $thumbId );
							  ?>
							<a class="gallery-icon gallerythumb" href="<?php echo esc_url( $thumbnailUrl ); ?>"><i class="fa fa-eye"></i></a>
							<a class="gallery-icon" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
						</div>
					</div>
				</div><!-- .gallery-area -->
			</div>
			<?php 
			if($i%3==0){ echo '<div class="clearfix"></div>'; } $i++;
			endwhile; 
			
			the_posts_pagination( array(
						'prev_text' => '<i class="fa fa-angle-double-left"></i>',
						'next_text' => '<i class="fa fa-angle-double-right"></i>',
					) );
			
			else :
				
				get_template_part( 'template-parts/post/content', 'none' );
				
			endif;
			?>
			
		</div>
		
		
	</div>
</div><!-- .galleryPage -->
	
<?php get_footer(); ?>