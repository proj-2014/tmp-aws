<?php
/* 
* rt-theme nivo slider
*/
?> 
<div class="slider-wrapper theme-default"> 
	<div id="nivo-slider" class="nivoSlider">
	
		<?php
		$rttheme_slider_height=get_option('rttheme_slider_height');
		
		$slides=array(
		'post_type'=> 'slider',
		'post_status'=> 'publish',
		'ignore_sticky_posts'=>1,
		'showposts' => 1000,
		'cat' => -0,
		);
		
		query_posts($slides);
		$background_images="";
		$captions="";
		$custom_link="";
		
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			
			$hide_title_and_text = get_post_meta($post->ID, THEMESLUG.'hide_titles', true); 
			$custom_link = get_post_meta($post->ID, THEMESLUG.'custom_link', true);	
			$title = get_the_title();
			$slide_text = get_post_meta($post->ID, THEMESLUG.'slide_text', true);
			$thumb = get_post_thumbnail_id(); 
			$image = @vt_resize( $thumb, '', 640, $rttheme_slider_height, true );
	 
			if (!get_post_meta($post->ID, 'rt_hide_titles', true)):
				$nivo_title = '#slide_'.$post->ID.'_caption';
				$nivo_alt  = trim(strip_tags($title));
			else:
				$nivo_title = '';
				$nivo_alt  = trim(strip_tags($title));
			endif;
			?>			
			
			<?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php endif;?>
				<!-- slide image -->
				<img src="<?php echo $image["url"];?>" alt="<?php echo $nivo_alt; ?>" title="<?php echo $nivo_title;?>" />
				<!-- /slide image -->
			<?php if($custom_link):?></a><?php endif;?>
			
			  
			<?php
			if ($hide_title_and_text):
			
				$captions.="";
				$captions.='<div id="slide_'.$post->ID.'_caption" class="nivo-html-caption">'."\n";  
				if($custom_link) : $captions.='<span class="nivo-title">'."\n"; else: $captions.='<span class="nivo-title no-link">'."\n"; endif;
				if($custom_link)  $captions.='<a href="'.$custom_link.'" title="'.$title.'">'."\n"; 
				$captions.= $title."\n"; 
				if($custom_link) $captions.='</a>'."\n";
				$captions.= "</span>\n"; 
				if($slide_text) $captions.= '<span class="nivo-text">'.$slide_text.'</span>'."\n"; 
				$captions.='</div>'."\n";
			else:

				$captions.="";
				$captions.='<div id="slide_'.$post->ID.'_caption" class="nivo-html-caption">'."\n";  
				$captions.='</div>'."\n";
			endif;
			?>      
		 
		<?php endwhile;endif;?>
 
	</div>
 
	<!-- captions  -->
	<?php echo $captions;?>
	<!-- /captions -->  

</div> 

<div class="clear"></div>
<?php wp_reset_query();?> 