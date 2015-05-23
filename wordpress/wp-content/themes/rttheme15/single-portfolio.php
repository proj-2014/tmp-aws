<?php
# 
# rt-theme single portfolio page
#

//taxonomy
$taxonomy = 'portfolio_categories';

//page link
$link_page=get_permalink(get_option('rttheme_portf_page'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
	foreach ($terms as $taxindex => $taxitem) {
	if($i==0){
		$link_cat		= get_term_link($taxitem->slug,$taxonomy);
		$term_slug 	= $taxitem->slug;
		$term_id 		= $taxitem->term_id;    
		}
	$i++;
	}
}

// portfolio crop image
$crop 	= 	get_option('rttheme_portfolio_image_crop');

get_header();
 
?>
<?php get_template_part( 'sub_page_header', 'sub_page_header_file' );?>

	<!-- page title --> 
	<?php if(!is_front_page() && !is_blog_page()):?>
		<div class="head_text"><h2><?php the_title(); ?></h2></div><!-- / page title -->  
	<?php endif;?>
 
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
				<?php
				
				// Values
				$image 			=	get_post_meta($post->ID, 'rttheme_portfolio_image', true);
				$title 			=	get_the_title();
				$video 			=	get_post_meta($post->ID, 'rttheme_portfolio_video', true);
				$video_thumbnail 	=	get_post_meta($post->ID, 'rttheme_portfolio_video_thumbnail', true); 
				$desc 			=	get_post_meta($post->ID, 'rttheme_portfolio_desc', true);
				$permalink	 	=	get_permalink();
				$remove_link	 	= 	get_post_meta($post->ID, 'rttheme_portf_no_detail', true);
				$custom_thumb		= 	get_post_meta($post->ID, 'rttheme_portfolio_thumb_image', true);	
				$w=640;
				$h=400;
				
				// Crop
				if($crop) $crop="true"; else $h=10000;
				
				// Resize Portfolio Image
				if($image) $image_thumb = @vt_resize( '', $image, $w, $h, ''.$crop.'' );
				
				// Resize Video Image
				if($video_thumbnail) $video_thumbnail = @vt_resize( '', $video_thumbnail, $w, 999, '' );
				
				
				// Getting image type
				if ($video) {
					$button="play";
					$media_link= $video;
				} else {
					$media_link= $image;
					$button="plus";
				}
				?>

				<?php if ($image || $video_thumbnail || $custom_thumb):?>
				<!-- portfolio image -->
				<span class="frame block">
					
					<?php if($media_link):?><a href="<?php echo $media_link;?>" title="<?php echo $title; ?>" rel="prettyPhoto[rt_theme_portfolio]" class="imgeffect <?php echo $button;?>"><?php endif;?>
						
						<?php if($custom_thumb)://auto resize not active?>
						    <img src="<?php echo $custom_thumb;?>" alt="<?php echo $title; ?>"  />
						<?php elseif($video_thumbnail):?>
						    <img src="<?php echo $video_thumbnail["url"];?>" alt="<?php echo $title;?>" />	    
						<?php else:?>
						    <img src="<?php echo $image_thumb["url"];?>" alt="<?php echo $title;?>" />
						<?php endif;?>
		
					<?php if($media_link):?></a><?php endif;?>
				</span>
				<div class="space v_20"></div>
				<!-- / portfolio image -->		
				<?php endif;?>
		 
				<?php  the_content(); ?>
				
			<?php endwhile;?>

			<div class="clear"></div> 
			
			<div class='entry commententry'>
			    <?php comments_template(); ?>
			</div>
		  
			<?php else: ?>
				<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
			<?php endif; ?>

<?php get_footer();?> 