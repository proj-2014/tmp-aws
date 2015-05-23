<?php
#-----------------------------------------
#	RT-Theme custom_styling.php
#-----------------------------------------

#
#   General Custom Styling
#

function rt_custom_styling(){

	echo '<style type="text/css">'; 

	#
	#   Top bar OFF
	#

	if(!get_option(THEMESLUG.'_top_bar')){
		echo '#wrapper{ background-position:center 0px!important; }';
	}

	#
	#   Custom Body Font Color
	#
	$rttheme_body_font_color=get_option('rttheme_body_font_color');
	if($rttheme_body_font_color){
		echo '	body {color:'.$rttheme_body_font_color.';}';
	}

	#
	#   Custom Body Font Size
	#
	$rttheme_body_font_size=get_option('rttheme_body_font_size');
	if($rttheme_body_font_size){
		echo '	body {font-size:'.$rttheme_body_font_size.'px;line-height:160%;}';
	}

	#
	#   Custom Body Font Family
	#
	$rttheme_body_font_family=get_option('rttheme_body_font_family');
	if($rttheme_body_font_family && !get_option(THEMESLUG.'_google_fonts')){
		echo '	body {font-family:'.$rttheme_body_font_family.';}';
	}

	#
	#   Custom Menu Font Size
	#
	$rttheme_menu_font_size=get_option('rttheme_menu_font_size');
	if($rttheme_menu_font_size){
		echo '	#navigation > ul > li > a {font-size:'.$rttheme_menu_font_size.'px;}';
	}

	#
	#   Custom Menu Font Color
	#
	$rttheme_menu_font_color=get_option('rttheme_menu_font_color'); // menu item color
	$rttheme_menu_font_color_hover=get_option('rttheme_menu_font_color_hover'); // menu item hover color
	$rttheme_menu_font_color_active=get_option('rttheme_menu_font_color_active'); // menu active item color

	if($rttheme_menu_font_color){// menu item color
		echo '#navigation, #navigation a,#navigation ul ul li.current-menu-item a{color:'.$rttheme_menu_font_color.';}';
	}

	if($rttheme_menu_font_color_active){// menu active item color
		echo '#navigation ul li.current_page_item a, #navigation ul li.current-menu-ancestor a, #navigation ul ul li a {color:'.$rttheme_menu_font_color_active.' !important;}';	
	}
		
	if($rttheme_menu_font_color_hover){// menu item hover color
		echo '#navigation a:hover, #navigation ul li.current_page_item a:hover {color:'.$rttheme_menu_font_color_hover.' !important;}';
	}
		

	#
	#   Custom Slider Height
	#
	$rttheme_slider_height=get_option('rttheme_slider_height');
	if($rttheme_slider_height){
		echo '#slider, #slider_area, .slide{ height:'.$rttheme_slider_height.'px !important; }';
	}

	#
	#   Custom Heading Sizes
	#
	for ($i = 1; $i <= 6; $i++) {
		$this_heading=get_option('rttheme_h'.$i.'_font_size');
		if($this_heading){
			echo 'h'.$i.'{ font-size:'.$this_heading.'px;line-height:140%; }';
		}
	}

	#
	#   Custom Content Box Font Size
	#
	$rttheme_box_title_font_size=get_option('rttheme_box_title_font_size');
	if($rttheme_menu_font_size){
		echo '.title h4{font-size:'.$rttheme_box_title_font_size.'px;line-height:140%;}';
	}


	#
	#   Custom Main Theme Color
	#
	$rttheme_custom_theme_color=get_option('rttheme_custom_theme_color');
	if($rttheme_custom_theme_color){
		echo 'body #container h1,body #container h2,body #container h3,body #container h4,body #container h5,body #container h6, body #container h1 a, body #container h2 a, body #container h3 a, body #container h4 a, body #container h5 a, body #container h6 a{color:'.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container .content h1 a:hover,body #container .content h2 a:hover,body #container .content h3 a:hover,body #container .content h4 a:hover,body #container .content h5 a:hover,body #container .content h6 a:hover{ background:'.$rttheme_custom_theme_color.';color:#fff !important;}';
		echo 'body #container  #slider .desc span.text a  { color:'.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container #slider .desc span.text a:hover, body #container  #slider .desc span.title a:hover{ color:#fff !important; background-color:'.$rttheme_custom_theme_color.'  !important;}';
		echo 'body #container #numbers a.activeSlide {background: '.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container .coda-nav ul li a.current {background: '.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container ::selection {background: '.$rttheme_custom_theme_color.';}';
		echo 'body #container ::-moz-selection {background: '.$rttheme_custom_theme_color.';}';
		echo 'body #container #footer  a:hover, body #container  .blog .date {color:'.$rttheme_custom_theme_color.'  !important;}';
		echo 'body #container  .widget .recent_posts .date{color:'.$rttheme_custom_theme_color.' !important;border:1px solid '.$rttheme_custom_theme_color.'  !important;}';
		echo 'body #container .sidebar_content .widget .recent_posts .date{background-color:'.$rttheme_custom_theme_color.'; border:0 !important; color:#fff !important;}';
		echo 'body #container  .sidebar_content h1,body #container  h2,body #container  .sidebar_content h3,body #container  .sidebar_content h4,body #container  .sidebar_content h5,body #container  .sidebar_content h6{ color:'.$rttheme_custom_theme_color.';}';
		echo 'body #container  .sidebar_content h1 a, body #container  .sidebar_content h2 a, body #container  .sidebar_content h3 a, body #container  .sidebar_content h4 a, body #container  .sidebar_content h5 a, body #container  .sidebar_content h6 a{ color:'.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container  .sidebar_content h1 a:hover,body #container  .sidebar_content h2 a:hover,body #container  .sidebar_content h3 a:hover,body #container  .sidebar_content h4 a:hover,body #container  .sidebar_content h5 a:hover,body #container  .sidebar_content h6 a:hover{ background:'.$rttheme_custom_theme_color.';color:#fff !important;}';		
		echo 'body #container  .content a:hover{ color:'.$rttheme_custom_theme_color.' !important;}';		
		echo 'body #container  .widget ul a:hover{color:'.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container  a.more_arrow{ color:'.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container  a.read_more:hover{ color:'.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container  .widget ul a:hover{ color:'.$rttheme_custom_theme_color.' !important;}';
		echo 'body #container .ppy-nav a:hover {background-color:'.$rttheme_custom_theme_color.';color:#fff !important;}';
		echo 'body #container .ppy-caption a {color:'.$rttheme_custom_theme_color.';}';
		echo 'body #container .ppy-text h5 a:hover {color:#fff !important;}';
		echo 'body #container .theme-default .nivo-caption .nivo-text a {color:'.$rttheme_custom_theme_color.'; background:transparent;}';
		echo 'body #container .theme-default .nivo-directionNav a { background-color:'.$rttheme_custom_theme_color.';color:#fff;}';
		echo 'body #container .theme-default .nivo-caption a:hover{ background-color:'.$rttheme_custom_theme_color.';color:#fff !important;}';
		echo 'body #container .theme-default .nivo-directionNav a:hover{ background-color:'.$rttheme_custom_theme_color.';color:#fff !important;opacity:0.5}';
		echo 'body #container .theme-default .nivo-caption .nivo-title a:hover{background-color:'.$rttheme_custom_theme_color.';color:#fff !important;}'; 	
		echo 'body #container .flex-control-paging li a.flex-active, body #container .flex-control-paging li a:hover{background-color:'.$rttheme_custom_theme_color.';}'; 	
	}


	#
	#   Custom Heading Colors
	#
	$rttheme_heading_color=get_option('rttheme_heading_color');
	if($rttheme_heading_color){
		echo 'body #container h1,body #container h2,body #container h3,body #container h4,body #container h5,body #container h6, body #container h1 a, body #container h2 a, body #container h3 a, body #container h4 a, body #container h5 a, body #container h6 a{color:'.$rttheme_heading_color.' !important;}';
		echo 'body #container .content h1 a:hover,body #container .content h2 a:hover,body #container .content h3 a:hover,body #container .content h4 a:hover,body #container .content h5 a:hover,body #container .content h6 a:hover{ background:'.$rttheme_heading_color.';color:#fff !important;}';
	}


	#
	#   Custom CSS Codes
	#
	echo get_option(THEMESLUG.'_custom_css'); 


	echo '</style>';

}

add_filter('wp_head','rt_custom_styling');

#
# Add specific CSS class by filter
#
add_filter('body_class','rt_body_class_name');

?>