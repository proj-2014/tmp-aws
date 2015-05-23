<?php

$options = array (



			array(
					"name" => __("Select Blog Categories",'rt_theme_admin'),
					"id" => THEMESLUG."_blog_ex_cat[]",
					"options" =>  RTTheme::rt_get_categories(),
					"desc" => __("If you don't select any category the blog start page will display all categories.",'rt_theme_admin'),
					"hr"	=> true,
					"select" => __("Select",'rt_theme_admin'),
					"type" => "selectmultiple"),
			
			array(
					"name" => __("Select Your Blog Page",'rt_theme_admin'),
					"id" => THEMESLUG."_blog_page",
					"options" => RTTheme::rt_get_pages(),
					"select" => __("Select a page",'rt_theme_admin'),
					"hr"	=> true,
					"type" => "select"), 
			 
			array(
					"name" => __("Author info box under posts.",'rt_theme_admin'),
					"id" => THEMESLUG."_hide_author_info",
					"default" => "off",		
					"type" => "checkbox"), 

			array(
					"name" => __("FEATURED IMAGE",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name" => __("Featured Image Width",'rt_theme_admin'),
					"id" => THEMESLUG."_blog_image_width",
					"desc" => "The feautured images will be resize automatically. Set the max width value of the images.",
					"hr" => "true",
					"min"=>"100",
					"max"=>"650",
					"default"=>"492",
					"type" => "rangeinput"),

			array(
					"name" => __("Featured Image Heght",'rt_theme_admin'),
					"id" => THEMESLUG."_blog_image_height",
					"desc" => "As default the height value is not defined (0) and the image height will be automatically scaled. Set a max height value for the images.",
					"hr" => "true",
					"min"=>"0",
					"max"=>"500",
					"default"=>"0",
					"type" => "rangeinput"),			

			array(
					"name" => __("Crop Featured Images.",'rt_theme_admin'),
					"id" => THEMESLUG."_image_crop",
					"desc" => "If you turn on the crop feature, the image will be cropped as the width and the height values.",
					"default" => "",
					"hr"	=> true,
					"type" => "checkbox"), 
		 
); 
?>