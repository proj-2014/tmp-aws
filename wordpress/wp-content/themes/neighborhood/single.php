<?php get_header(); ?>

<?php	
	
	$options = get_option('sf_neighborhood_options');
	$default_show_page_heading = $options['default_show_page_heading'];
	$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
	$default_sidebar_config = $options['default_sidebar_config'];
	$default_left_sidebar = $options['default_left_sidebar'];
	$default_right_sidebar = $options['default_right_sidebar'];
	
	$show_page_title = get_post_meta($post->ID, 'sf_page_title', true);
	$page_title_one = get_post_meta($post->ID, 'sf_page_title_one', true);
	$page_title_bg = get_post_meta($post->ID, 'sf_page_title_bg', true);
	
	if ($show_page_title == "") {
		$show_page_title = $default_show_page_heading;
	}
	if ($page_title_bg == "") {
		$page_title_bg = $default_page_heading_bg_alt;
	}
	
	$full_width_display = get_post_meta($post->ID, 'sf_full_width_display', true);
	$show_author_info = get_post_meta($post->ID, 'sf_author_info', true);
	$show_social = get_post_meta($post->ID, 'sf_social_sharing', true);
	$show_related =  get_post_meta($post->ID, 'sf_related_articles', true);
	$remove_breadcrumbs = get_post_meta($post->ID, 'sf_no_breadcrumbs', true);
	
	$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = get_post_meta($post->ID, 'sf_left_sidebar', true);
	$right_sidebar = get_post_meta($post->ID, 'sf_right_sidebar', true);
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
	
	sf_set_sidebar_global($sidebar_config);
	
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
?>

<?php if ($show_page_title) { ?>	
	<div class="row">
		<div class="page-heading span12 clearfix alt-bg <?php echo $page_title_bg; ?>">
			<div class="heading-text">
			<?php if ($page_title_one) { ?>
			<h1><?php echo $page_title_one; ?></h1>
			<?php } else { ?>
			<h1><?php the_title(); ?></h1>
			<?php } ?>
			</div>
			<?php 
				// BREADCRUMBS
				if (!$remove_breadcrumbs) {
					echo sf_breadcrumbs();
				}
			?>
		</div>
	</div>
<?php } ?>


<?php if (have_posts()) : the_post(); ?>
	
	<?php		
		$post_author = get_the_author_link();
		$post_date = get_the_date();
		$post_categories = get_the_category_list(', ');
		
		$media_type = $media_image = $media_video = $media_gallery = '';
				 
		$use_thumb_content = get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
		$post_format = get_post_format($post->ID);
		if ( $post_format == "" ) {
			$post_format = 'standard';
		}
		if ($use_thumb_content) {
		$media_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
		} else {
		$media_type = get_post_meta($post->ID, 'sf_detail_type', true);
		}
		
		if ((($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar") || ($sidebar_config == "both-sidebars")) && !$full_width_display) {
		$media_width = 770;
		$media_height = NULL;
		$video_height = 433;
		} else {
		$media_width = 1170;
		$media_height = NULL;
		$video_height = 658;
		}
		$figure_output = '';
				
		if ($full_width_display) {
			$figure_output .= '<figure class="media-wrap full-width-detail span12" itemscope>';
		} else {
			$figure_output .= '<figure class="media-wrap" itemscope>';
		}
		
		if ($post_format == "standard") {
						
			if ($media_type == "video") {
						
				$figure_output .= sf_video_post($post->ID, $media_width, $video_height, $use_thumb_content)."\n";
						
			} else if ($media_type == "slider") {
						
				$figure_output .= sf_gallery_post($post->ID, $use_thumb_content)."\n";
					
			} else if ($media_type == "layer-slider") {
						
				$figure_output .= '<div class="layerslider">'."\n";
							
				$figure_output .= do_shortcode('[rev_slider '.$media_slider.']')."\n";
						
				$figure_output .= '</div>'."\n";
						
			} else if ($media_type == "custom") {
												
				$figure_output .= $custom_media."\n";				
						
			} else {
							
				$figure_output .= sf_image_post($post->ID, $media_width, $media_height, $use_thumb_content)."\n";
						
			}
			
		} else {
			
			$figure_output .= sf_get_post_media($post->ID, $media_width, $media_height, $video_height, $use_thumb_content);
									
		}
							
		$figure_output .= '</figure>'."\n";
	?>
	
	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
		<?php if ($full_width_display && $media_type != "none") {
			echo $figure_output;
		} ?>
		
		<!-- OPEN article -->
		<?php if ($sidebar_config == "left-sidebar") { ?>
		<article <?php post_class('clearfix span8'); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
		<?php } elseif ($sidebar_config == "right-sidebar") { ?>
		<article <?php post_class('clearfix span8'); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
		<?php } else { ?>
		<article <?php post_class('clearfix row'); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
		<?php } ?>
		
		<?php if ($sidebar_config == "both-sidebars") { ?>
			<div class="page-content span6 clearfix">
		<?php } else if ($sidebar_config == "no-sidebars") { ?>
			<div class="page-content span12 clearfix">
		<?php } else { ?>
			<div class="page-content clearfix">
		<?php } ?>
				
				<?php if (!$full_width_display && $media_type != "none") {
					echo $figure_output;
				} ?>
															
				<section class="article-body-wrap">
					<div class="body-text clearfix" itemprop="articleBody">
						<?php the_content(); ?>
						<div class="link-pages"><?php wp_link_pages(); ?></div>
					</div>
					
					<?php if ($show_author_info) { ?>
					
					<div class="author-info-wrap clearfix">
						<div class="author-avatar"><?php if(function_exists('get_avatar')) { echo get_avatar(get_the_author_meta('ID'), '164'); } ?></div>
						<div class="post-info">
							<div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person"><span><?php _e("Posted by", "swiftframework"); ?></span><a itemprop="url" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><span itemprop="name"><?php the_author_meta('display_name'); ?></span></a></div>
							<div class="post-date" itemprop="datePublished"><?php echo $post_date; ?></div>
							<div class="post-categories"><?php echo $post_categories; ?></div>
						</div>
					</div>
					
					<?php } ?>
										
					<div class="tags-link-wrap clearfix">
						<?php if (has_tag()) { ?>
						<div class="tags-wrap"><?php _e("Tags:", "swiftframework"); ?><span class="tags"><?php the_tags(''); ?></span></div>
						<?php } ?>
						<div class="comments-likes">
						<?php if (function_exists( 'lip_love_it_link' )) {
							echo lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>', false);
						} ?>				
						<?php if ( comments_open() ) { ?>
							<div class="comments-wrapper"><i class="icon-comments"></i><span><?php comments_number('0', '1', '%'); ?></span></div>
						<?php } ?>
						</div>
					</div>
					
					<?php if ($show_social) { ?>
					
					<div class="share-links clearfix">
						<div class="share-text"><?php _e("Share:", "swiftframework"); ?></div>
						<ul>
						    <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="product_share_facebook"><i class="icon-facebook"></i></a></li>
						    <li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="product_share_twitter"><i class="icon-twitter"></i></a></li>   
						    <li><a href="https://plus.google.com/share?url={URL}" onclick="javascript:window.open(this.href,
						      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="icon-google-plus"></i></a></li>
						    <li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php echo get_the_title(); ?>"><i class="icon-pinterest"></i></a></li>
							<li><a href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php the_permalink(); ?>" class="product_share_email"><i class="icon-envelope"></i></a></li>
						    <li><a class="permalink item-link" href="<?php the_permalink(); ?>"><i class="icon-link"></i></a></li>
						</ul>						
					</div>
					
					<?php } ?>
					
				</section>
				
				<?php if ($show_related) { ?>
				
				<div class="related-wrap">
				<?php
					$categories = get_the_category($post->ID);
					if ($categories) {
						$category_ids = array();
						foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
						$args=array(
							'category__in' => $category_ids,
							'post__not_in' => array($post->ID),
							'showposts'=> 4, // Number of related posts that will be shown.
							'orderby' => 'rand'
						);
					}
					$related_posts_query = new wp_query($args);
					if( $related_posts_query->have_posts() ) {
						_e("<h4>Related Articles</h4>", "swiftframework");
						echo '<ul class="related-items row clearfix">';
						while ($related_posts_query->have_posts()) {
							$related_posts_query->the_post();
							$thumb_image = "";
							$thumb_image = get_post_meta($post->ID, 'sf_thumbnail_image', true);
							if (!$thumb_image) {
								$thumb_image = get_post_thumbnail_id();
							}
							$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
							$image = aq_resize( $thumb_img_url, 220, 152, true, false);
							?>
							<?php if ($sidebar_config == "both-sidebars" || $sidebar_config == "no-sidebars") { ?>
							<li class="related-item span3 clearfix">
							<?php } else { ?>
							<li class="related-item span2 clearfix">
							<?php } ?>
								<figure>
									<a href="<?php the_permalink(); ?>">
										<div class="overlay"><div class="thumb-info">
											<i class="icon-file-alt"></i>
										</div></div>
										<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" />
									</a>
								</figure>
								<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
							</li>
						<?php }
						echo '</ul>';
					}
												
					wp_reset_query();
				?>
				</div>
				
				<?php } ?>
				
				<div class="pagination-wrap blog-pagination clearfix">
					<div class="nav-previous"><?php next_post_link('%link', __('<i class="icon-angle-left"></i> <span class="nav-text">%title</span>', 'swiftframework'), FALSE); ?></div>
					<div class="nav-next"><?php previous_post_link('%link', __('<span class="nav-text">%title</span><i class="icon-angle-right"></i>', 'swiftframework'), FALSE); ?></div>
				</div>
				
				<?php if ( comments_open() ) { ?>
				<div id="comment-area">
					<?php comments_template('', true); ?>
				</div>
				<?php } ?>
			
			</div>
			
			<?php if ($sidebar_config == "both-sidebars") { ?>
			<aside class="sidebar left-sidebar span3">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
			<?php } ?>
		
		<!-- CLOSE article -->
		</article>
	
		<?php if ($sidebar_config == "left-sidebar") { ?>
				
			<aside class="sidebar left-sidebar span4">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
	
		<?php } else if ($sidebar_config == "right-sidebar") { ?>
			
			<aside class="sidebar right-sidebar span4">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
	
			<aside class="sidebar right-sidebar span3">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
		
		<?php } ?>
				
	</div>

<?php endif; ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>