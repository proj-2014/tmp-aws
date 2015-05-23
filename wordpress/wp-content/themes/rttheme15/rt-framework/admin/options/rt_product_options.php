<?php

$options = array (
			
			array(
					"name"	=> __("Select Your Product List Page",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_list",
					"options" => RTTheme::rt_get_pages(),				
					"hr"		=> true,
					"select" 	=> __("Select a page",'rt_theme_admin'),
					"type" 	=> "select"
				),

			array(
					"name" 	=> __("Select Product Page Start Category",'rt_theme_admin'),
					"desc"	=> __("If you don't select a category the product start page will display all products.",'rt_theme_admin'),
					"id"		=> THEMESLUG."_product_start_cat",
					"options" => RTTheme::rt_get_product_categories(),
					"select" 	=> __("Select a category",'rt_theme_admin'),
					"hr"		=> true,
					"type" 	=> "select"
				), 

			array(
					"name" 	=> __("Amount of products per page",'rt_theme_admin'),
					"desc"	=> __("How many products do you want to display per page?",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_list_pager",
					"min"	=> "1",
					"max"	=> "200",
					"default"	=> "9",
					"hr"		=> true,
					"type" 	=> "rangeinput"
				),
	 
			array(
					"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
					"desc" 	=> __("sort the products by this parameter",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_list_orderby",
					"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),
					"default"	=> "date",
					"hr"		=> true,
					"type" 	=> "select"
				),
	
			array(
					"name" 	=> __("Order",'rt_theme_admin'),
					"desc" 	=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_list_order",
					"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
					"default"	=> "DESC",
					"hr"		=> true,
					"type" 	=> "select"
				),

			array(
					"name" 	=> __("Products on Start Page",'rt_theme_admin'),
					"desc" 	=> __("Check this box if you don't want to show products when clicked your products page on navigation bar.",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_products_first_page_hide",
					"type" 	=> "checkbox",
					"default"	=> "on",
					"std" 	=> "false"
				),

			array(
					"name" => __("PRODUCT IMAGES",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"name" 	=> __("Crop Product Images",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_image_crop",
					"default" => "on",
					"hr"		=> true,
					"type" 	=> "checkbox"
				),
			
			array(
				   "name" 	=> __("Maximum Image Heght",'rt_theme_admin'),
				   "id" 		=> THEMESLUG."_product_image_height",
				   "desc"		=> __('You can use this option if the "Crop Product Images" feature is on','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"400",
				   "default"	=>"120",
				   "type" 	=> "rangeinput"
				),
			
			array(
					"name" 	=> __("PERMALINKS",'rt_theme_admin'), 
					"type" 	=> "heading"
				),

			array(
					"name" 	=> __("Category Slug",'rt_theme_admin'),
					"desc" 	=> __("Change the slug for product categories",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_category_slug",
					"default"	=> "products",
					"help" 	=> "true",
					"type" 	=> "text",
					"hr" 	=> "true"
				),

			array(
					"name" 	=> __("Single Product Slug",'rt_theme_admin'),
					"desc" 	=> __("IMPORTANT! Bring your cursor over the help icon to read the detailed instructions ",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_single_slug",
					"help" 	=> "true",
					"default"	=> "product",
					"type" 	=> "text",
					"hr" 	=> "true"
				),

		); 
?>