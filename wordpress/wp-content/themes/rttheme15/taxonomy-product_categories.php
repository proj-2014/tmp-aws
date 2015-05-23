<?php
# 
# rt-theme product list
#

$taxonomy		= 'product_categories';
$term_slug	= get_query_var('term');
$term		= get_term_by( 'slug', $term_slug, $taxonomy, 'true', '' );
$term_id    	= $term->term_id;

get_header();
?>

<?php get_template_part( 'sub_page_header', 'sub_page_header_file' );?>
 
 	<!-- page title --> 
	<?php if(!is_front_page()):?>
		<div class="head_text"><h2><?php echo $term->name;?></h2></div>
	<?php endif;?>	
			
		<?php if($term->description):?>
		<!-- Category Description -->
			<div class="box full">
			<?php echo do_shortcode($term->description);?> 
			</div><div class="clear"></div>
		<?php endif;?>		

		<!-- Start Product Items -->
		<?php
			//page
			if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
			//taxonomy

			$args=array( 
				'post_status'=> 'publish',
				'orderby'=> get_option('rttheme_product_list_orderby'),
				'order'=> get_option('rttheme_product_list_order')
			);		
		?>
		<?php get_template_part( 'product_loop', 'product_categories');?>
		<!-- End Product Items -->
		 
    
<?php get_footer();?>