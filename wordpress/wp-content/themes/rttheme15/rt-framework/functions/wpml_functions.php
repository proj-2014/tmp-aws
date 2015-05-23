<?php
#-----------------------------------------
#	RT-Theme wpml_functions.php
#	version: 1.0
#-----------------------------------------



#
# WPML match page id
#
function wpml_page_id($id, $purpose = "" ){	 
	if(function_exists('icl_object_id')) {
		global $sitepress;

		/*
		*	use ICL_LANGUAGE_CODE to to find translation of current page 
		*	$sitepress->get_default_language() to find orginal page of the current page
		*/ 
			 
		if ( $purpose == "get_translation" ){
			$language_code = ICL_LANGUAGE_CODE; 
		}else{
			$language_code = $sitepress->get_default_language();
		}

		return icl_object_id($id,'page',true, $language_code);
	} else {
		return $id;
	}
}

#
# WPML match post id
#
function wpml_post_id($id){
	if(function_exists('icl_object_id')) {
		global $sitepress, $post;
		$get_default_language =  $sitepress->get_default_language();
		$post_type = isset( $post->post_type ) ? $post->post_type : "post" ; 
		return icl_object_id($id,$post_type,true,$get_default_language);
	} else {
		return $id;
	}
}

#
# WPML match category id
#
function wpml_category_id($id){
	if(function_exists('icl_object_id')) {
		global $sitepress;
		$get_default_language =  $sitepress->get_default_language();

		return icl_object_id($id,'category',true,$get_default_language);
	} else {
		return $id;
	}
}


#
# WPML match product category id
#
function wpml_product_category_id($id){
	if(function_exists('icl_object_id')) {
		global $sitepress;
		$get_default_language =  $sitepress->get_default_language();

		return icl_object_id($id,'product_categories',true,$get_default_language);
	} else {
		return $id;
	}
}

#
# WPML match portfolio category id
#
function wpml_portfolio_category_id($id){
	if(function_exists('icl_object_id')) {
		global $sitepress;
		$get_default_language =  $sitepress->get_default_language();

		return icl_object_id($id,'portfolio_categories',true,$get_default_language);
	} else {
		return $id;
	}
}


#
# WPML match categories
#
function wpml_lang_object_ids($ids_array, $type) {
	if(function_exists('icl_object_id')) {
		global $sitepress;
		$get_default_language =  ICL_LANGUAGE_CODE;

		$res = array();
		foreach ($ids_array as $id) {
			$xlat = icl_object_id($id,$type,false,$get_default_language);
			if(!is_null($xlat)) $res[] = $xlat;
		}
		return $res;
	} else {
		return $ids_array;
	}
}

#
# Get WPML Plugin Flags
#
function languages_list(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
	if(!empty($languages)){
		echo '<ul class="flags">';
		foreach($languages as $l){
			echo '<li>';
			if($l['country_flag_url']){
			    echo '<a href="'.$l['url'].'" title="'.$l['native_name'].'" class="j_ttip"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></a>';
			}
			echo '</li>';
		}
		echo '</ul>';
	}
}


#
#	WPML Home URL
#
function wpml_get_home_url(){
	if(function_exists('icl_get_home_url')){
	    return icl_get_home_url();
	}else{
	    return rtrim(get_bloginfo('url') , '/') . '/';
	}
}

#
#	WPML String Register
#
function wpml_register_string($context, $name, $value){
	if(function_exists('icl_register_string') && trim($value)){
		icl_register_string($context, $name, $value);
	}    
}

#
#	WPML Get Registered String
#
function wpml_t($context, $name, $original_value){
    if(function_exists('icl_t')){
        return icl_t($context, $name, $original_value);
    }else{
        return $original_value;
    }
}


#
#	String Registration
#
wpml_register_string( THEMESLUG , 'Footer Copyright Text', stripslashes(get_option(THEMESLUG.'_footer_copy')));
wpml_register_string( THEMESLUG , 'Breadcrumb Menu Text',  get_option(THEMESLUG.'_breadcrumb_text')); 
wpml_register_string( THEMESLUG , 'Contact - Map Code', stripslashes(get_option(THEMESLUG.'_map_code')));
wpml_register_string( THEMESLUG , 'Contact - Title', stripslashes(get_option(THEMESLUG.'_contact_title')));
wpml_register_string( THEMESLUG , 'Contact - Text', stripslashes(get_option(THEMESLUG.'_contact_text')));
wpml_register_string( THEMESLUG , 'Contact - Address', stripslashes(get_option(THEMESLUG.'_address')));
wpml_register_string( THEMESLUG , 'Contact - Phone', stripslashes(get_option(THEMESLUG.'_phone')));
wpml_register_string( THEMESLUG , 'Contact - Email', stripslashes(get_option(THEMESLUG.'_email_contact')));
wpml_register_string( THEMESLUG , 'Contact - Support Email', stripslashes(get_option(THEMESLUG.'_support_email')));
wpml_register_string( THEMESLUG , 'Contact - Fax', stripslashes(get_option(THEMESLUG.'_fax')));
wpml_register_string( THEMESLUG , 'Contact - Link for Map', stripslashes(get_option(THEMESLUG.'_link_for_map')));
wpml_register_string( THEMESLUG , 'Contact - Contact Form Title', stripslashes(get_option(THEMESLUG.'_contact_form_title')));
wpml_register_string( THEMESLUG , 'Contact - Contact Form Email', stripslashes(get_option(THEMESLUG.'_contact_email'))); 
 



?>