<?php
/* 
* rt-theme portfolio loop
*/

global $args,$wp_query;
if(is_tax()) $args = array_merge( $wp_query->query, $args);

//keep posts
$keep = query_posts($args); 
 
// portfolio layout
$portfolio_layout_names	=	array("5"=>"five","4"=>"four","3"=>"three","2"=>"two");

// Image width and headlines for box sizes
$layout_values =   array(
					"5" => array (
								"w" => 96,
								"h" => 100,
								"box_width" => 132,
								"t1" => "<h6>",
								"t2" => "</h6>"					
							),
					"4" => array (
								"w" => 129,
								"h" => 100,
								"box_width" => 165,
								"t1" => "<h5>",
								"t2" => "</h5>"	
							),
					 "3" => array (
								"w" => 184,
								"h" => 120,
								"box_width" => 220,
								"t1" => "<h5>",
								"t2" => "</h5>"	
							),
					 "2" => array (
								"w" => 294,
								"h" => 180,
								"box_width" => 320,
								"t1" => "<h4>",
								"t2" => "</h4>"	
							)
					);
	
//is crop active	
$crop = get_option('rttheme_portfolio_image_crop');


$reset_row_count = 0;
$counter = 0;   

if ( have_posts() ) : while ( have_posts() ) : the_post();

	// Values
	$image 			=	find_image_org_path(get_post_meta($post->ID, THEMESLUG.'_portfolio_image', true));
	$title 			=	get_the_title();
	$video 			=	get_post_meta($post->ID, 'rttheme_portfolio_video', true);
	$video_thumbnail 	=	find_image_org_path(get_post_meta($post->ID, 'rttheme_portfolio_video_thumbnail', true)); 
	$desc 			=	get_post_meta($post->ID, 'rttheme_portfolio_desc', true);
	$permalink	 	=	get_permalink();
	$remove_link	 	= 	get_post_meta($post->ID, 'rttheme_portf_no_detail', true);
	$custom_thumb		= 	get_post_meta($post->ID, 'rttheme_portfolio_thumb_image', true);
	
	//box counter
	if (!isset($box_counter)) $box_counter = 1;


	// Box Width
	if(get_post_meta($post->ID, 'rttheme_layout_options', true)){
		$rttheme_portfolio_layout=get_post_meta($post->ID, 'rttheme_layout_options', true);
	}else{
		$rttheme_portfolio_layout=4;
	}
	
	//next item box width
	if($keep[$box_counter-1]->ID){
		$next_item_layout = isset($keep[$counter+1]) ? get_post_meta($keep[$counter+1]->ID, 'rttheme_layout_options', true) : 2;				
		
		if(empty($next_item_layout)) {
			$next_item_layout  = $rttheme_portfolio_layout;  
		}
	}

	//this box layout values
	$this_layout_values = $layout_values[$rttheme_portfolio_layout];

	//next box layout values
	$next_layout_values = $layout_values[$next_item_layout];	

	
	// Reset Counter	
	$reset=false;
	$reset_row_count =  $reset_row_count + $this_layout_values["box_width"];

	
	//Thumbnail dimensions
	$w = $this_layout_values["w"];
	$h = $this_layout_values["h"]; 
 

	// Crop
	if($crop) $crop="true"; else $h=10000;
	
	// Resize Portfolio Image
	if($image) $image_thumb = @vt_resize( '', $image, $w, $h, ''.$crop.'' );
	
	
	// Resize Video Image
	if($video_thumbnail) $video_thumbnail = @vt_resize( '', $video_thumbnail, $w, $h, ''.$crop.'' );
	
	
	/* Getting image type */
	if ($video) {
		$button="play";
		$media_link= $video;
	} else {
		$media_link= $image;
		$button="plus";
	}
	
	
	//firt and last
	if($box_counter==1){
		$addClass="first";
	}  
	elseif ($reset_row_count+$next_layout_values["box_width"] > 660){
		$addClass="last";
		$box_counter=0;
		$reset_row_count = 0;
	}
	else{
		$addClass="";
	}

?>
 
	<!-- box -->
	<div class="box <?php echo $portfolio_layout_names[$rttheme_portfolio_layout];?> <?php echo $addClass;?> portfolio">

	
		<?php if ($image || $video_thumbnail || $custom_thumb):?>
		<!-- portfolio image -->
		<span class="frame block">
			
			<?php if($media_link):?><a href="<?php echo $media_link;?>" title="<?php echo $title; ?>" rel="prettyPhoto[rt_theme_portfolio]" class="imgeffect <?php echo $button;?>"><?php endif;?>

				<?php if($custom_thumb)://auto resize not active?>
				    <img src="<?php echo $custom_thumb;?>" alt="<?php echo $title; ?>" />
				<?php elseif($video_thumbnail):?>
				    <img src="<?php echo $video_thumbnail["url"];?>" alt="<?php echo $title;?>" />	    
				<?php else:?>
				    <img src="<?php echo $image_thumb["url"];?>" alt="<?php echo $title;?>" />
				<?php endif;?>

			<?php if($media_link):?></a><?php endif;?>
		</span>
		<!-- / portfolio image -->		
		<?php endif;?>

		<div class="portfolio_info">
			<!-- title-->
			<?php echo $this_layout_values["t1"];?><?php if(!$remove_link):?><a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>"><?php endif; ?><?php echo $title; ?><?php if(!$remove_link): ?></a><?php endif; ?><?php echo $this_layout_values["t2"];?>	

			<?php if($desc):?>
				<p>
				<!-- text-->
				<?php echo $desc;?>
				
				<?php if(!$remove_link):?>
					<a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>" class="read_more"><?php _e( 'read more →', 'rt_theme' ); ?></a>
				<?php endif;?>
				</p>
			<?php endif;?>
    
		</div>

	</div>
	<!-- /box --> 

<?php
//get page and post counts
$page_count=get_page_count();
$post_count=$page_count['post_count'];
    
    $counter++; 
    $box_counter++;
    
    //close row
	if ($post_count==$counter || $addClass=="last"): 	 
		echo "<div class=\"clear\"></div>";
	endif;
?>

<?php endwhile;?>


<?php if($page_count['page_count']>1):?> 
 
	<!-- paging-->
	<div class="paging_wrapper">
		<ul class="paging">
			<?php get_pagination(); ?>
		</ul>
	</div>			
	<!-- / paging-->
    
<?php endif;?>


<?php endif; wp_reset_query(); ?>