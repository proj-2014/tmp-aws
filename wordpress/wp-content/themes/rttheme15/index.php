<?php
/* 
* rt-theme home page 
*/
get_header(); 
?>

	<!-- slider -->
	<?php if(get_option(THEMESLUG."_slider_active") && is_front_page()){	//if slider active and is front page
			//Slider selection 
			$home_slider_script = get_option(THEMESLUG.'_home_slider_script');

			if($home_slider_script=="" or $home_slider_script=="cycle"){
				get_template_part( 'slider', 'home_slider' );
			}elseif($home_slider_script=="flex"){
				get_template_part( 'flex-slider', 'home_slider' );				
			}else{
				get_template_part( 'nivo-slider', 'home_slider' );
			}
		}
	?>
	<!-- / slider -->

	<!-- home page contents -->

		<?php
		//home pae content
		$home_page=array(
		    'post_type'=> 'home_page',
		    'post_status'=> 'publish',
		    'ignore_sticky_posts'=>1,
		    'showposts' => 1000,
		    'orderby'=> 'date',
		    'order' => 'ASC',
		    'cat' => -0,
		);
	 
	    get_template_part( 'home_content_loop', 'home_page' ); 
	    ?> 
   
	    <div class="clear"></div>

		<!-- widgetized home page area -->
		<?php if (function_exists('dynamic_sidebar')){  dynamic_sidebar('home-page-contents'); } ?>
		<div class="clear"></div>
		<!-- / widgetized home page area -->
		
	<!-- / home papge contents  -->    
    
<?php get_footer();?>