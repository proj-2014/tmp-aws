<?php
# 
# rt-theme product loop
#
global $args,$wp_query; 

//column
if(is_tax() || is_page()){
	$column 			= 3;
	$box_layout_class	= "three";
	$w				= 188;
}else{
	$column 			= 5;
	$box_layout_class	= "five";
	$w				= 100;
}

$box_counter = 0;

if(is_tax()) $args = array_merge( $wp_query->query, $args);
query_posts($args); 

if ( have_posts() ) : while ( have_posts() ) : the_post();

//get page and post counts
$page_count=get_page_count();  

//product options
$crop	= get_option('rttheme_product_image_crop');	 	// image crop
$h		= get_option('rttheme_product_image_height'); 	// image max height

?>

	<?php
	//box class
	if (fmod($box_counter,$column)==0) {
		$box_class="first";
	}elseif (fmod($box_counter,$column)==$column-1){
		$box_class="last";
	}else{
		$box_class="";
	}
	
	// Crop
	if($crop) $crop="true"; else $h=10000;	
 
   

	//values
	$title 		=	get_the_title();
	$thumb 		=	find_image_org_path(get_post_meta($post->ID, THEMESLUG.'product_image_url', true));
	$image 		=	@vt_resize( '', $thumb, $w, $h, ''.$crop.'' );
	$short_desc	=	get_post_meta($post->ID, THEMESLUG.'short_description', true);
	$permalink	= 	get_permalink();

	?>

	<!-- product -->
	<div class="box <?php echo $box_layout_class;?> <?php echo $box_class;?> portfolio">
			<?php if($thumb):?>
			<!-- product image -->
			<span class="frame block"><a href="<?php echo $permalink;?>" class="imgeffect link"><img src="<?php echo $image['url'];?>"  alt="" /></a></span>
			<?php endif;?>
			
			<div class="product_info">
			<!-- title-->
			<h5><a href="<?php echo $permalink;?>" title="<?php echo $title;?>"><?php echo $title;?></a></h5> 				
			<!-- text-->
			<?php echo (do_shortcode($short_desc));?>				
		</div>
	</div>
	<!-- / product -->


<?php
	//reset row
	$box_counter++;

	
	if(	(	fmod($box_counter,$column)==0		&&	$box_counter!=$page_count['post_count']	)	|| 	(	$box_counter==$page_count['post_count']	 &&	$page_count['page_count']>1	) )	{
		echo "<div class=\"bold_line\"></div>"; 
	}
?>

<?php endwhile?>

<?php
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
<?php endif; wp_reset_query();?>
	 