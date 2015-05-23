<?php
//page link
$link_page=get_permalink(get_option('rttheme_blog_page'));

//category link
$category_id = get_the_category($post->ID);
$category_id = $category_id[0]->cat_ID;//only one category can be show in the list  - the first one
$link_cat=get_category_link($category_id); 

//redirect to home page if user tries to view slider or home page contents by clicking the view link on admin
if (get_query_var('home_page') || get_query_var('slider')){ header( 'Location: '.BLOGURL.'/ ' ) ;}

get_header();
?>

<?php get_template_part( 'sub_page_header', 'sub_page_header_file' );?>



		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>            

			<?php
			//featured image	   
			$thumb 		= get_post_thumbnail_id();
			$crop 		= get_option('rttheme_image_crop'); if($crop) $crop="true";
			$image_url 	= wp_get_attachment_image_src($thumb,'false', true);
			$width 		= "624";
			$height 		= get_option('rttheme_blog_image_height'); if($height==0 ) $height=9999;
			
			if($thumb) $image = vt_resize( $thumb, '', $width, $height, ''.$crop.'' );
			?>

			<!-- blog box -->
			<div class="box five first blog single">
				<!-- date-->
				<div class="date">
					<span class="day"><?php the_time("d") ?></span>
					<span class="month"><?php the_time("M") ?></span>
					<span class="year"><?php the_time("Y") ?></span>
				</div> 
			</div>	
		    
			
			<div class="box four-five last blog single">
			
				<!-- blog headline-->
				<h2><?php the_title(); ?></h2>
				<!-- / blog headline--> 

				
				<div class="post_data">		
					<span class="user"><?php echo the_author_posts_link();?></span>	
					<div class="categories"><?php the_category(', ') ?> </div>		
					<a href="<?php comments_link(); ?>" title="<?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?>" class="comment_link"><?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?></a>
				</div>
			
			</div>	
		    
			<div class="space v_20"></div>	
		
			<div class="bold_line"></div>  
			<div class="box full single">

				<?php if ($thumb):?>
				<!-- blog image-->
				<div class="blog_image alignleft">
					<span class="frame alignleft blogimage"><a href="<?php echo $image_url[0]; ?>" title="<?php the_title(); ?>" rel="prettyPhoto[rt_theme_posts]" class="imgeffect plus">
						<img src="<?php echo $image["url"];?>" alt="<?php the_title(); ?>" />
					</a></span>
				</div>
				<!-- / blog image -->
				<?php endif;?>
			
			
				<!-- blog text-->
				<?php the_content(); ?> 
				<!-- /blog text-->
			
			</div>
			<?php if(get_the_tags()):?>
			<div class="tags">
			    <!-- tags -->
			    <?php echo the_tags( '<span>', '</span>, <span>', '</span>');?>  
			    <!-- / tags -->
			</div>
			<?php endif;?>
			 
			<!-- / blog box -->
			
			<div class="clear"></div>
			<div class="line"><span class="top">[<?php _e( 'top', 'rt_theme'); ?>]</span></div><!-- line -->
		<?php endwhile;?>
		
		<?php if(get_option(THEMESLUG."_hide_author_info")):?>
		<!-- Info Box -->		
			<div class="author_info">
			<h5><?php _e( 'About the Author', 'rt_theme' ); ?></h5>
			
			<span class="alignleft frame"><span class="avatar"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '60' ); }?></span></span>
			<p>				 
				<strong><?php the_author_posts_link(); ?></strong><br />
				<?php the_author_meta('description'); ?>
			</p>
		</div>
		<div class="space v_30"></div>
		<div class="line"></div><!-- line -->	

		<?php endif;?>            

		<div class='entry commententry'>
		    <?php comments_template(); ?>
		</div>
		
		<?php else: ?>
		    <p><?php _e( 'Sorry, no page found.', 'rt_theme' ); ?></p>
		<?php endif; ?>

   
<?php get_footer();?>