<?php
#-----------------------------------------
#	RT-Theme product_custom_fields.php
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
		"name"			=> "product_image_url",
		"title"			=> __("Product Image Url",'rt_theme_admin'),
		"description"		=> "",
		"type"			=> "upload",  
	),

	array(
		"name"			=> "short_description",
		"title"			=> __("Short Description",'rt_theme_admin'),
		"description"		=> __('Short description for product listing pages. If you want to show price info in the listing pages, you can use  this code in this field.','rt_theme_admin'),
		"type"			=> "textarea" 
	), 

	
	array(
		"name"			=> "other_images",
		"title"			=> __("Other images for this product",'rt_theme_admin'),
		"description"		=> __("You can put unlimited image for this product. Please put all the image urls line by line. All these images will be resize automaticly. Leave blank if you don't need to additional product images. ",'rt_theme_admin'),
		"type"			=> "textarea" 
	),
	
	array(
		"title"			 => __("Related Products",'rt_theme_admin'), 
		"type"			 => "heading"
	),
	array(
		"title" 			=> __("Select Related Products",'rt_theme_admin'), 
		"name"			=> "related_products[]",
		"options" 		=> RTTheme::rt_get_products(),
		"select" 			=> __("Select products",'rt_theme_admin'),
		"type" 			=> "selectmultiple"
	),


	//document tabs
	
	array(
		"title"			 => __("ATTACHED DOCUMENTS",'rt_theme_admin'), 
		"type"			 => "heading"
	),
	
	array(
		"name"			=> "pdf_file_url",
		"title"			=> __("Pdf File Url", 'rt_theme_admin'),
		"type"			=> "text" 
	),

	array(
		"name"			=> "word_file_url",
		"title"			=> __("Word File Url", 'rt_theme_admin'),
		"type"			=> "text" 
	),

	array(
		"name"			=> "excel_file_url",
		"title"			=> __("Excel File Url",'rt_theme_admin'), 
		"type"			=> "text" 
	),
	
	array(
		"name"			=> "chart_file_url",
		"title"			=> __("Chart File Url", 'rt_theme_admin'),
		"type"			=> "text" 
	),
	
	//free tabs
	
	array(
		"title"			 => __("FREE TABS",'rt_theme_admin'), 
		"type"			 => "heading"
	),		 

	array(
		"name"			=> "free_tab_1_title",
		"title"			=> __("#1 - Free Tab Name ", 'rt_theme_admin'),
		"type"			=> "text" 
	),
	
	array(
		"name"			=> "free_tab_1_content",
		"title"			=> __("#1 - Free Tab Content", 'rt_theme_admin'),
		"type"			=> "textarea" 
	),

	array(
		"title"			 => "", 
		"type"			 => "heading"
	),
	
	array(
		"name"			=> "free_tab_2_title",
		"title"			=> __("#2 - Free Tab Name", 'rt_theme_admin'),		
		"type"			=> "text" 
	),
	
	array(
		"name"			=> "free_tab_2_content",
		"title"			=> __("#2 - Free Tab Content", 'rt_theme_admin'),
		"type"			=> "textarea" 
	),

	array(
		"title"			 => "", 
		"type"			 => "heading"
	),	
	
	array(
		"name"			=> "free_tab_3_title",
		"title"			=> __("#3 - Free Tab Name", 'rt_theme_admin'),		
		"type"			=> "text" 
	),
	
	array(
		"name"			=> "free_tab_3_content",
		"title"			=> __("#3 - Free Tab Content", 'rt_theme_admin'),
		"type"			=> "textarea" 
	),

	//order button	
	
	array(
		"title"			 => __("Order Button",'rt_theme_admin'), 
		"type"			 => "heading"
	),
	
	array(
		"name"			=> "order_button",
		"title"			=> __("Order Button", 'rt_theme_admin'),
		"type"			=> "checkbox" 
	),
	
	array(
		"name"			=> "order_button_link",
		"title"			=> __("Order Button Link", 'rt_theme_admin'),
		"type"			=> "text" 
	),
	
	array(
		"name"			=> "order_button_text",
		"title"			=> __("Custom Order Button Text", 'rt_theme_admin'),
		"description"		=> __("Default value: order enquiry form →", 'rt_theme_admin'),
		"type"			=> "text" 
	),	

);

$settings  = array( 
	"name"		=> THEMENAME ." Product Options",
	"scope"		=> "products",
	"slug"		=> "product_custom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);

?>