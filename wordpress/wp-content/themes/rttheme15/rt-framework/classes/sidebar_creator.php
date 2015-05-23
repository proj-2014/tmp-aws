<?php
#-----------------------------------------
#	RT-Theme sidebar_creator.php
#	version: 1.0
#-----------------------------------------

#
#	Create sidebars
# 

class RT_Create_Sidebars{

	var $rt_sidebars=array();
	var $savedSidebars=array();
	var $sidebar_classes=array();
	
	#
	# Construct
	#	 
	function __construct(){
		
		//user sidebars
		$sidebarOptions = get_option('rt_sidebar_options');
		$this->savedSidebars = empty($sidebarOptions) ? array() : $sidebarOptions;
		
		//default sidebars	
		array_push($this->rt_sidebars,array( 
			"home-page-contents" => __("Widgetized Home Page Area", 'rt_theme_admin'),
			"left-sidebar-for-homepage" => __("Left Sidebar For Home Page", 'rt_theme_admin'),	
			"common-sidebar" => __("Common Sidebar", 'rt_theme_admin'),	
			"sidebar-for-pages" => __("Sidebar For Pages", 'rt_theme_admin'),			
			"sidebar-for-portfolio" => __("Sidebar For Portfolio", 'rt_theme_admin'),
			"sidebar-for-portfolios" => __("Sidebar For Single Portfolio Item", 'rt_theme_admin'),			
			"sidebar-all-products" => __("Sidebar For Products", 'rt_theme_admin'),
			"sidebar-for-product" => __("Sidebar For Single Product Item", 'rt_theme_admin'),			
			"sidebar-for-product-categories" => __("Sidebar For Product Categories", 'rt_theme_admin'),
			"sidebar-for-blog" => __("Sidebar For Blog", 'rt_theme_admin'),			
			"sidebar-for-archive" => __("Sidebar For Blog Categories", 'rt_theme_admin'),
			"sidebar-for-single" => __("Sidebar For Blog Single Post", 'rt_theme_admin'),
		));
	
		add_action('init',array(&$this,'create_sidebar'));
		add_action('init',array(&$this,'create_user_sidebars'));  
		
		//sidebar classes
		array_push($this->sidebar_classes,array( 
			5 => 'five',
			4 => 'four',
			3 => 'three',
			2 => 'two',
			1 => 'one'
		));		
	}
	
	#
	# Create Sidebars
	#
	function create_sidebar(){
		foreach ($this->rt_sidebars[0] as $k => $v) {
			$this->rt_sidebar($k,$v);
		} 
	}
	
	#
	# Register Sidebars
	#
	function rt_sidebar($sidebar_id,$sidebar_name){
		
		if($sidebar_id=="home-page-contents"){
			
			//get home page layout
			$home_page_layout= $this->sidebar_classes[0][get_option("rttheme_home_box_width")];
			
			register_sidebar(array(
			    'id'=> $sidebar_id,
			    'name' => $sidebar_name,
			    'before_widget' => '<div class="box '.$home_page_layout.' column_class widget %2$s"><div class="featured">',
			    'description' => $sidebar_name,
			    'after_widget' => '</div></div>  reset ',
			    'before_title' => '<div class="title"><h4>',
			    'after_title' => '</h4></div>',
			));
			
			add_filter('dynamic_sidebar_params', array(&$this,'home_page_layout_class'));
			
		}else{
			register_sidebar(array(
			    'id'=> $sidebar_id,
			    'name' => $sidebar_name,
			    'before_widget' => '<div class="box dynamic_sidebar widget  %2$s">',
			    'description' => $sidebar_name,
			    'after_widget' => '</div>',
			    'before_title' => '<h4>',
			    'after_title' => '</h4>',
			));						
		}
	   
	}

	#
	# count sidebar items
	#
	function count_sidebar_items($id){		
		$get_sidebar_items=wp_get_sidebars_widgets();		
		$count_sidebar_items=count($get_sidebar_items[$id]);		
		return $count_sidebar_items;
	}

	#
	# widgetized home page layout class
	#
	function home_page_layout_class($params) {
		global $widget_num,$home_contents_count;
		$reset = $column_class = "";

		if($params[0]['id'] == "home-page-contents"){
			
			// clear
			if(empty($home_contents_count)) echo '<div class="clear"></div><div class="space"></div><div class="clear"></div>';			 
			
			//which one
			$id=$params[0]['id'];  
			
			//box width
			$box_width=get_option("rttheme_home_box_width");
		
			// Widget class
			$class = array();
			
			// Home page class 
			if($id=="home-page-contents"):
			    $home_contents_count++;
			    $widget_num=$home_contents_count;        
			endif;
			
			// line
			if($widget_num==1):
			    echo '<div class="line"></div>';
			endif;			
			
			// clear
			if(fmod($widget_num,$box_width) == 0 || $box_width==1 || $this->count_sidebar_items($id)==$widget_num):
			    $reset = '<div class="clear"></div><div class="space"></div>';
			endif;
	
			//first and last classes
			if($widget_num==1 || fmod($widget_num,$box_width)==1 || $box_width==1):
			    $column_class = 'first';
			elseif(fmod($widget_num,$box_width) == 0):
			    $column_class = 'last'; 
			endif;
			
			// replace content with placeholder
			$params[0]['before_widget'] = str_replace('column_class', @$column_class, $params[0]['before_widget']);
			$params[0]['after_widget'] = str_replace('reset', @$reset, $params[0]['after_widget']);
		}
		
		return $params;
	}


	#
	#  footer layout class
	#
	function footer_layout_class($params) {
		global $widget_num,$footer_contents_count;
		
		if($params[0]['id'] == "sidebar-for-footer"){
			
			// clear
			if(empty($footer_contents_count)) echo '<div class="clear"></div><div class="space half"></div><div class="clear"></div>';			 
			
			//which one
			$id=$params[0]['id'];  
			
			//box width
			$box_width=get_option("rttheme_footer_box_width");
		
			// Widget class
			$class = array();
			
			// Home page class 
			if($id=="sidebar-for-footer"):
			    $footer_contents_count++;
			    $widget_num=$footer_contents_count;        
			endif;
		
			// clear
			if(fmod($widget_num,$box_width) == 0 || $box_width==1 || $this->count_sidebar_items($id)==$widget_num):
			    $reset = '<div class="clear"></div>';
			endif;
	
			//first and last classes
			if($widget_num==1 || fmod($widget_num,$box_width)==1 || $box_width==1):
			    $column_class = 'first';
			elseif(fmod($widget_num,$box_width) == 0):
			    $column_class = 'last'; 
			endif;
			
			// replace content with placeholder
			$params[0]['before_widget'] = str_replace('column_class', @$column_class, $params[0]['before_widget']);
			$params[0]['after_widget'] = str_replace('reset', @$reset, $params[0]['after_widget']);
		}
		
		return $params;
	}	

	#
	# Get All Sidebars
	#
	function rt_get_sidebar(){
		global $post; 

		// Left Sidebar For Home Page
		if(is_front_page()) dynamic_sidebar('left-sidebar-for-home-page');
		
		// Page Sidebar
		if( ! is_theme_page() ) dynamic_sidebar('sidebar-for-pages');

		// Portfolio Sidebar - all portfolio contents
		if( @$post->ID==PORTFOLIOPAGE || get_query_var('taxonomy')=="portfolio_categories" || (is_single() && $post->post_type=='portfolio' )) dynamic_sidebar('sidebar-for-portfolio');
		
		// Portfolio Sidebar - single portfolio item
		if(is_single() && $post->post_type=='portfolio' ) dynamic_sidebar('sidebar-for-portfolios');

		// Product Sidebar - all product contents 
		if( @$post->ID==PRODUCTPAGE || get_query_var('taxonomy')=="product_categories" || (is_single() && $post->post_type=='products') ) dynamic_sidebar('sidebar-all-products');
		
		// Product Sidebar - single products 
		if(is_single() && $post->post_type=='products' ) dynamic_sidebar('sidebar-for-product');

		// Product Sidebar Listings
		if( @$post->ID==PRODUCTPAGE || get_query_var('taxonomy')=="product_categories" ) dynamic_sidebar('sidebar-for-product-categories');		
		
		// Blog Categories
		if(is_category() || @$post->ID == BLOGPAGE) dynamic_sidebar('sidebar-for-archive');

		// Blog All
		if( (is_category()) || ( is_single() && @$post->post_type=='post' ) || @$post->ID == BLOGPAGE ) dynamic_sidebar('sidebar-for-blog');

		// Blog Single
		if(is_single() && $post->post_type=='post' ) dynamic_sidebar('sidebar-for-single');
		 
		// Common Sidebar - For all site
		dynamic_sidebar('common-sidebar');
		
		// Call Page User Sidebars
		if(is_page()) $this->rt_get_ud_sidebars('pages',$post->ID);
		
		// Call Post User Sidebar
		if(is_single()) $this->rt_get_ud_sidebars('posts',$post->ID);
		
		// Call Category User Sidebar
		if(is_category()) $this->rt_get_ud_sidebars('categories',get_query_var('cat'));
		
		// Find product category id		
		$this->term = get_query_var('term'); 
		$prod_term = get_terms('product_categories', 'slug='.$this->term.'');
		
		if(is_array($prod_term)){
			foreach ($prod_term as $k){
				$term_id=$k->term_id;
			}
		}
		
		// Call Product Category User Sidebar	
		if (is_tax() && get_query_var('taxonomy')=="product_categories") $this->rt_get_ud_sidebars('productcategories',$term_id);
	}

	#
	# Get User Sidebars
	#
	function rt_get_ud_sidebars($postType,$postID){
		
		// Count Sidebars
		$savedSidebars_IDs = array ();
		$sidebar_count = 0 ;
		
		if($this->savedSidebars){
			foreach($this->savedSidebars as $key => $value){
				if(!is_array($value)){  
					if(stristr($key, '_sidebar_name') == TRUE) {
						array_push($savedSidebars_IDs,$key);
						$sidebar_count++;
					} 
				}
			}
		}

		// create new sidebar array 		
		$savedSidebars_array = array ();

		// find and call the sidebar 		
		foreach($savedSidebars_IDs as $id){ 
			
			//sidebar values
			$sidebar_name               = isset($this->savedSidebars[$id]) ? $this->savedSidebars[$id]: "";	
			$sidebar_id                 = str_replace("_sidebar_name", "", $id);
			$sidebar_pages              = isset($this->savedSidebars[$sidebar_id.'_pages']) ? $this->savedSidebars[$sidebar_id.'_pages']: "";	
			$sidebar_posts              = isset($this->savedSidebars[$sidebar_id.'_posts']) ? $this->savedSidebars[$sidebar_id.'_posts']: "";	
			$sidebar_categories         = isset($this->savedSidebars[$sidebar_id.'_categories']) ? $this->savedSidebars[$sidebar_id.'_categories']: "";	
			$sidebar_product_categories = isset($this->savedSidebars[$sidebar_id.'_productcategories']) ? $this->savedSidebars[$sidebar_id.'_productcategories'] : "";		
		
			//pages
			if($postType == "pages"){
				if($sidebar_pages){				   

					foreach($sidebar_pages as $k=>$v){
						if($v==wpml_page_id($postID)){ 
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}

			//posts
			if($postType == "posts"){
				if($sidebar_posts){
					foreach($sidebar_posts as $k=>$v){
						if($v==wpml_post_id($postID)){
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}

			//categories
			if($postType == "categories"){
				if($sidebar_categories){
					foreach($sidebar_categories as $k=>$v){
						if($v==wpml_category_id($postID)){
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}

			//product categories
			if($postType == "productcategories"){
				if($sidebar_product_categories){ 
					foreach($sidebar_product_categories as $k=>$v){
						if($v==wpml_product_category_id($postID)){
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}	
		}
	}


	#
	# Create user sidebars
	#
	function create_user_sidebars(){
		foreach($this->savedSidebars as $key => $value){
			if(!is_array($value)){  
				if(stristr($key, '_sidebar_name') == TRUE) {
					$this->rt_sidebar(str_replace("_sidebar_name", "", $key),$value);
				} 
			}
		}
	}	


}


?>