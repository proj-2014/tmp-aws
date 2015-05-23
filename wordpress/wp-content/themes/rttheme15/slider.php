<?php
/* 
* rt-theme slider
*/
?> 
<!-- Slider -->	
<div id="slider">
	<div id="slider_area" class="cycle">

		<?php
		    $slides=array(
		    'post_type'=> 'slider',
		    'post_status'=> 'publish',
		    'ignore_sticky_posts'=>1,
		    'showposts' => 1000,
		    'cat' => -0,
		);

		query_posts($slides); 
		
		$background_images="";
		
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		
		$hide_title_and_text = get_post_meta($post->ID, THEMESLUG.'hide_titles', true); 
		$custom_link = get_post_meta($post->ID, THEMESLUG.'custom_link', true);	
		$title = get_the_title();
		$slide_text = get_post_meta($post->ID, THEMESLUG.'slide_text', true);
		$thumb = get_post_thumbnail_id(); 
		$image = @vt_resize( $thumb, '', 640, 1000, false );			  
		?>
		
		<!-- slide -->
		<div class="slide">
			
			<?php if($hide_title_and_text):?>
				<!-- slide description -->
				<div class="desc">
					<!-- title -->
					<span class="title">
					    <?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php else:?><span><?php endif;?>
							<?php echo $title; ?>
					    <?php if($custom_link):?></a><?php else:?></span><?php endif;?>
					</span>
					<!-- text -->
					<span class="text">
					    <!-- slide text -->
					    <?php echo $slide_text; ?>
					</span>
				</div>
				<!-- /slide description -->
			<?php endif;?>
			
			<!-- slide right-side image -->
			<img src="<?php echo $image["url"];?>" alt="<?php echo $title; ?>" />
			<!-- /slide right-side image -->			    
		
		</div>
		<!--/ slide -->

		<?php 
		endwhile;endif;?>  	 
	
	</div>
	
	<?php if(get_option(THEMESLUG."_slider_buttons")):?>
		<!-- slider buttons -->
		<div id="numbers"></div>
	<?php endif;?>
</div>
<div class="clear"></div>
<?php wp_reset_query();?> 