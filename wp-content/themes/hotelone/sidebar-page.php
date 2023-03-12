<?php 
/**
 * The sidebar containing the default page widget area
 *
 */
 
if ( ! is_active_sidebar( 'sidebar-page' ) ) {
	return;
}
?>
<div class="col-md-4 secondary">
	<div class="">
		<?php dynamic_sidebar( 'sidebar-page' ); ?>
	</div>
</div><!-- .secondary -->