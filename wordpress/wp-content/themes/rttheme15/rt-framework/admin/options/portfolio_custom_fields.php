<?php
#-----------------------------------------
#	RT-Theme portfolio_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Portfolio Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(

				array(
					"name" 			=> "_layout_options",
					"title" 			=> __("Layout Options",'rt_theme_admin'),
					"description"		=> __("default is 1:4",'rt_theme_admin'),
					"options" 		=>  array(
										//1 => "1:1 - ".__('Full Width',THEMESLUG)."",                          
										2 => "1:2",
										3 => "1:3",
										4 => "1:4",
										5 => "1:5",
									),
					"select"			=> "Select a layout",
					"type" 			=> "select"
				),


				array(
					"title"			 => "", 
					"type"			 => "heading"
				),

				array(
					"name"			=> "_portfolio_image",
					"title"			=> __("Portfolio Image",'rt_theme_admin'),
					"description"		=> __("Upload an image or type the url of an image which has been uploaded by the media uploder.",'rt_theme_admin'),					
					"type"			=> "upload",
				),

				array(
					"title"			 => __("OR",'rt_theme_admin'), 
					"type"			 => "heading"
				),			


				array(
					"name"			=> "_portfolio_video",
					"title"			=> __("Portfolio Video",'rt_theme_admin'),
					"description"		=> __("Paste the url of a video from vimeo or youtube",'rt_theme_admin'),					
					"type"			=> "text",
					"hr"				=> "true",
				),

	
				array(
					"name"			=> "_portfolio_thumb_image",
					"title"			=> __("Alternate thumbnail image for the portfolio item",'rt_theme_admin'),
					"description"		=> __("If you want to use another image file for the thumbnails, you use this field.",'rt_theme_admin'),
					"type"			=> "upload",					
					"hr"				=> "true",
				),

				array(
					"name"			=> "_portfolio_desc",
					"title"			=> __("Short description for portfolio posts",'rt_theme_admin'),
					"description"		=> "",
					"type"			=> "textarea",					
					"hr"				=> "true",
				),
	
				array(
					"name"			=> "_portf_no_detail",
					"title"			=> __("Remove links to post details",'rt_theme_admin'),
					"description"		=> "",
					"type"			=> "checkbox",
				)
);

$settings  = array( 
	"name"		=> THEMENAME ." Portfolio Options",
	"scope"		=> "portfolio",
	"slug"		=> "portfolio_cutom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);