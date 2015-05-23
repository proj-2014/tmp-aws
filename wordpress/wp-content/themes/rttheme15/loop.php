<?php
# 
# rt-theme loop
#

global $args;
add_filter('excerpt_more', 'no_excerpt_more');

if ($args) query_posts($args);

if ( have_posts() ) : while ( have_posts() ) : the_post(); 
?> 


    <!-- blog box-->
    <div id="post-<?php the_ID(); ?>" <?php post_class('box full'); ?>>

	    <!-- blog box-->
	    <div class="box four-five first blog">
	    
			<!-- blog headline-->
			<h2><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<!-- / blog headline-->
			
			
			<?php
			//featured image	   
			$thumb 	= get_post_thumbnail_id();
			$crop 	= get_option('rttheme_image_crop'); if($crop) $crop="true";
			$width 	= get_option('rttheme_blog_image_width');
			$height 	= get_option('rttheme_blog_image_height'); if($height==0 ) $height=9999;
			
			if($thumb) $image = @vt_resize( $thumb, '', $width, $height, ''.$crop.'' );
			?>
			
			<?php if ($thumb):?>
			<!-- blog image-->
			<div class="blog_image alignleft">
			    <span class="frame alignleft"><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>" class="imgeffect link">
				   <img src="<?php echo $image["url"];?>" alt="<?php the_title(); ?>" />
			    </a></span>
			</div>
			<!-- / blog image -->
			<?php endif;?>
			
			
			<?php if(get_the_excerpt()):?>
			<!-- blog text-->
				<?php
				if(!empty($post->post_content)): $link=' <a href="'. get_permalink($post->ID) . ' " class="read_more" >'.__('read more →','rt_theme').'</a>';endif;			    				
				echo apply_filters('the_content',(get_the_excerpt().$link));	
				?> 
			<!-- /blog text-->
			<?php endif;?>
		
	    	</div>

		<div class="box five last blog">
			
			<div class="date <?php if (!$thumb) echo "nomargin";?>">
				<span class="day"><?php the_time("d") ?></span>
				<span class="month"><?php the_time("M") ?></span>
				<span class="year"><?php the_time("Y") ?></span>
			</div>
			
			<div class="post_data">		
				<span class="user"><?php echo the_author_posts_link();?></span>	
				<div class="categories"><?php the_category(', ') ?> </div>		
				<a href="<?php comments_link(); ?>" title="<?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?>" class="comment_link"><?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?></a>
			</div>
			
		</div>
	
	
	<div class="clear"></div>  
	</div>
	
	<div class="bold_line"></div>

	<!-- blog box-->
     
    
<?php endwhile; ?> 

<div class="clear"></div>
		
    <?php
    //get page and post counts
    $page_count=get_page_count();
    
    //show pagination if page count bigger then 1
    if ($page_count['page_count']>1):
    ?>  

    <!-- paging-->
    <div class="paging_wrapper">
	   <ul class="paging">
		  <?php get_pagination(); ?>
	   </ul>
    </div>			
    <!-- / paging-->
    
    <?php endif;?>

<?php wp_reset_query();?>

<?php else: ?>
<p><?php _e( 'Sorry, no posts matched your criteria.', 'rt_theme'); ?></p> 
<?php endif; ?>
