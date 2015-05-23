<?php
#-----------------------------------------
#	RT-Theme home_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Home Page Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(


			array( 
                    "name" => "layout_options",
                    "title"			=> __("Layout Options",'rt_theme_admin'), 
				"options" =>  array(
                                    2 => "1:2",
                                    3 => "1:3",
                                    4 => "1:4",
                                    5 => "1:5",
                                    7 => "2:3",
                                    8 => "3:4",
                                    9 => "4:5",
                                    6 => "1:1 - Full Width",                             
                                ), 
				"type" => "select"  
			),

			array(
				"name"			=> "custom_link", 
				"title"			=> __("Custom Link",'rt_theme_admin'),
				"type"			=> "text" 
			),

			array(
				"name"			=> "custom_link_text",
				"title"			=> __("Custom Link Text",'rt_theme_admin'),
                    "description"		=> "ex: read more",
				"type"			=> "text" 
			),

			array(
					"title" => __("FEATURED IMAGE",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"title" 	=> __("Crop Featured Image",'rt_theme_admin'),
					"name" 	=> "homepage_image_crop",
					"default" => "",
					"hr"		=> true,
					"type" 	=> "checkbox"
				),
			
			array(
				   "title" 	=> __("Maximum Image Heght",'rt_theme_admin'),
				   "name" 	=> "homepage_image_height",
				   "description"		=> __('You can use this option if the "Crop Featured Image" feature is on','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"400",
				   "default"	=>"120",
				   "type" 	=> "rangeinput"
				),			
			  
);

$settings  = array( 
	"name"		=> THEMENAME ." Home Page Options",
	"scope"		=> "home_page",
	"slug"		=> "rt_home_custom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);