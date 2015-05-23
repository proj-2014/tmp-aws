<?php if(!is_front_page() && ( get_option('rttheme_breadcrumb_menus') || get_option(THEMESLUG.'_show_search') )):?>
<div class="sub_page_top">
	
	<!-- breadcrumb menu -->
	<?php rt_breadcrumb(); ?>
	<!-- / breadcrumb menu -->
	
	<?php if(get_option(THEMESLUG.'_show_search')):?>
	<!-- search -->
	<div class="search-bar">
		<form action="<?php echo BLOGURL;?>" method="get" class="showtextback">
			<fieldset>
				<input type="image" src="<?php echo THEMEURI; ?>/images/pixel.gif" class="searchsubmit" alt="" />
				<input type="text" class="search_text showtextback" name="s" id="s" value="<?php _e('Search','rt_theme');?>" />							
			</fieldset>
		</form>
	</div>
	<!-- / search-->
	<?php endif;?>
	
	<div class="clear"></div>
	
</div>
<?php endif;?>	