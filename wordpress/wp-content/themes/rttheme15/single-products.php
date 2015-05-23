<?php
# 
# rt-theme product detail page
#

//flush rewrite rules
add_action('init', 'flush_rewrite_rules');

//taxonomy
$taxonomy = 'product_categories';

//page link
$link_page = get_permalink(get_option('rttheme_product_list'));

//variables 
$other_photos = "";
$photo_count = "";

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
	foreach ($terms as $taxindex => $taxitem) {
	if($i==0){
		$link_cat=get_term_link($taxitem->slug,$taxonomy);
		$term_slug = $taxitem->slug;
		$term_id = $taxitem->term_id;
		}
	$i++;
	}
}

//product options
$crop = get_option('rttheme_product_image_crop');	 	// image crop

get_header();
?>

<?php get_template_part( 'sub_page_header', 'sub_page_header_file' );?>

	<?php
	if (have_posts()) : while (have_posts()) : the_post();
	
		//values
		$rt_other_images 	= trim(get_post_meta($post->ID, 'rtthemeother_images', true));
		$rt_chart_file_url  = get_post_meta($post->ID, 'rtthemechart_file_url', true);
		$rt_excel_file_url  = get_post_meta($post->ID, 'rtthemeexcel_file_url', true);
		$rt_pdf_file_url  	= get_post_meta($post->ID, 'rtthemepdf_file_url', true);
		$rt_word_file_url  	= get_post_meta($post->ID, 'rtthemeword_file_url', true);
		$content			= get_the_content();
		$title				= get_the_title();
		$order_button		= get_post_meta($post->ID, THEMESLUG.'order_button', true);
		$order_button_text	= get_post_meta($post->ID, THEMESLUG.'order_button_text', true);
		$order_button_link	= get_post_meta($post->ID, THEMESLUG.'order_button_link', true);
		$related_products	= get_post_meta($post->ID, THEMESLUG.'related_products[]', true);
		$short_desc		= get_post_meta($post->ID, THEMESLUG.'short_description', true);
	 	$tabbed_page = "";

		//free tabs count
		$tab_count=3;
		for($i=0; $i<$tab_count+1; $i++){
		    if (trim(get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true)))  $tabbed_page="yes";
		}
	?>
	
	<!-- product images --> 
	<div class="box three product first">

		<?php
			//photos
			
			//default photo
			if(get_post_meta($post->ID, THEMESLUG.'product_image_url', true)):
			    $default_photo  = get_post_meta($post->ID, THEMESLUG.'product_image_url', true);
			    $total_photo 	= 1;
			endif;
			
			
			//other photos
			if(trim($rt_other_images)):
			    $other_photos 	= trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $rt_other_images));  
			    $total_photo	= $total_photo + count( explode("\n", $other_photos) );
			endif;
			
			//merge all
			$product_photos=@$default_photo ."\n".@$other_photos;
						
			?>
			
			<?php if (trim($product_photos)):?>
				<!-- product image slider -->

				<div class="ppy product" id="ppy2">
					<ul class="ppy-imglist">

						<?php  
						//Product Photos 
						$product_photos_split=explode("\n", $product_photos);
					
						foreach ($product_photos_split as &$photo_url) {
						
							if($photo_url){
								//resize the photo 
								$w	= 188;
								$h	= 180;
								
								$photo_url = find_image_org_path($photo_url);
								
								// Crop
								if($crop) $crop="true"; else $h=10000;
								
								$image_thumb 		= @vt_resize( '', $photo_url, $w, $h, ''.$crop.'' );
								$image_big 		= @vt_resize( '', $photo_url, 630, 10000, false );
								?>
								<li><a href="<?php echo $image_big['url'];?>" title=""><img src="<?php echo $image_thumb['url'];?>" alt="" /></a></li>
								<?php
								
								@$photo_count++;
							}
						}
						?>
					</ul>

					<div class="ppy-outer">
						<div class="ppy-stage">
							<!-- ppy navigation --> 
							<div class="ppy-nav <?php if($photo_count==1) echo "single";?>">						
								<div class="nav-wrap">
									<a class="ppy-prev" title="Previous image">Previous image</a>
									<a class="ppy-switch-enlarge" title="Enlarge">Enlarge</a>
									<a class="ppy-switch-compact" title="Close">Close</a>
									<a class="ppy-next" title="Next image">Next image</a>
								</div>
							</div>
							<!-- ppy counter --> 
							<div class="ppy-counter">
								<strong class="ppy-current"></strong> / <strong class="ppy-total"></strong>
							</div>
						</div>
						<div class="ppy-caption"><span class="ppy-text"></span></div>
					</div> 
				</div>
			<?php endif;?>
	</div>
	<!-- / product images -->
	
	
	<!-- product description --> 
	<div class="box two-three product last">
		
		<?php if($order_button):?>
		<!-- order button -->
		<a href="<?php echo $order_button_link;?>" class="button small alignright default"><span class="mail"><?php if($order_button_text): echo $order_button_text; else: _e('Order Enquiry','rt_theme'); endif; ?></span></a>
		<!-- / order button -->
		<?php endif;?>
					
		<!-- product title --> 
		<h2 class="alignleft"><?php the_title(); ?></h2>
		<!-- / product title -->
		
		<div class="clear"></div><div class="space v_10"></div>
		
		<?php echo (do_shortcode($short_desc));?>
		
	</div>
	<!-- / product description --> 

	<div class="clear"></div>
	<div class="space v_10"></div>
	
	

	<!-- PRODUCT TABS -->
	<div class="box product_detail full">

		<!-- TABS WRAP -->				
		<?php if(@$tabbed_page):?>
		<div class="taps_wrap">
		    <!-- the tabs -->
		    <ul class="tabs">
				<?php if($content):?><li><a href="#"><?php _e('General Details','rt_theme');?></a></li><?php endif;?>
				<?php
				#
				#	Free Tabs
				#	
				for($i=0; $i<$tab_count+1; $i++){ 
					if (trim(get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true))){
						echo '<li><a href="#">'.get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true).'</a></li>';
					}
				}
				
				#
				#	Attached Documents
				#					
				if($rt_chart_file_url || $rt_excel_file_url || $rt_pdf_file_url || $rt_word_file_url ){
					echo '<li><a href="#">'.__('Attached Documents','rt_theme').'</a></li>';
				}
				?>
		
		    </ul>
		<?php endif;?>
		
		<?php if($content):?>								
		<!-- General Details -->
		
		<?php if(@$tabbed_page):?><div class="pane"><?php else:?><div class="box"><?php endif;?> 
			<div>
			<?php 
			echo apply_filters('the_content',$content);

			?></div>
			<div class="clear"></div>
		</div>
		<?php endif;?>

		<?php
		#
		#	Free Tabs' Content
		#	
		for($i=0; $i<$tab_count+1; $i++){ 
			if (trim(get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true))){

				echo '<div class="pane">'.apply_filters('the_content',get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_content', true)).'<div class="clear"></div></div>';

				//echo '<div class="pane">'.wpautop(do_shortcode().'<div class="clear"></div></div>';
			}
		}
		?>

		<?php if($rt_chart_file_url || $rt_excel_file_url || $rt_pdf_file_url || $rt_word_file_url ):?>
			<?php if(@!$tabbed_page):?><div class="line"></div><?php endif;?>
			<div class="pane">
				<!-- document icons -->
				<ul class="doc_icons">
					<?php if($rt_chart_file_url):?><li><a href="<?php echo $rt_chart_file_url; ?>" title="<?php _e('Download Charts','rt_theme');?>"><img src="<?php echo THEMEURI; ?>/images/assets/icons/Chart_1.png" alt="<?php _e('Download Charts','rt_theme');?>" class="png" /></a></li><?php endif;?>
					<?php if($rt_excel_file_url):?><li><a href="<?php echo $rt_excel_file_url; ?>" title="<?php _e('Download Excel File','rt_theme');?>"><img src="<?php echo THEMEURI; ?>/images/assets/icons/File_Excel.png" alt="<?php _e('Download Excel File','rt_theme');?>" class="png" /></a></li><?php endif;?>
					<?php if($rt_pdf_file_url):?><li><a href="<?php echo $rt_pdf_file_url; ?>" title="<?php _e('Download PDF File','rt_theme');?>" ><img src="<?php echo THEMEURI; ?>/images/assets/icons/File_Pdf.png" alt="<?php _e('Download PDF File','rt_theme');?>" class="png" /></a></li><?php endif;?>
					<?php if($rt_word_file_url):?><li><a href="<?php echo $rt_word_file_url; ?>" title="<?php _e('Download Word File','rt_theme');?>" ><img src="<?php echo THEMEURI; ?>/images/assets/icons/Word.png" alt="<?php _e('Download Word File','rt_theme');?>" class="png" /></a></li><?php endif;?>
				</ul>
				<!-- document icons -->
			</div>
		<?php endif;?>
				
				
		<?php if(@$tabbed_page):?>        
		</div><div class="clear"></div>
		<?php endif;?>
		
	</div>
	<!-- / PRODUCT TABS -->
				
	<div class="space v_10"></div>
	<!-- / content --> 		

	
	<!-- RELATED PRODUCTS --> 
		<?php
		if($related_products){
			echo '<h4>'.__("Related Products",'rt_theme').'</h4><div class="bold_line"></div>';		
			//taxonomy 
			$args=array(
			'post_type'=> 'products', 
			'post_status'=> 'publish',
			'orderby'=> 'menu_order', 
			'ignore_sticky_posts'=>1,
			'posts_per_page'	=>	1000, 
			'post__in' =>	$related_products
			);
		    get_template_part( 'product_loop', 'product_categories' );
		}
		?>

	<!-- / RELATED PRODUCTS -->


	<?php endwhile;?>
	
	<?php else: ?>
		<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
	<?php endif; ?>
	
	

  
<?php get_footer();?>