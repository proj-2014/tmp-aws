<?php
$options = array (

			array(
				   "name" => __("Theme Style",'rt_theme_admin'),
				   "desc" => __("Please choose a style for your theme.",'rt_theme_admin'),
				   "id" => THEMESLUG."_style",
				   "options" =>	array(
									  "default-skin" => "Default",
									  "red-skin" => "Red",
									  "blue-skin" => "Blue",
									  "green-skin" => "Green",
							    ),
				   "default"=> "default-skin",
				   "hr" => "true",
				   "type" => "select"),

			array(
				   "name" => __("Remove Curves",'rt_theme_admin'),
				   "desc" => __("If you would like to remove curves from the theme design you can turn on this option.",'rt_theme_admin'),
				   "id" => THEMESLUG."_remove_curvs",
				   "hr" => "true",
				   "type" => "checkbox"),
			
			array(
				   "name" => __("Custom Theme Main Color",'rt_theme_admin'),
				   "desc" => __("Leave blank if you want to use default colors.",'rt_theme_admin'),
				   "id" => THEMESLUG."_custom_theme_color",
				   "hr" => "true", 
				   "type" => "colorpicker"),
			
			
			array(
				   "name" => __("Custom Heading Color",'rt_theme_admin'),
				   "desc" => __("Leave blank if you want to use default colors.",'rt_theme_admin'),
				   "id" => THEMESLUG."_heading_color",
				   "hr" => "true", 
				   "type" => "colorpicker"),

			array(
				   "name" => __("Body Font Color",'rt_theme_admin'),
				   "id" => THEMESLUG."_body_font_color",
				   "hr" => "true",
				   "default"=>"#5B5B5B", 
				   "dont_save"=>"true",
				   "type" => "colorpicker"),
 
			array(
				   "name" => __("Custom Menu Font Color",'rt_theme_admin'),
				   "id" => THEMESLUG."_menu_font_color",
				   "hr" => "true",
				   "type" => "colorpicker"),

			array(
				   "name" => __("Custom Menu Font Color (:hover states)",'rt_theme_admin'),
				   "id" => THEMESLUG."_menu_font_color_hover",
				   "hr" => "true",
				   "type" => "colorpicker"),

			array(
				   "name" => __("Custom Active Menu Item Font Color ",'rt_theme_admin'),
				   "id" => THEMESLUG."_menu_font_color_active", 
				   "type" => "colorpicker"),

			array(
					"name" 		=> __("MORE CUSTOMIZATION",'rt_theme_admin'), 
					"type" 		=> "heading"),	
			
			array(
					"name"      => __("Custom CSS Codes",'rt_theme_admin'),
					"desc"      => __("Paste your css codes. Do not include &lt;style&gt;&lt;/style&gt; tags or any html tag in this field.",'rt_theme_admin'),
					"id"        => THEMESLUG."_custom_css",
					"hr"        => "true", 
					"type"      => "textarea"),
		 
);

 
?>