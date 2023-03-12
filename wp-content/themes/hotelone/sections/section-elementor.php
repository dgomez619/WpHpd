<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post(); ?>
		<div id="site-content" class="site-content" style="background-color:#fff;margin:0; padding:0;">
			<div class="container">
				<div class="row">
					<?php get_template_part( 'template-parts/page/content', 'elementor' ); ?>
				</div>	
			</div>
		</div><!-- .site-content -->
      <?php endwhile;
endif; ?>