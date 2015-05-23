<?php
#-----------------------------------------
#	RT-Theme theme_functions.php
#	version: 1.0
#-----------------------------------------

#
# Add Class WP Menu - adds class for the first menu item
#
 
function add_class_first_item($menu){
	
	$find="\"><a ";
	$replace=" first\"><a ";
	return preg_replace('/'.$find.'/', $replace, $menu, 1); 
}


#
# Remove more link in excerpts 
#

function no_excerpt_more($more) {
	return '.. ';
}

#
# Get page count
#

function get_page_count(){
    global $wp_query;	
    $count=array('page_count'=>$wp_query->max_num_pages,'post_count'=>$wp_query->post_count);
    return $count;
}


#
# Pagination
#

function get_pagination($range = 7){
	global $paged, $wp_query;
	
	$max_page = $wp_query->max_num_pages;
	 
	if($max_page > 1){
	if(!$paged){
	  $paged = 1;
	}

	if ($paged > 1){
		echo "<li class=\"arrowleft\">";
		    previous_posts_link('&nbsp;');
		echo "</li>\n";
	}
	if($max_page > $range){
	if($paged < $range){
	  for($i = 1; $i <= ($range + 1); $i++){
		echo "<li";
		if($i==$paged) echo " class='active'";
		echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
		echo "</li>\n";
	  }
	}
	elseif($paged >= ($max_page - ceil(($range/2)))){
	  for($i = $max_page - $range; $i <= $max_page; $i++){
		echo "<li";
		if($i==$paged) echo " class='active'";
		echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
		echo "</li>\n";
	  }
	}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
	  for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
	    echo "<li";
	    if($i==$paged) echo " class='active'";
	    echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
	    echo "</li>\n";
	  }
	}
	}
	else{
	for($i = 1; $i <= $max_page; $i++){
	    echo "<li";
	    if($i==$paged) echo " class=\"active\" ";
	    echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
	    echo "</li>\n";
	}
	}
	if ($paged != $max_page){
	    echo "<li class=\"arrowright\">";
	    next_posts_link('&nbsp;');
	    echo "</li>\n";
	}
	
	}
}


#
# checks page reserved for blog product or portfolio
# 

if( ! function_exists("is_theme_page") ){
	function is_theme_page(){
		global $post; 
		
		$post_id = is_object( $post ) ? wpml_page_id( $post->ID ) : "";

		if( ! empty( $post_id )){	
			if( $post_id != BLOGPAGE && $post_id != PRODUCTPAGE && $post_id != PORTFOLIOPAGE ){
			   return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	} 
}


#
# checks theme parts that reserved for blog
# 
if( ! function_exists("is_blog_page") ){
	function is_blog_page(){

		global $taxonomy, $post_type, $post, $templateID; 
	 
		$post_id = is_object( $post ) ? wpml_page_id( $post->ID ) : "";

		if( BLOGPAGE != "" && $post_id == BLOGPAGE ){
			return true;
		}	

		if( $taxonomy == "category" || $post_type == 'post' ){
			return true;
		}					
	}
}


#
# gets orginal paths of images when multi site mode active
#
function find_image_org_path($image) {
	if(is_multisite()){
		global $blog_id;
		if (isset($blog_id) && $blog_id > 0) {
			if(strpos($image,get_bloginfo('wpurl'))!==false){//image is local 
				if(empty(get_current_site(1)->path)){
					$the_image_path = get_current_site(1)->path.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image);
				}else{
					$the_image_path = $image;
				}				
			}else{
				$the_image_path = $image;
			}
		}else{
			$the_image_path = $image;
		}
	}else{
		$the_image_path = $image;
	} 
	return $the_image_path;
}


#
# set selected theme style to body tag
#

function rt_body_class_name($classes) {
	$classes[] = get_option( THEMESLUG."_style" );
	$classes[] = get_option( THEMESLUG."_responsive_design" ) ? 'responsive' : '' ;	// responsive	
	// return the $classes array
	return $classes;
}

#
# returns a post ID from a url
#

function rt_get_attachment_id_from_src ($image_src) { 
		global $wpdb; 
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id    = $wpdb->get_var($query);
		return $id; 
}

#
# find orginal image url - clean thumbnail extensions
#

function rt_clean_thumbnail_ext ($image_src) { 
	$search = '#-\d+x\d+#';  
	return preg_replace($search, "", $image_src);
}
