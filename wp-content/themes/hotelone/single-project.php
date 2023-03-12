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

$layout = $layout = hotelone_get_layout();
$col = '8';
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

			<div class="col-md-<?php echo esc_attr( $col ); ?> col-sm-<?php echo esc_attr( $col ); ?> primary">
				
				<?php
				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) : the_post();
					
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/post/content', 'project' );
						
					endwhile;
					
					// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						
					the_post_navigation( array(
							'prev_text' => '<span class="nav-subtitle"><i class="fa fa-angle-double-left"></i> ' . __( 'Previous', 'hotelone' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-title">%title</span> <span class="nav-subtitle">' . __( 'Next', 'hotelone' ) . ' <i class="fa fa-angle-double-right"></i></span>',
						) );
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