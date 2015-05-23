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
	    <div class="box full blog">
	    
			<!-- blog headline-->
			<h2><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<!-- / blog headline--> 
			
			<?php if(get_the_excerpt()):?>
			<!-- blog text-->
				<?php
				if(!empty($post->post_content)): $link=' <a href="'. get_permalink($post->ID) . ' " class="read_more" >'.__('read more →','rt_theme').'</a>';endif;			    
				echo apply_filters('the_content',(get_the_excerpt().$link));	
				?> 
			<!-- /blog text-->
			<?php endif;?>
		
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
