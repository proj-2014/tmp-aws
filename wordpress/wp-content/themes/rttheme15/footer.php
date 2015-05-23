		<div class="clear"></div>
		</div>
		<?php if(!get_option(THEMESLUG.'_remove_curvs')):?><div class="content_bottom"></div><?php endif;?>
		</div>


<!-- sidebar -->
	<div id="sidebar">
	
	<?php if(!get_option(THEMESLUG.'_remove_curvs')):?><div class="sidebar_top"></div><?php endif;?>
	<div class="sidebar_content">
	
		<!-- logo -->
		<div id="logo">
			<?php if(get_option('rttheme_logo_url')):?>
				<a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><img src="<?php echo get_option('rttheme_logo_url'); ?>" alt="<?php echo bloginfo('name');?>" class="png" /></a>
			<?php else:?>
				<h1 class="cufon logo"><a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><?php echo bloginfo('name');?></a></h1>
			<?php endif;?>
		</div>
		<!-- /logo -->
		<div class="clear"></div>
		
		<?php
		 //WPML FLAGS
		if(get_option(THEMESLUG.'_show_flags')){
			if(function_exists('icl_get_languages')){
				echo '<div class="box flags">';
					languages_list();
				echo '</div><div class="clear"></div>';					
			}   
		}
		?>

		<?php if ( has_nav_menu( 'rt-theme-main-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>

			<!-- Navigation -->
			<?php            
			//call the main menu
			$menuVars = array(
				'menu_id'         => '',
				'menu_class'      => '',
				'echo'            => false,
				'container'       => 'div', 
				'container_class' => '', 
				'container_id'    => 'navigation',
				'theme_location'  => 'rt-theme-main-navigation' 
			);
			
			$main_menu=wp_nav_menu($menuVars);
			echo add_class_first_item($main_menu);
			?>
			<!-- / Navigation -->

		<?php else:?>

			<!-- Navigation -->
			<?php            
			//call the main menu
			$menuVars = array(
				'menu'            => 'RT Theme Main Navigation Menu',  
				'menu_id'         => '',
				'menu_class'      => '',
				'echo'            => false,
				'container'       => 'div', 
				'container_class' => '', 
				'container_id'    => 'navigation',
				'theme_location'  => 'rt-theme-main-navigation' 
			);
			
			$main_menu=wp_nav_menu($menuVars);
			echo add_class_first_item($main_menu);
			?>
			<!-- / Navigation -->

		<?php endif;?>

		<?php get_template_part( 'sidebar', 'sidebar_file' ); //sidebars ?>

		<?php
		//social media icons
		global $social_media_icons;
		$social_media_output ='';

		foreach ($social_media_icons as $key => $value){
			
			if($value=="email_icon"){//e-mail icon link 
				$link = 'mailto:'.str_replace("mailto:", "", get_option( THEMESLUG.'_'.$value ));
			}else{
				$link = get_option( THEMESLUG.'_'.$value );
			}
			
			//all icons
			if(get_option( THEMESLUG.'_'.$value )){
				$social_media_output .= '<li>';
				$social_media_output .= '<a href="'. $link .'" class="j_ttip" title="'.$key.'">';
				$social_media_output .= '<img src="'.THEMEURI.'/images/assets/social_media/icon-'.$value.'.png" alt="" />';
				$social_media_output .= '</a>';
				$social_media_output .= '</li>';
			}
		}
		if($social_media_output) echo '<div class="box"><ul class="social_media_icons">'.$social_media_output.'</ul></div>';
		?>			
		
	<div class="clear"></div>
	</div>
	<?php if(!get_option(THEMESLUG.'_remove_curvs')):?><div class="sidebar_bottom"></div><?php endif;?>
	</div>
			
	</div>
	<div class="clear"></div>

	<!-- footer --> 
	<div id="footer">

			<!-- footer links -->
			<?php if ( has_nav_menu( 'rt-theme-footer-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>				
				<?php 			    
				//call the footer menu
				$topmenuVars = array(
				    'depth'		 => 1,
				    'menu_id'         => '',
				    'menu_class'      => 'footer_links', 
				    'echo'            => false,
				    'container'       => '', 
				    'container_class' => '', 
				    'container_id'    => '',
				    'theme_location'  => 'rt-theme-footer-navigation' 
				);
				
				$footer_menu=wp_nav_menu($topmenuVars);
				echo add_class_first_item($footer_menu);
				?>
			<?php else:?> 
				<?php 			    
				//call the footer menu
				$topmenuVars = array(
				    'menu'            => 'RT Theme Footer Navigation Menu',
				    'depth'		  => 1,
				    'menu_id'         => '',
				    'menu_class'      => 'footer_links', 
				    'echo'            => false,
				    'container'       => '', 
				    'container_class' => '', 
				    'container_id'    => '',
				    'theme_location'  => 'rt-theme-footer-navigation' 
				);
				
				$footer_menu=wp_nav_menu($topmenuVars);
				echo add_class_first_item($footer_menu);
				?>
			<?php endif;?> 
			<!-- / footer links -->
				
			<!-- copyright text -->
			<div class="copyright"><?php echo wpml_t(THEMESLUG, 'Footer Copyright Text', get_option(THEMESLUG.'_footer_copy'));?></div>
			<!-- / copyright text -->			
	</div>
	<!-- / footer --> 
	
</div>
<!-- / background wrapper --> 

<?php echo get_option( THEMESLUG.'_google_analytics');?>
<?php echo get_option(THEMESLUG.'_space_for_footer');?>
<?php wp_footer();?>
</body>
</html>