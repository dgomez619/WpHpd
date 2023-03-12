<?php 
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$meta = get_post_meta( get_the_ID(),'room_meta', true );
$meta = wp_parse_args($meta, array(
                'persons' => '3',
                'rent' => '$59 / Per Night',
                'rating' => '5',
                'btntext' =>__('Book Now','hotelone'),
                'btnurl' =>'',
                'btntarget' => true,
            ));

$featured_room = get_post_meta( get_the_ID(),'featured_room', true );

$rent = $meta['rent'];
$persons = $meta['persons']?$meta['persons']:2;
$link = $meta['btnurl']?$meta['btnurl']:get_post_permalink();
$button_text = $meta['btntext']?$meta['btntext']:__('Book Now','hotelone');

// Change the link for detail page
if( class_exists('Hotelier') ){
	global $room;
	$_max_guests = get_post_meta( get_the_ID(),'_max_guests', true );
	$persons = $_max_guests ? $_max_guests : 2;
	$rent = strip_tags($room->get_min_price_html());
	$rent = str_replace('Rates from ', '', $rent);
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog_post card-room p-0'); ?>>
	
	<?php 
	$meta = get_post_meta( get_the_ID(),'room_meta', true );
	$images = array();
	
	$thumbId = get_post_thumbnail_id();
    $thumbnailUrl = wp_get_attachment_url( $thumbId );
	
	if(!empty($thumbnailUrl)){
			$images[] = $thumbnailUrl;
		}
	
	for($i=1; $i<=6; $i++){
		if( isset($meta["room_image_$i"]) && $meta["room_image_$i"] != null ){
			$images[] = $meta["room_image_$i"];
		}
	}
	?>
	<div id="roomsingle_carousel_<?php the_ID(); ?>" class="carousel slide " data-ride="carousel" data-interval="6000">
		<div class="carousel-inner" role="listbox">
			<?php $i=1; foreach( $images as $image ){ ?>
			<div class="carousel-item <?php if($i==1){ echo 'active';} $i++; ?>">
				<img src="<?php echo esc_url( $image ); ?>" alt="post slides">
			</div>
			<?php } ?>
		</div>
		
		<?php if( count( $images ) > 1 ){ ?>
		<a class="carousel-control-prev" href="#roomsingle_carousel_<?php the_ID(); ?>" role="button" data-slide="prev">
			<span class="fa fa-angle-left" aria-hidden="true"></span>
			<span class="sr-only"><?php _e('Previous','hotelone'); ?></span>
		</a>
		<a class="carousel-control-next" href="#roomsingle_carousel_<?php the_ID(); ?>" role="button" data-slide="next">
			<span class="fa fa-angle-right" aria-hidden="true"></span>
			<span class="sr-only"><?php _e('Next','hotelone'); ?></span>
		</a>
		<?php } ?>
	</div>
	
	<div class="blog-list-desc clearfix">
		<div class="room_detail_info text-left">
			<span><?php echo $rent; ?></span>
			<span>
				<?php for($i=1; $i<=$persons; $i++){ ?>
				<i class="fa fa-male"></i>							
				<?php } ?>
			</span>
		</div>
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
			
			<a href="<?php echo esc_url( $link ); ?>" <?php if($meta['btntarget']==true){ echo 'target="_blank"';} ?>>
				<?php the_title('<h4 class="room_title">','</h4>'); ?>
			</a>

			<?php
				the_excerpt();
			?>
			<div class="text-center">
				<a class="more-link" href="<?php echo esc_url( $link ); ?>" <?php if($meta['btntarget']==true){ echo 'target="_blank"';} ?>><?php echo $button_text; ?></a>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->