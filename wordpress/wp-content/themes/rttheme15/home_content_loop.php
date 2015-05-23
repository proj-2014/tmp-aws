<?php
/* 
* rt-theme home page content loop
*/

global $home_page,$which_theme,$row;

// home layout
$home_layout_names=array("9"=>"four-five","8"=>"three-four","7"=>"two-three","6"=>"full-box","5"=>"five","4"=>"four","3"=>"three","2"=>"two");

// Image width and headlines for box sizes
$layout_values =   array(
					"9" => array (
								"w" => 508,
								"h" => 100,
								"box_width" => 528,
								"t1" => "<h6>",
								"t2" => "</h6>"					
							),
					"8" => array (
								"w" => 475,
								"h" => 100,
								"box_width" => 495,
								"t1" => "<h6>",
								"t2" => "</h6>"					
							),
					"7" => array (
								"w" => 420,
								"h" => 100,
								"box_width" => 440,
								"t1" => "<h6>",
								"t2" => "</h6>"					
							),
					"6" => array (
								"w" => 640,
								"h" => 100,
								"box_width" => 660,
								"t1" => "<h6>",
								"t2" => "</h6>"					
							),
					"5" => array (
								"w" => 112,
								"h" => 100,
								"box_width" => 132,
								"t1" => "<h6>",
								"t2" => "</h6>"					
							),
					"4" => array (
								"w" => 145,
								"h" => 100,
								"box_width" => 165,
								"t1" => "<h5>",
								"t2" => "</h5>"	
							),
					"3" => array (
								"w" => 200,
								"h" => 120,
								"box_width" => 220,
								"t1" => "<h5>",
								"t2" => "</h5>"	
							),
					"2" => array (
								"w" => 310,
								"h" => 180,
								"box_width" => 320,
								"t1" => "<h4>",
								"t2" => "</h4>"	
							)
					);
 
	
		//keep posts
		$keep = query_posts($home_page);

		//variables
		$reset_row_count = 0;
		$counter = 0;   
		$reset="";

		//post & page counts
		$page_count=get_page_count();
		$post_count=$page_count['post_count'];		
		
		if (have_posts() ) : while ( have_posts() ) : the_post();
		
		#
		#	Values 
		#
		
		$box_title			=	get_the_title();
		$box_sub_title			=	get_post_meta($post->ID, THEMESLUG.'sub_title', true);
		$custom_link 			= 	get_post_meta($post->ID, THEMESLUG.'custom_link', true);
		$custom_link_text 		= 	get_post_meta($post->ID, THEMESLUG.'custom_link_text', true);
		$image 				=	get_post_thumbnail_id();
		$crop				=	get_post_meta($post->ID, THEMESLUG.'homepage_image_crop', true);
		$custom_image_height	=	get_post_meta($post->ID, THEMESLUG.'homepage_image_height', true);
		

		#
		#	Box counter
		#
		if (!isset($box_counter)) $box_counter = 1;

		 
		#
		#	Box Layout
		#
		if(get_post_meta($post->ID, THEMESLUG.'layout_options', true)){
			$box_layout=get_post_meta($post->ID, THEMESLUG.'layout_options', true);
		}else{
			$box_layout=4;
		}
	
		#
		#	next item box width
		#
		if($keep[$box_counter-1]->ID){
			$next_item_layout =  isset($keep[$counter+1]->ID) ? get_post_meta($keep[$counter+1]->ID, THEMESLUG.'layout_options', true) : 4;
			
			if(empty($next_item_layout)) {
				$next_item_layout  = $box_layout;  
			}
		}
		
		#
		#	this box layout values
		#
		$this_layout_values = $layout_values[$box_layout];
	
		#
		#	next box layout values
		#
		$next_layout_values = $layout_values[$next_item_layout];	

		#
		#	Reset Counter
		#
		$reset=false;
		$reset_row_count =  $reset_row_count + $this_layout_values["box_width"];
	
		#
		#	Thumbnail dimensions
		#
		$w = $this_layout_values["w"];
		$h = $this_layout_values["h"]; //OFF

		#
		#	Fix for responsive version
		#
		if($w < 360) $w = 380;


		#
		#	Crop
		#
		if($crop) $h=$custom_image_height; else $h=10000;
		
		#
		#	Resize Image
		#
		if($image) $image_thumb = vt_resize( $image, '', $w, $h, $crop );
		
		#
		#	first and last
		#
		$total_width = $reset_row_count+$next_layout_values["box_width"];
		if($box_counter==1){
			$addClass="first";
		}  
		elseif ($total_width > 660){
			$addClass="last";
			$box_counter=0;
			$reset_row_count = 0;
		}
		else{
			$addClass="";
		}

		if ($total_width > 660 && $box_counter==1){
			$addClass="first";
			$box_counter=0;
			$reset_row_count = 0;
		}
		
		?>

		<!-- box -->
		<div class="box <?php echo $home_layout_names[$box_layout];?> <?php echo $addClass;?>">
			<?php if($image):?>
			<!-- featured image -->
			<img src="<?php echo @$image_thumb["url"];?>" class="featured" alt="" />
			<?php endif;?>
			
			<div class="featured">
				<?php if($box_title):?>
				<div class="title">
					<!-- box title-->					
					<h4><?php if($custom_link):?><a href="<?php echo $custom_link;?>" title="<?php echo $box_title;?>"><?php endif;?><?php echo $box_title;?><?php if($custom_link):?></a><?php endif;?></h4>					    
				</div>
				<?php endif;?>

				<?php
				if ($custom_link && $custom_link_text):
					$read_more =  "<a href=\"". $custom_link ."\" title=\"". $box_title ."\" class=\"read_more\">". $custom_link_text ." →</a>";
				else:
					$read_more ="";
				endif;
				?>
			
				<!-- text-->
				<?php  echo apply_filters('the_content',(get_the_content().$read_more));?>				
			</div>
		    
		</div>
		<!-- /box -->
    
		<?php
		$counter++; 
		$box_counter++;
  
		//close row
		if ($post_count==$counter || $addClass=="last"): 	 
			echo "<div class=\"clear\"></div>";
		endif;		
		?>
    
		<?php endwhile;endif;?>
            
<?php wp_reset_query();?>
<div class="clear"></div>