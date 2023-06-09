<?php
/*
 *  Template Name: Contact Us
 */
 
 get_header(); ?>

<div id="site-content" class="site-content">
	<div class="container">
		<div class="row">		
			<div class="col-md-8 col-sm-8 primary">
				
				<?php
				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) : the_post();
					
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/page/content', 'page' );
						
					endwhile;
					
					// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						
					the_posts_pagination( array(
							'prev_text' => '<i class="fa fa-angle-double-left"></i>',
							'next_text' => '<i class="fa fa-angle-double-right"></i>',
						) );
				
				else :
					
					get_template_part( 'template-parts/post/content', 'none' );
					
				endif;
				?>			
				
			</div>
			
			<?php get_sidebar('contact'); ?>
		</div>
	</div>
</div><!-- .site-content -->

<?php get_footer(); ?>