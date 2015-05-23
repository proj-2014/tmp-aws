<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>  
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php 
global $responsive_design;
if ($responsive_design):?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, text-size=normal" />
<?php endif;?>
 
<?php if (get_option( 'rttheme_favicon_url')):?><link rel="icon" type="image/png" href="<?php echo get_option( 'rttheme_favicon_url');?>"><?php endif;?>

<title><?php if (is_home() || is_front_page() ): bloginfo('name'); else: wp_title('');endif; ?></title>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); //thread comments?>		  
<?php echo get_option(THEMESLUG.'_space_for_head');?>
<?php wp_head(); ?> 
</head>
<body <?php body_class(); ?>>

<!-- background wrapper -->
<div id="container">

	
	<?php 
	#
	#  100% Backgrounds
	#

	// Check Wordpress Background
	$background 		= get_background_image();
	$background_color 	= get_background_color();

	//if wordpress background tool not used
	if(!$background):
	?>
		<!-- background image -->
		<div class="background_pic_border">
		<div class="background_pic_holder">
			
			<?php
			$background_image= get_option( THEMESLUG.'_background_image_url' );
			$randomized_banckground_images =  trim(get_option( THEMESLUG.'_background_image_urls'));
			
			//Static 100% Bakcround
			if($background_image && !$randomized_banckground_images){
				echo '<img src="'.$background_image.'" width="100%" alt="" />';	
			}
	
			//Randomized 100% Backgrounds
			if($randomized_banckground_images){
			    $random_background = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $randomized_banckground_images)); 
			    $images=explode("\n",  $random_background);    
			    $random_number = rand(0, count($images)-1);    
			    echo '<img src="'.$images[$random_number].'" width="100%" alt="" />'; 
			}
	
			?></div>
		
			<?php if(!get_option(THEMESLUG.'_remove_curvs')):?>
				<div class="back-curv"></div>
			<?php else:?>
				<div class="back-line"></div>
			<?php endif;?>
		
		</div>
	<?php endif;?>
	
	<!-- wrapper -->
	<div id="wrapper">	

	<?php if ($responsive_design):?>
	<div id="mobile_header">
		<!-- logo -->
		<div id="mobile_logo">
			<?php if(get_option('rttheme_logo_url')):?>
				<a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><img src="<?php echo get_option('rttheme_logo_url'); ?>" alt="<?php echo bloginfo('name');?>" class="png" /></a>
			<?php else:?>
				<h1 class="cufon logo"><a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><?php echo bloginfo('name');?></a></h1>
			<?php endif;?>
		</div>
		<!-- /logo --> 

 		<?php if ( has_nav_menu( 'rt-theme-main-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>	  
			<!-- Mobile Menu --> 
			<?php            
			//call the main menu once again for mobile navigation
			$MobilemenuVars = array(
				'menu_id'         => "MobileMainNavigation", 
				'echo'            => false,
				'container'       => 'div', 
				'container_class' => '', 
				'container_id'    => 'MobileMainNavigation-Background', 
				'theme_location'  => 'rt-theme-main-navigation', 
				'dropdown_title'  => __('-- Main Menu --',"rt_theme"), 
				'indent_string'   => '- ', 
				'indent_after'    => '' 
			);
			
			$mobile_menu=dropdown_menu($MobilemenuVars);
			echo ($mobile_menu);
			?>
			<!-- / Mobile Menu -->    
		<?php else:?>  
			<!-- Mobile Menu --> 
			<?php            
			//call the main menu once again for mobile navigation
			$MobilemenuVars = array(
				'menu'            => 'RT Theme Main Navigation Menu',  
				'menu_id'         => "MobileMainNavigation", 
				'echo'            => false,
				'container'       => 'div', 
				'container_class' => '', 
				'container_id'    => 'MobileMainNavigation-Background', 
				'theme_location'  => 'rt-theme-main-navigation', 
				'dropdown_title'  => __('-- Main Menu --',"rt_theme"), 
				'indent_string'   => '- ', 
				'indent_after'    => '' 
			);
			
			$mobile_menu=dropdown_menu($MobilemenuVars);
			echo ($mobile_menu);
			?>
			<!-- / Mobile Menu -->    
		<?php endif;?>	
	</div>
	<?php endif;?>

	<!-- content -->
	<div id="content">

		<?php if(	(( get_option(THEMESLUG."_slider_active") && is_front_page()) || is_front_page() ) && (!get_option(THEMESLUG.'_remove_curvs')) ) echo '<div class="slider_cover"></div>';  ?>
		<div class="content_top <?php if(get_option(THEMESLUG.'_remove_curvs') && !is_front_page()):?>no_curv<?php endif;?> <?php if(get_option(THEMESLUG.'_remove_curvs') && is_front_page()):?>no_curv_home<?php endif;?> "></div>
		<div class="content"> 
			