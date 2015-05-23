<?php

$options = array (

			array(
					"name" => __("Logo",'rt_theme_admin'),
					"desc" => __("Please choose an image file or write url of your logo.",'rt_theme_admin'),
					"id" => THEMESLUG."_logo_url",
					"hr" => "true",
					"type" => "upload"),
			
			array(
					"name" => __("Custom Favicon",'rt_theme_admin'),
					"desc" => __("You can put url of a ico image that will represent your website's favicon (16px x 16px) ",'rt_theme_admin'),
					"id" => THEMESLUG."_favicon_url",
					"type" => "text"),	  
			
			array(
					"name" => __("RESPONSIVE LAYOUT",'rt_theme_admin'),  
					"id" => THEMESLUG."_responsive_design",
					"type" => "heading"),
			array(
					"name" => __("Responsive Layout Mode",'rt_theme_admin'),
					"id" => THEMESLUG."_responsive_design",
					"desc" => __('Turn ON the responsive design mode for mobile devices. ','rt_theme_admin'),	
					"type" => "checkbox",
					"default" => "checked"),  			

			array(
					"name" => __("WIDGETIZED PART OF HOME PAGE",'rt_theme_admin'),
					"type" => "heading"),
	 
			array(
					"name" => __("Layout",'rt_theme_admin'),
					"desc" => __("Select the layout of widgetized home page content area.",'rt_theme_admin'),
					"id" => THEMESLUG."_home_box_width",
					"options" =>  array(
								5 => "1/5", 
								4 => "1/4",
								3 => "1/3",
								2 => "1/2",
								1 => "1/1"
							  ),
					"default" => "2",
					"help"=> "true",
					"type" => "select"),

			
			array(
					"name" => __("BACKGROUND OPTIONS",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name" => __("Background Image",'rt_theme_admin'),
					"desc" => __('Please choose an image file or write url of an image you want use as a background image. Go to <a href="themes.php?page=custom-background">WordPress Background</a> page for more background options.','rt_theme_admin'),
					"id" => THEMESLUG."_background_image_url",
					"hr" => "true",
					"type" => "upload"),
			

			array(
					"name" => __("Randomized Background Images",'rt_theme_admin'),
					"desc" => __("To activate the random background images enter image urls line by line",'rt_theme_admin'),
					"id" => THEMESLUG."_background_image_urls",
					"help"=> "true",
					"type" => "textarea"),

			array(
					"name" => __("SUB PAGE TOP BAR",'rt_theme_admin'), 
					"type" => "heading"),
 
			array(
					"name" => __("Show Search",'rt_theme_admin'),
					"id" => THEMESLUG."_show_search",
					"desc" => __('Show search form field on top of the sub pages.','rt_theme_admin'),	
					"type" => "checkbox",
					"default" => "checked",
					"help"=> "true"),  
			
			array(
					"name" => __("BREADCRUMB MENU",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name" => __("Breadcrumb Menus",'rt_theme_admin'),
					"desc" => __("You can turn on/off bredcrumb menus",'rt_theme_admin'),
					"id" => THEMESLUG."_breadcrumb_menus",
					"hr" => "true",
					"default" => "checked",
					"type" => "checkbox"),

			array(
					"name" => __("Breadcrumb Menu Text",'rt_theme_admin'),
					"desc" => __("The text before the breadcrumb menu",'rt_theme_admin'),
					"id" => THEMESLUG."_breadcrumb_text",
					"default" => __("You are here:",'rt_theme_admin'), 
					"type" => "text"),
			
			array(
					"name" => __("FOOTER RELATED FIELDS",'rt_theme_admin'), 
					"type" => "heading"), 
			
			array(
					"name" => __("Footer Copyright Text",'rt_theme_admin'),
					"desc" => __("The copyright text area on right-sider footer",'rt_theme_admin'),
					"id" => THEMESLUG."_footer_copy",
					"default"	=> "Copyright &copy; 2011 Company Name, Inc.",
					"type" => "text"),
 
			array(
					"name" => __("GOOGLE ANALYTICS",'rt_theme_admin'), 
					"type" => "heading"), 
			
			array(
					"name" => __("Analytics Code",'rt_theme_admin'),
					"desc" => __("Paste your google analytics code",'rt_theme_admin'),
					"id" => THEMESLUG."_google_analytics",
					"type" => "textarea",				
					),
			array(
					"name"      => __("UPDATE NOTIFICATIONS",'rt_theme_admin'), 
					"type"      => "heading"
					),
			
			array(
					"name"      => __("Close Update Notifications",'rt_theme_admin'),
					"desc"      => __("Turn OFF this option if you don't want to be informed about theme updates.",'rt_theme_admin'),				
					"id"        => THEMESLUG."_update_notifications",
					"type"      => "checkbox",
					"default"	=> "on"
					),
			
			array(
					"name" => __("WPML PLUGIN",'rt_theme_admin'), 
					"type" => "heading"
					), 

			array(
					"name" => __("Show Flags",'rt_theme_admin'),
					"desc" => __("Show WPML plugin's language flags under the logo.",'rt_theme_admin'),				
					"id" => THEMESLUG."_show_flags",
					"default" => "checked",
					"type" => "checkbox",
					), 			


			array(
					"name"      => __("FREE CODE SPACES",'rt_theme_admin'), 
					"type"      => "heading"
					), 

			array(
					"name" 		=> __("Info",'rt_theme_admin'),
					"desc" 		=> __("You can place your codes by using the fields below. The input will not be formatted!" ,'rt_theme_admin'),
					"type" 		=> "info",
					),

			array(
					"name"      => __("Space for before &lt;/head&gt;",'rt_theme_admin'),
					"id"        => THEMESLUG."_space_for_head",
					"type"      => "textarea",				
					),

			array(
					"name"      => __("Space for before &lt;/body&gt;",'rt_theme_admin'),
					"id"        => THEMESLUG."_space_for_footer",
					"type"      => "textarea",
					"hr" 		=> "true"					
					),			
); 
?>