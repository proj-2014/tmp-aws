<?php
$options = array (

		array(
				   "name" => __("Select Home Page Slider",'rt_theme_admin'),
				   "desc" => __("Please select a slider script for your home page. Select a \"Responsive Slider\" slider, if you have turned ON the \"Responsive Layout\" mode via General Options",'rt_theme_admin'),
				   "id" => THEMESLUG."_home_slider_script",
				   "options" =>	array(
				   				""	=>	    "Select a Slider Script", 
				   				"flex"	=>	    "Flex Slider  (Responsive Slider)", 
								"nivo"	=>	    "Nivo Slider (Responsive Slider)", 												   				
								"cycle"	=>	    "Cycle Slider (Non-Responsive Slider)",
							    ),
				   "default"=>"flex",
				   "hr" => "true",
				   "type" => "select"),
		

			array(
				   "name" => __("Transition Timeout (seconds)",'rt_theme_admin'),
				   "id" => THEMESLUG."_slider_timeout",
				   "hr" => "true",
				   "min"=>"1",
				   "max"=>"120",
				   "default"=>"8",
				   "type" => "rangeinput"),


			array(
				   "name" => __("Slider Height (px)",'rt_theme_admin'),
				   "id" => THEMESLUG."_slider_height",
				   "hr" => "true",
				   "min"=>"100",
				   "max"=>"1000",
				   "default"=>"300",
				   "type" => "rangeinput"),

			
			array(
				   "name" => __("Turn On/Off Slider",'rt_theme_admin'),
				   "desc" => __("You can turn on/off the home page slider",'rt_theme_admin'),
				   "id" => THEMESLUG."_slider_active",
				   "default" => "checked",
				   "type" => "checkbox"),         				

			array(
					"name" 	=> __("OPTIONS JUST FOR THE FLEX SLIDER",'rt_theme_admin'), 
					"type" 	=> "heading"),
			array(
				   "name" => __("Transition Effect",'rt_theme_admin'),
				   "desc" => __("Please choose an effect for main page slider",'rt_theme_admin'),
				   "id" => THEMESLUG."_flex_slider_effect",
				   "options" =>	array(
								"slide"	=>	    "slide",
								"fade"	=>	    "fade", 
							    ),
				   "default"=>"slide", 
				   "type" => "select"),


			array(
					"name" 	=> __("OPTIONS JUST FOR THE NIVO SLIDER",'rt_theme_admin'), 
					"type" 	=> "heading"),
			array(
				   "name" => __("Transition Effect",'rt_theme_admin'),
				   "desc" => __("Please choose an effect for main page slider",'rt_theme_admin'),
				   "id" => THEMESLUG."_nivo_slider_effect",
				   "options" =>	array( 
								"random" =>	"random", 								
								"sliceDown"	=> "sliceDown", 		
								"sliceDownLeft"	=> "sliceDownLeft", 		
								"sliceUp" => "sliceUp", 		
								"sliceUpLeft" => "sliceUpLeft", 		
								"sliceUpDown" => "sliceUpDown", 		
								"sliceUpDownLeft" => "sliceUpDownLeft", 		
								"fold" => "fold", 		
								"fade" => "fade", 		 
								"slideInRight" => "slideInRight", 		
								"slideInLeft" => "slideInLeft", 		
								"boxRandom" => "boxRandom", 		
								"boxRain" => "boxRain", 		
								"boxRainReverse" => "boxRainReverse", 		
								"boxRainGrow" => "boxRainGrow", 		
								"boxRainGrowReverse" => "boxRainGrowReverse"
							    ),
				   "default"=>"random", 
				   "type" => "select"),


			array(
					"name" 	=> __("OPTIONS JUST FOR THE CYCLE SLIDER",'rt_theme_admin'), 
					"type" 	=> "heading"),
			array(
				   "name" => __("Transition Effect",'rt_theme_admin'),
				   "desc" => __("Please choose an effect for main page slider",'rt_theme_admin'),
				   "id" => THEMESLUG."_slider_effect",
				   "options" =>	array(
								"blindX"	=>	    "blindX",
								"blindY"	=>	    "blindY",
								"blindZ"	=>	    "blindZ",
								"cover"	=>	    "cover",
								"fade"	=>	    "fade",
								"none"	=>	    "none",
								"scrollUp"	=>	    "scrollUp",
								"scrollDown"	=>	    "scrollDown",
								"scrollLeft"	=>	    "scrollLeft",
								"scrollRight"	=>	    "scrollRight",
								"scrollHorz"	=>	    "scrollHorz",
								"scrollVert"	=>	    "scrollVert",
								"slideX"	=>	    "slideX",
								"slideY"	=>	    "slideY",
								"turnUp"	=>	    "turnUp",
								"turnDown"	=>	    "turnDown",
								"turnLeft"	=>	    "turnLeft",
								"turnRight"	=>	    "turnRight"
							    ),
				   "default"=>"fade",
				   "hr" => "true",
				   "type" => "select"),


			array(
				   "name" => __("Slider Buttons",'rt_theme_admin'),
				   "desc" => __("You can turn on/off the paging buttons of the slider",'rt_theme_admin'),
				   "id" => THEMESLUG."_slider_buttons",
				   "hr" => "true",
				   "default" => "checked",
				   "type" => "checkbox"),			
		
		
); 
?>