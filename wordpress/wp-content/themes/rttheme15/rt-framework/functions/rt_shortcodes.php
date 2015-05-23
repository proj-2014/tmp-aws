<?php
/* RT-Theme Shortcodes */ 


/*using shortcodes in widgets*/

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

//shortcodes 



/*
* ------------------------------------------------- *
*		Widget Caller
* ------------------------------------------------- *
*/
function rt_widget_caller($atts, $content = null){
//[widget_caller id="sidebarid_37036"]

 	//defaults
	extract(shortcode_atts(array(  
		"id" => ''
	), $atts));
	
	ob_start();

    //check id
	if(!empty($id)){
	    dynamic_sidebar($id);
	}
	
	$output_string = ob_get_contents();
	ob_end_clean(); 

	return '<div class="clear"></div>'.$output_string.'<div class="clear"></div>';
 
}

add_shortcode('widget_caller', 'rt_widget_caller');

/*
* ------------------------------------------------- *
*		Fix shortcodes
* ------------------------------------------------- *
*/

function fixshortcode($content){
 
    //fix 
    //remove invalid p
    $content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	
    //fix line shortcode
    $content = preg_replace('#<p>\n<div class="line top #', '<div class="line top ', trim($content));
    $content = preg_replace('#<p>\n<div class="line"></div>\n</p>#', '<div class="line"></div>', trim($content)); 
    $content = preg_replace('#<p>\n<div class="line">#', '<div class="line">', trim($content));
    $content = preg_replace('#<p><div #', '<div ', trim($content));    
    $content = preg_replace('#</div></p> #', '</div>', trim($content));       

    $array = array (
	   '<p>[' => '[', 
	   ']</p>' => ']', 
	   ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content; 
}



/*
* ------------------------------------------------- *
*		TOOLTIP		
* ------------------------------------------------- *		
*/ 
function rt_tooltip( $atts, $content = null ) {

	//[tooltip text="" link="" target="" color="black"]content[/tooltip]
 
 	//defaults
	extract(shortcode_atts(array(  
		"text" 			=> '',
		"link"			=> '',
		"target" 			=> '',
		"color"			=> 'black'
	), $atts));
	
	
	if($color =="black") $class="j_ttip2";
	if($color =="white") $class="j_ttip";
	
	if($link)		$rt_tooltip	.= '<a href="'.$link.'" target="'.$target.'" class="'.$class.' ttip" title="'.$text.'" >';
	if(!$link)	$rt_tooltip	.= '<span class="'.$class.' ttip" title="'.$text.'" >';
	
	
	$content = preg_replace('#<br />#', '', trim($content));
	
	$rt_tooltip	.= do_shortcode(fixshortcode($content));
	
	
	
	if(!$link)	$rt_tooltip	.= '</span>';	
	if($link)		$rt_tooltip	.= '</a>';
	
	return $rt_tooltip;
}

add_shortcode('tooltip', 'rt_tooltip'); 



/*
* ------------------------------------------------- *
*		SCROLL SLIDER		
* ------------------------------------------------- *		
*/ 
function rt_scroll_slider( $atts, $content = null ) {
	//[scroll_slider]
	$rt_scroll_slider='<div class="scrollable_border"><div id="image_wrap" class="aligncenter"><img src="'.THEMEURI.'/images/pixel.gif" class="aligncenter" /></div><div class="clear"></div><a class="prev browse _left"></a><div class="scrollable"><div class="items big_image">';
	$rt_scroll_slider .= do_shortcode(strip_tags($content));
	$rt_scroll_slider.='</div></div><a class="next browse _right"></a></div><div class="clear"></div>';
	return $rt_scroll_slider;
}

function rt_scroll_slider_lines( $atts, $content = null ) {
	//[scroll_image][/scroll_image]

	$photo=trim($content);
 
	//thumb width and height
	$thumb_width = "137";
	$thumb_height = "90";

	//big image width and height
	$big_width = "578";
	$big_height = "10000";

	// Resize Thumbnail Image
	if($photo) $image = @vt_resize( '', find_image_org_path($photo), $thumb_width, $thumb_height, 'true' );

	// Resize Big Image
	if($photo) $big_image = @vt_resize( '', find_image_org_path($photo), $big_width, $big_height, 'true' );
	
	 
	$rt_scroll_slider_lines='<div>';
	$rt_scroll_slider_lines.='<img src="'. $image['url'] .'" data-gal="'. $big_image['url'] .'" />';
	$rt_scroll_slider_lines.='</div>'; 
	
	return $rt_scroll_slider_lines;
}	

add_shortcode('scroll_slider', 'rt_scroll_slider');
add_shortcode('scroll_image', 'rt_scroll_slider_lines');





/*
* ------------------------------------------------- *
*		PHOTO GALLERY		
* ------------------------------------------------- *		
*/ 
function rt_photo_gallery( $atts, $content = null ) {
	//[photo_gallery]
	$rt_photo_gallery='<div class="photo_gallery"><ul>';
	$rt_photo_gallery .= do_shortcode(strip_tags($content));
	$rt_photo_gallery.='</ul><div class="clear"></div></div>';
	return $rt_photo_gallery;
}

function rt_photo_gallery_lines( $atts, $content = null ) {
	//[image thumb_width="135" thumb_height="135" lightbox="true" custom_link="" title="photo title"]
	
	//defaults
	extract(shortcode_atts(array(  
		"thumb_width" 		=> '135',
		"thumb_height"		=> '135',
		"lightbox" 		=> 'true',
		"custom_link" 		=> '',
		"title"			=> '',
		"caption" 		=> '',
		"iframe" 			=> 'false',
	), $atts)); 
	
	$photo=trim($content);

	//icon
	if ($lightbox!="true" && !empty($custom_link)) {
		$icon="link";
	} else {
		$icon="plus";
	}
	
	//width and height
	if($thumb_width=="")  $thumb_width = "135";
	if($thumb_height=="") $thumb_height = "135";
	
	// Resize Portfolio Image
	if($content) $image = @vt_resize( '', find_image_org_path($photo), $thumb_width, $thumb_height, 'true' );
	
	//lightbox = default is true
	if($lightbox != "false" ){ $lightbox='rel="prettyPhoto[rt_photo_gallery]"'; } else { $lightbox="";}
	
	//link - default is image 
	if (!$custom_link) $custom_link=trim($content);


	//iframe
	if ($iframe=='true') $iframe= '?iframe=true&width=90%&height=90%';  else  $iframe = '';	 
	 
	$rt_photo_gallery_lines='<li>';
	$rt_photo_gallery_lines.='<span class="frame">';
	$rt_photo_gallery_lines.='<a href="'.$custom_link.''.$iframe.' " title="'.$title.'"  '.$lightbox.' class="imgeffect '.$icon.'">';
	$rt_photo_gallery_lines.='<img src="'. $image['url'] .'" alt="" />';
	$rt_photo_gallery_lines.='</a></span><span class="p_caption" style="width:'.$thumb_width.'px">'.$caption.'</span></li>'; 
	
	return $rt_photo_gallery_lines;
}	

add_shortcode('photo_gallery', 'rt_photo_gallery');
add_shortcode('image', 'rt_photo_gallery_lines');



/*
* ------------------------------------------------- *
*	Auto Thumbnails & Lightboxes	
* ------------------------------------------------- *		
*/ 
function rt_auto_thumb( $atts, $content = null ) {
	//[auto_thumb width="" height="" link="" lightbox="" align="" title="" alt="" iframe="" frame=""]
 
 	//defaults
	extract(shortcode_atts(array(  
		"width" 			=> '135',
		"height"			=> '135',
		"link" 			=> '',
		"lightbox" 		=> 'true',
		"align"			=> 'left',
		"title"			=> '',
		"alt"			=> '',
		"iframe"			=> 'false',
		"frame"			=> 'true',
		"crop"			=> 'true',
	), $atts));
	

	//width and height
	if($width=="")  $width = "135";
	if($height=="") $height = "135";
	
	//clear p and br tags
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	$content = preg_replace('#^<p>|<\/p>$#', '', trim($content));
	$content = preg_replace('#^<br />$#', '', trim($content));	
     
     
	//lightbox
	if($lightbox!="false") $lightbox='rel="prettyPhoto[rt_theme_thumb]"';
	
 	//if it's not a video
	if($link=="") $link=$content;
	
	/* icon */
	if (preg_match("/(png|jpg|gif)/",  trim($link) )) {
		$icon="plus";
	} elseif($lightbox=="false" && !empty($link)) {
		$icon="link";
	} else {
		$icon="play";
	}
    
     //frame
	if($frame=="true"){
        
		if($align=="left")		:  	$border_open='<span class="frame alignleft">';  				$border_close='</span>'; 		endif;
		if($align=="right")		: 	$border_open='<span class="frame alignright">';  				$border_close='</span>'; 		endif;
		if($align=="center")	:  	$border_open='<span class="aligncenter"><span class="frame">';  	$border_close='</span></span>'; 	endif;
	    
		$align="";
     }	 
	
	
	//iframe
	if ($iframe=='true') $iframe= '?iframe=true&width=90%&height=90%';  else  $iframe = '';	
	if (preg_match("/(mov|avi|swf|vimeo|youtube|screenr)/",  trim($link))): $iframe= ""; else: if($iframe && trim($link) ) $icon="link"; endif;
	
	
	//crop
	if($crop=="false") $height = 0;
	
	// Resize Portfolio Image
	if($content) $image = @vt_resize( '', trim(find_image_org_path($content)), $width, $height, $crop ); 
	
 
	//result
  
	if (trim($content)): 
	$rt_auto_thumb ='<a href="'.$link.''.$iframe.'" title="'.$title.'"  '.$lightbox.' class="imgeffect '.$icon.'"><img src="'.$image['url'].'" alt="'.$alt.'"  class="align'.$align.'" /></a>';	
	else:
	$rt_auto_thumb ='<a href="'.$link.''.$iframe.'" title="'.trim($atts["title"]).'"  '.$lightbox.' >'.trim($atts["title"]).'</a>';
	endif;
     $rt_auto_thumb = $border_open . $rt_auto_thumb . $border_close;
 
	
	return $rt_auto_thumb;
}

add_shortcode('auto_thumb', 'rt_auto_thumb'); 


/*
* ------------------------------------------------- *
*		Contact Form Pages
* ------------------------------------------------- *
*/
function rt_shortcode_contact_form( $atts, $content = null ) {

wp_enqueue_script('jquery-validate', THEMEURI  . '/js/jquery.validate.js', array('jquery') );
wp_enqueue_script('jqueryform', THEMEURI  . '/js/jquery.form.js', array('jquery') );	
 
 $contact_form = "";

if(isset($atts['title'])) $contact_form= '<div class="clear"></div><h3>'.$atts['title'].'</h3>';
if(isset($atts['text'])) $contact_form.= '<p><i>'.$atts['text'].'</i></p>';

if(isset($atts['email'])){


$contact_form.= "".    
	'<!-- contact form -->'.
	'<div class="clear"></div><div id="result"></div>'.
	'<div id="contact_form">'.
	'	<form action="'.get_bloginfo('template_directory').'/contact_form.php" name="contact_form" id="validate_form" method="post">'.
	'		<ul>'.
	'			<li><label for="name">'.__('Your Name: (*)','rt_theme').'</label><input id="name" type="text" name="name" value="" class="required" /> </li>'.
	'			<li><label for="email">'.__('Your Email: (*)','rt_theme').'</label><input id="email" type="text" name="email" value="" class="required email" /> </li>'.
	//'			<li><label for="phone">'.__('Phone Number:','rt_theme').'</label><input id="phone" type="text" name="phone" value="" class="required" /> </li>'.
	//'			<li><label for="company_name">'.__('Company Name:','rt_theme').'</label><input id="company_name" type="text" name="company_name" value="" /> </li>'.
	//'			<li><label for="company_url">'.__('Company URL:','rt_theme').'</label><input id="company_url" type="text" name="company_url" value="" /> </li>'.
	'			<li><label for="message">'.__('Your message (*)','rt_theme').'</label><textarea  id="message" name="message" rows="8" cols="40"	class="required"></textarea></li>'.
	'			<li>'.
	'			<input type="hidden" name="your_email" value="'.trim($atts['email']).'">'.
	'			<input type="hidden" name="your_web_site_name" value="'.get_bloginfo('name').'">'.
	
	'			<input type="hidden" name="text_1" value="'.__('Thanks','rt_theme').'">'.	
	'			<input type="hidden" name="text_2" value="'.__('Your email was successfully sent. We will be in touch soon.','rt_theme').'">'.	
	'			<input type="hidden" name="text_3" value="'.__('There was an error submitting the form.','rt_theme').'">'.	
	'			<input type="hidden" name="text_4" value="'.__('Please enter a valid email address!','rt_theme').'">'.
	
	'			<input type="submit" class="button" value="'.__('Send','rt_theme').'"  /><span class="loading"></span></li>'.
	'		</ul>'.
	'	</form>'.
	'</div><div class="clear"></div>'.
	'<!-- /contact form -->'; 
}else{
	$contact_form="ERROR: This shortcode is not contains an email attribute!";
}

return $contact_form;
}
add_shortcode('contact_form', 'rt_shortcode_contact_form');


/*
* ------------------------------------------------- *
*		Image Slider
* ------------------------------------------------- *
*/
    	


function rt_shortcode_slider( $atts, $content = null ) {
	//[slider][/slider]

	wp_enqueue_script('jquery-flexslider', THEMEURI  . '/js/jquery.flexslider-min.js', array('jquery') ); 
	wp_enqueue_style('jquery-flex-slider', THEMEURI . '/css/flexslider.css');

	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	
 	$content = wpautop(do_shortcode($content));
	$content = fixshortcode($content);
	
	return '<div class="frame slider"><div class="flexslider shortcode"><ul class="slides">' . trim($content) . '</ul> </div></div>';
}

function rt_shortcode_slider_slides( $atts, $content = null ) {
 	//[slide image_width="" image_height="" link="" alt_text="" auto_resize=""]

	//defaults
	extract(shortcode_atts(array(  
       "image_width" => '628',
	   "image_height" => '300',
	   "link" => '',
	   "alt_text" => '',
	   "auto_resize" => 'true'	   
	), $atts));

	//width and height
	if($image_width=="")  $image_width = "628";
	if($image_height=="") $image_height = "300";

	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));		
 
	if($link){
		$link1='<a href="'.$link.'">';
		$link2='</a>';
	}
		
	$slide='<li>';	
	
	// Resize Portfolio Image
	if($content) $image = @vt_resize( '', find_image_org_path($content), $image_width, $image_height, 'true' );

	if($auto_resize=="true"){
	$slide.=$link1.'<img src="'.$image['url'].'" alt="'.$alt_text.'" />'.$link2;
	}else{
	$slide.=$link1.'<img src="'.trim($content).'"  alt="'.$alt_text.'" />'.$link2;
	}
 
	$slide.='</li>';
	
	return $slide;
}


add_shortcode('slider', 'rt_shortcode_slider');
add_shortcode('slide', 'rt_shortcode_slider_slides');
 

/*
* ------------------------------------------------- *
*		Tabular Content
* ------------------------------------------------- *
*/

function rt_shortcode_tabs( $atts, $content = null ) {
	//[tabs tab1="" tab2="" tab3=""][/tabs]
 
 
    $content = do_shortcode(fixshortcode($content));  

	$tabs = ""; 
	for($i=1;$i<10;$i++){
	    $tab_name = isset($atts['tab'.$i]) ? $atts['tab'.$i] : "";
	    if($tab_name){
		   $tabs .=   '<li><a href="#">'.$tab_name.'</a></li>';
	    }
	}    

	return '<div class="box full"><div class="taps_wrap"><ul class="tabs">'.$tabs.'</ul>'.apply_filters('the_content',$content).'</div></div>';
}

function rt_shortcode_tab( $atts, $content = null ) {
	//[tab][/tab]
 
     $content = do_shortcode(fixshortcode($content)); 

	return ' <div class="pane">' . $content . '</div>';
}

add_shortcode('tabs', 'rt_shortcode_tabs');
add_shortcode('tab', 'rt_shortcode_tab');



/*
* ------------------------------------------------- *
*		Accordions
* ------------------------------------------------- *
*/

function rt_shortcode_accordion( $atts, $content = null ) {
    //[accordion align=""][/accordion]

	//defaults
	extract(shortcode_atts(array(   
		"align" => '',
		"first_one_open" => 'true', 
	), $atts));

 	//align
    if($align) $align =  'small _'.$align;

    //first one open
	$initialIndex = ($first_one_open == "true") ? "" : $initialIndex = ", initialIndex: null";
   
    //fix shortcode
    $content = do_shortcode(fixshortcode($content)); 

    //accordion random ID
    $accordion_sliderID ='accordion_random_'.rand(1000, 1000000); 

    //accordion holder
    $accordionholder = '
	    <script type="text/javascript">
		/* <![CDATA[ */
			 jQuery(document).ready(function(){  
		     	jQuery("#'.$accordion_sliderID.'").tabs(".pane", {tabs: \'.title\', effect: \'slide\' '.$initialIndex.' });
			 });
	    /* ]]> */	
	    </script>	
    '; 

    $accordionholder .= '<div id="'.$accordion_sliderID.'" class="accordion '.$align.'">'.apply_filters('the_content',$content).'</div>';

    return $accordionholder;
}

function rt_shortcode_accordion_panel( $atts, $content = null ) {
	//[pane title=""][/pane]
    
    $pane_title=$atts['title'];
	
    $content = do_shortcode(fixshortcode($content)); 

    return '<div class="title"><span>'.$pane_title.'</span></div><div class="pane">' . $content . '<div class="clear"></div></div>';
}

add_shortcode('accordion', 'rt_shortcode_accordion');
add_shortcode('pane', 'rt_shortcode_accordion_panel');



/*
* ------------------------------------------------- *
*		Products Slider
* ------------------------------------------------- *
*/

function rt_shortcode_products_slider( $atts, $content = null ) {
    global $post;
    //[product_slider ids="1,2,3" slider=""]

	wp_enqueue_script('jquery-coda-slider', THEMEURI  . '/js/jquery.coda-slider-2.0.js', array('jquery') ); 	    
	wp_enqueue_style('jquery-coda-slider', THEMEURI . '/css/coda-slider-2.0.css'); 	

	//defaults
	extract(shortcode_atts(array(  
        "ids" => '',
	   "slider" => 'true',
	   "categories"=>"",
	   "columns"  => 4
	), $atts));	 
	
    $products_slider ="";
    
    //fix column value
    if($columns>5 || $columns<2 || !is_numeric(trim($columns))) $columns = 4; 
    
    //pre-defined layout values
    $layout_values =   array(
					"5" => array (
								"name" => "five",
								"w" => 96,
								"h" => 100,				
							),
					"4" => array (
								"name" => "four",
								"w" => 129,
								"h" => 120,
							),
					 "3" => array (
								"name" => "three",
								"w" => 184,
								"h" => 140,
							),
					 "2" => array (
								"name" => "two",
								"w" => 294,
								"h" => 160,	
							)
					);
    
    //selected column values
    $selected_column_values = $layout_values[$columns];	
    
    //product id numbders
    $ids = trim($ids) ? explode(",",trim($ids)) : array();

    //product category slugs
    $categoriesArray = trim($categories) ? explode(",",trim($categories)) : array();

    //Product sliderID 
    $product_sliderID ='product_slider_'.rand(1000, 1000000); 
   
    //fix shortcode
    $content = wpautop(do_shortcode($content));	
    $content = fixshortcode($content);
    $content = preg_replace('#<br \/>#', "",trim($content));
    $content = preg_replace('#<p>#', "",trim($content));
    $content = preg_replace('#<\/p>#', "",trim($content));
     
    $slideCounter = 1;
    
    if($ids){ //ids provided
    $queryProducts   = new WP_Query(array(  'post_type'=> 'products', 'post_status'=> 'publish' ,  'post__in'  => $ids, 'showposts' => 1000 ));
    }else{ //product slugs provided    
    $queryProducts   = new WP_Query(array(  'post_type'=> 'products', 'post_status'=> 'publish' ,   'showposts' => 1000,				 
								    'tax_query' => array( 
										array(
											'taxonomy' =>	'product_categories',
											'field'    =>	'slug',
											'terms'    =>	 $categoriesArray,
											'operator' => 	"IN"
										)
									),								    
								  ));    
    }
    
    if($slider=="true") $products_slider .= '<div class="coda-slider-wrapper"><div id="'.$product_sliderID.'" class="product_slider coda-slider preload">';
 
    if ($queryProducts->have_posts()) : while ($queryProducts->have_posts()) : $queryProducts->the_post();

	   //values
	   $title 		=	get_the_title();
	   $thumb 		=	(get_post_meta($post->ID, THEMESLUG.'product_image_url', true));
	   $image 		=	@vt_resize( '', $thumb, $selected_column_values["w"], $selected_column_values["h"], 'true');
	   $short_desc		=	get_post_meta($post->ID, THEMESLUG.'short_description', true);
	   $permalink		= 	get_permalink();
	   
	   $class = "";
	   if(fmod($slideCounter,$columns)==0)   $class =  "last" ;
	   if(fmod($slideCounter,$columns)==1)   $class =  "first" ;
    	   
	   
	   if(fmod($slideCounter,$columns)==1 && $slider=="true")  $products_slider .=  '<div class="panel"><div class="panel-wrapper">';
	   
	   $products_slider .= '<div class="box portfolio '.$selected_column_values["name"].' '.$class.'">';
				    if($thumb){
					   $products_slider .='
					   <!-- product image -->
					   <span class="frame block"><a href="'. $permalink.'" class="imgeffect link"><img src="'.$image['url'].'"  alt="" /></a></span>
					   ';
				    }
				$products_slider .='		  
				  <div class="product_info">
				  <!-- title-->
				  <h5><a href="'.$permalink.'" title="'.$title.'">'.$title.'</a></h5> 				
				  <!-- text-->
				  '. (do_shortcode($short_desc)).'				
				 </div>
		  </div>
		  <!-- / product -->
	   ';
	   if( (	fmod($slideCounter,$columns)==0 || $queryProducts->post_count == $slideCounter )  && $slider=="true")  $products_slider .=  '</div></div>';
	   if( (	fmod($slideCounter,$columns)==0 || $queryProducts->post_count == $slideCounter )  && $slider=="false")  $products_slider .=  '<div class="clear"></div>';
    
    $slideCounter++;
    endwhile;endif;
    
    if($slider=="true") $products_slider .=  '</div></div>';

    if($slider=="true"){
    $dynamicTabs = ($slideCounter>($columns+1)) ? "true" : "false";    
    $products_slider .= "
	    <script type=\"text/javascript\">
		/* <![CDATA[ */
			 // Product Slider
			 jQuery(window).load(function(){  
			   jQuery('#".$product_sliderID."').codaSlider({
				crossLinking: false,
				dynamicArrows: false,
				dynamicTabs:".$dynamicTabs.",
				autoSlide:true,
				autoSlideInterval: 5000,
				dynamicTabsPosition: \"bottom\",
				dynamicTabsAlign: \"right\"
			   }); 
			 });
	    /* ]]> */	
	    </script>	
    ";
    }
    
    return $products_slider;

}
add_shortcode('product_slider', 'rt_shortcode_products_slider'); 

/*
* ------------------------------------------------- *
*		show shortcode 
* ------------------------------------------------- *
*/

function rt_shortcode_show_shortcode( $atts, $content = null ) {
 
	//convert html [] spacial chars  

	//fix shortcode
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	$content = preg_replace('#\[\/braket_close\]#', "[/show_shortcode]",trim($content));
	
	return '<code>' . htmlspecialchars($content) . '</code>';
}

add_shortcode('show_shortcode', 'rt_shortcode_show_shortcode');


?>