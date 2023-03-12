<?php 
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$hide_page_title   = get_theme_mod( 'hide_page_title', 0 );
$meta = get_post_meta( get_the_ID(),'event_meta', true );
					$meta = wp_parse_args($meta, array(
									'start_date' => '',
									'end_date' => '',
								));
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post'); ?>>
	
	<?php if ( '' !== get_the_post_thumbnail() ) : ?>
	<div class="blog-mask">
		<div class="blog-image">
			<div class="blog-large-image">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		</div>
	</div><!-- .blog-mask -->
	<?php endif; ?>
	
	<div class="blog-list-desc clearfix">
		<?php if($hide_page_title==0){ ?>
		<div class="blog-text">			
			<?php			
			if ( is_sticky() && is_home() ) :
				
			endif;
			
			the_title( '<h4>', '</h4>' );
			?>	

			<div class="event_date">
				<i class="fa fa-clock-o"></i> <?php echo $meta['start_date'] .' - '. $meta['end_date']; ?>
			</div>			
		</div>
		<?php } ?>

		<div class="post-content">
			<?php
				the_content();

					wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'hotelone' ),
					'after'  => '</div>',
				) );
				?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->