<?php get_header();?>

	<?php get_template_part( 'sub_page_header', 'sub_page_header_file' );?>
		
		
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
	 

	<!-- page title --> 
	<?php if(!is_front_page() && !is_blog_page()):?>
		<div class="head_text"><h2><?php the_title(); ?></h2></div><!-- / page title -->  
	<?php endif;?>
	
			
		<?php
		#
		#  Regular Page     
		#

			//featured image	   
			$thumb 			= get_post_thumbnail_id();
			$image_url 		= wp_get_attachment_image_src($thumb,'false', true);
			$width 			= 300;
			$height 			= 300;
			if($thumb) $image 	= @vt_resize( $thumb, '', $width, $height, 'false' );
		?>
 
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<?php if($thumb)://featured image ?>
					<span class="frame alignleft"><a href="<?php echo $image_url[0]; ?>" title="<?php the_title(); ?>" rel="prettyPhoto[page_featured_image]" class="imgeffect plus">
						<img src="<?php echo $image["url"];?>" alt="<?php the_title(); ?>" />
					</a></span>
				<?php endif;?>
								
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			<?php endwhile;?>
	    
			<?php else: ?>
				<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
			<?php endif; ?>
			

		<?php
		#
		#  Contact Page     
		#
		if($post->ID == wpml_page_id(CONTACTPAGE, $purpose = "get_translation")){
			
			get_template_part( 'contact_us', 'contact_page' );
		}
		?>
		
		<?php
		#
		#  Blog Start Page     
		#
		if($post->ID == wpml_page_id(BLOGPAGE, $purpose = "get_translation")){
			//blog cats
			if(get_option('rttheme_blog_ex_cat[]')){
				$blog_cats=implode(unserialize(get_option('rttheme_blog_ex_cat[]')),",");
			}else{
				$blog_cats="";
			}
			
			
			//Match WPML Categories
			$blog_cats= wpml_lang_object_ids(array($blog_cats),'category');
			if(is_array($blog_cats)) $blog_cats  = implode($blog_cats,',');
		
			if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			$args=array(
				'post_status'	=> 	'publish',
				'orderby'		=> 	'date',
				'order'		=> 	'DESC',
				'paged'		=>	$paged,
				'cat'		=>	$blog_cats 
			);
		
			get_template_part( 'loop', 'archive' );
		}
		?>


		<?php
		#
		#  Portfolio Start Page     
		#
		 
		if($post->ID == wpml_page_id(PORTFOLIOPAGE, $purpose = "get_translation") && get_option(THEMESLUG.'_portf_first_page_hide')){ 
	
			if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			$args=array(
			    'post_status'	=>	'publish',
			    'post_type'		=>	'portfolio',
			    'orderby'		=>	get_option('rttheme_portf_list_orderby'),
			    'order'			=>	get_option('rttheme_portf_list_order'),
			    'posts_per_page'=>	get_option('rttheme_portf_pager'), 
			    'paged'=>$paged
			);

			if(get_option('rttheme_portf_start_cat')){
				
				//Match WPML Categories
				$rttheme_portf_start_cat= wpml_lang_object_ids(array(get_option('rttheme_portf_start_cat')),'portfolio_categories');
				if(is_array($rttheme_portf_start_cat)) $rttheme_portf_start_cat  = implode($rttheme_portf_start_cat,',');
				
				$args2=array( 
					'tax_query' => array(
						array(
							'taxonomy'	=>	'portfolio_categories',
							'field' 	=>	'id',
							'terms' 	=>	$rttheme_portf_start_cat
						)
					)
				);
				$args = array_merge($args, $args2);
			}
	
			get_template_part( 'portfolio_loop', 'portfolio_categories');
		}
		?>


		<?php
		#
		#  Product Start Page     
		#
		
		if($post->ID == wpml_page_id(PRODUCTPAGE, $purpose = "get_translation") && get_option(THEMESLUG.'_products_first_page_hide')){ 
	
			if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			$args=array(
			    'post_status'	=>	'publish',
			    'post_type'		=>	'products',
			    'orderby'		=>	get_option('rttheme_product_list_orderby'),
			    'order'			=>	get_option('rttheme_product_list_order'),
			    'posts_per_page'=>	get_option('rttheme_product_list_pager'), 
			    'paged'=>$paged
			);

			if(get_option('rttheme_product_start_cat')){
			
				//Match WPML Categories
				$rttheme_product_start_cat= wpml_lang_object_ids(array(get_option('rttheme_product_start_cat')),'product_categories');
				if(is_array($rttheme_product_start_cat)) $rttheme_product_start_cat  = implode($rttheme_product_start_cat,',');
				
				$args2=array( 
					'tax_query' => array(
						array(
							'taxonomy'	=>	'product_categories',
							'field' 	=>	'id',
							'terms' 	=>	$rttheme_product_start_cat
						)
					)
				);
				$args = array_merge($args, $args2);
			} 
			
			get_template_part( 'product_loop', 'product_categories');
		}
		?> 
    
<?php get_footer();?>