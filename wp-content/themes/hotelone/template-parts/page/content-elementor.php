<?php 
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$hide_page_title   = get_theme_mod( 'hide_page_title', 0 );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post w-100 p-0'); ?>>
	<div class="blog-list-desc clearfix">
		<div class="post-content" style="padding:0;">
			<?php
			the_content();
			?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->