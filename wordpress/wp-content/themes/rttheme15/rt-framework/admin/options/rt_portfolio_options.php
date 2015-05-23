<?php

$options = array (
			
			array(
					"name"	=> __("Select Your Portfolio Page",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_portf_page",
					"options" => RTTheme::rt_get_pages(),				
					"hr"		=> true,
					"select" 	=> __("Select a page",'rt_theme_admin'),
					"type" 	=> "select"
				),

			array(
					"name" 	=> __("Select Portfolio Start Category",'rt_theme_admin'),
					"desc"	=> __("If you don't select a category the product start page will display all products.",'rt_theme_admin'),
					"id"		=> THEMESLUG."_portf_start_cat",
					"options" => RTTheme::rt_get_portfolio_categories(),
					"select" 	=> __("Select a category",'rt_theme_admin'),
					"hr"		=> true,										
					"type" 	=> "select"
				), 
	
			array(
					"name" 	=> __("Portfolio Items on Start Page",'rt_theme_admin'),
					"desc" 	=> __("Turn Off this option if you don't want to show portfolio items on your portfolio start page.",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_portf_first_page_hide",
					"type" 	=> "checkbox",
					"hr"		=> true,
					"default"	=> "on",
					"std" 	=> "false"
				),

			array(
					"name" 	=> __("Amount of portfolio item per page",'rt_theme_admin'),
					"desc"	=> __("How many item do you want to display per page?",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_portf_pager",
					"min"	=> "1",
					"max"	=> "200",
					"default"	=> "9",
					"hr"		=> true,
					"type" 	=> "rangeinput"
				),
	
			array(
					"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
					"desc" 	=> __("sort your portfolio by this parameter",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_portf_list_orderby",
					"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
					"hr"		=> true,
					"default"	=> "date",
					"type" 	=> "select"
				),
	
			array(
					"name" 	=> __("Order",'rt_theme_admin'),
					"desc" 	=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_portf_list_order",
					"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
					"default"	=> "DESC",
					"hr"		=> true,					
					"type" 	=> "select"
				),
			
			array(
					"name" 	=> __("Crop Portfolio Images.",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_portfolio_image_crop",
					"desc" 	=> __("If you turn on the crop feature, the image will be cropped as the width and the height values.",'rt_theme_admin'),
					"default" => "on",
					"type" 	=> "checkbox"
				),

			array(
					"name" 	=> __("PERMALINKS",'rt_theme_admin'), 
					"type" 	=> "heading"),

			array(
					"name" 	=> __("Category Slug",'rt_theme_admin'),
					"desc" 	=> __("IMPORTANT! Bring your cursor over the help icon to read the detailed instructions ",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_portfolio_category_slug",
					"default"	=> "portfolios",
					"help" 	=> "true",
					"type" 	=> "text",
					"hr" 	=> "true"
				),

			array(
					"name" 	=> __("Single Portflio Slug",'rt_theme_admin'),
					"desc" 	=> __("IMPORTANT! Bring your cursor over the help icon to read the detailed instructions ",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_portfolio_single_slug",
					"help" 	=> "true",
					"default"	=> "portfolio",
					"type"	=> "text",
					"hr" 	=> "true"
				),
		); 
?>