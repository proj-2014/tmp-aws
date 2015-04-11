<?php
	/*
	*
	*	Header Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	
	/* SUPER SEARCH
	================================================== */ 
	function sf_super_search() {
		
		$options = get_option('sf_neighborhood_options');
		$ss_final_text = $options['ss_final_text'];
		$ss_button_text = $options['ss_button_text'];
		$field1_text = $options['field1_text'];
		$field1_filter = $options['field1_filter'];
		$field1_default_text = $options['field1_default_text'];
		$field2_text = $options['field2_text'];
		$field2_filter = $options['field2_filter'];
		$field2_default_text = $options['field2_default_text'];
		$field3_text = $options['field3_text'];
		$field3_filter = $options['field3_filter'];
		$field3_default_text = $options['field3_default_text'];
		$field4_text = $options['field4_text'];
		$field4_filter = $options['field4_filter'];
		$field4_default_text = $options['field4_default_text'];
		$field5_text = $options['field5_text'];
		$field5_filter = $options['field5_filter'];
		$field5_default_text = $options['field5_default_text'];
		$field6_text = $options['field6_text'];
		$field6_filter = $options['field6_filter'];
		$field6_default_text = $options['field6_default_text'];
		$shop_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
						
		$super_search = $search_text = "";
		
		$search_btn_text = $ss_button_text;
		
		if ($field1_text != "") {
		$search_text .= '<span>'.$field1_text.'</span>';
		$search_text .= sf_super_search_dropdown(1, $field1_filter, $field1_default_text);
		}
		if ($field2_text != "") {
		$search_text .= '<span>'.$field2_text.'</span>';
		$search_text .= sf_super_search_dropdown(2, $field2_filter, $field2_default_text);
		}
		if ($field3_text != "") {
		$search_text .= '<span>'.$field3_text.'</span>';
		$search_text .= sf_super_search_dropdown(3, $field3_filter, $field3_default_text);
		}
		if ($field4_text != "") {
		$search_text .= '<span>'.$field4_text.'</span>';
		$search_text .= sf_super_search_dropdown(4, $field4_filter, $field4_default_text);
		}
		if ($field5_text != "") {
		$search_text .= '<span>'.$field5_text.'</span>';
		$search_text .= sf_super_search_dropdown(5, $field5_filter, $field5_default_text);
		}
		if ($field6_text != "") {
		$search_text .= '<span>'.$field6_text.'</span>';
		$search_text .= sf_super_search_dropdown(6, $field6_filter, $field6_default_text);
		}
		
		$search_text .= '<span>'.$ss_final_text.'</span>';
		
		$super_search .= '<div id="super-search">';
		$super_search .= '<div class="container">';
		$super_search .= '<div class="row">';
		$super_search .= '<div class="search-options span9">';
		$super_search .= $search_text;
		$super_search .= '</div>';
		$super_search .= '<div class="search-go span3">';
		$super_search .= '<a href="#" id="super-search-go" class="sf-roll-button" data-home_url="'.get_home_url().'" data-shop_url="'.$shop_url.'"><span>'.$search_btn_text.'</span><span>'.$search_btn_text.'</span></a>';
		$super_search .= '<a href="#" id="super-search-close" class="sf-roll-button"><span>&times;</span><span>&times;</span></a>';
		$super_search .= '</div>';
		$super_search .= '</div><!-- close .row -->';
		$super_search .= '</div><!-- close .container -->';
		$super_search .= '</div><!-- close .#super-search -->';
		
		return $super_search;
	}
	
	function sf_super_search_dropdown($index, $option, $text) {
	
		global $product;
		
		$option_id = $sf_ss_dropdown = $default_term_id = "";
		
		$option_id = $option;
		
		if ($option != "product_cat" && $option != "price") {
			$option = 'pa_' . $option;
		}
		
		$default_term = get_term_by('name', $text, $option);
		
		if ($default_term) {
			if ($option == "product_cat") {
			$default_term_id = $default_term->slug;			
			} else {
			$default_term_id = $default_term->term_id;
			}
		}
		
		$term_args = array(
		    'parent' => 0,
		);
		
		if ($option == "price") {
			
			global $wpdb, $woocommerce;
			
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key = \'%3$s\'
					', $wpdb->posts, $wpdb->postmeta, '_price' )
			) );
				
			$sf_ss_dropdown .= '<input type="text" pattern="[0-9]*" id="ss-price-min" name="min_price" value="0" />';
			$sf_ss_dropdown .= '<span>&</span>';
			$sf_ss_dropdown .= '<input type="text" pattern="[0-9]*" id="ss-price-max" name="max_price" value="'.$max.'" />';
		
		} else {
		
			$terms = get_terms($option, $term_args);
			
			$sf_ss_dropdown .= '<div id="'.$option_id.'" class="ss-dropdown" tabindex="'.$index.'" data-attr_value="'.$default_term_id.'">';
			$sf_ss_dropdown .= '<span>'.$text.'</span>';
			$sf_ss_dropdown .= '<ul>';
			$sf_ss_dropdown .= '<li>';
			$sf_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="">'.__("Any", "swiftframework").'</a>';
			$sf_ss_dropdown .= '<i class="icon-ok"></i>';
			$sf_ss_dropdown .= '</li>';	
			
			foreach ($terms as $term) {
				if ($term->slug == $default_term_id || $term->term_id == $default_term_id) {
					$sf_ss_dropdown .= '<li class="selected">';
				} else {
					$sf_ss_dropdown .= '<li>';
				}
				
				if ($option == "product_cat") {
					$sf_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="'.$term->slug.'">'.$term->name.'</a>';
				} else {
					$sf_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="'.$term->term_id.'">'.$term->name.'</a>';
				}
				
				$sf_ss_dropdown .= '<i class="icon-ok"></i>';
				$sf_ss_dropdown .= '</li>';	
			}
		
			$sf_ss_dropdown .= '</ul>';
			$sf_ss_dropdown .= '</div>';
		
		}
		
		return $sf_ss_dropdown;
	}
	
 	/* TOP BAR
 	================================================== */ 
	function sf_top_bar() {
	
		// VARIABLES
		$options = get_option('sf_neighborhood_options');	
		$tb_config = $options['tb_config'];
		$tb_left_text = $options['tb_left_text'];
		$tb_right_text = $options['tb_right_text'];
		$tb_search_text = $options['tb_search_text'];
		
		$show_sub = $options['show_sub'];
		$show_translation = $options['show_translation'];
		$show_account = $options['show_account'];
		$show_cart = $options['show_cart'];
		$ss_mobile = $options['ss_mobile'];
		
		$tb_output = $tb_menu_output = $tb_left_output = $tb_right_output = $swift_search_output = $ss_enable = '';
		
		if (isset($options['ss_enable'])) {
			$ss_enable = $options['ss_enable'];
		} else {
			$ss_enable = true;
		}
		
		
		// TOP BAR MENU OUTPUT
		$tb_menu_args = array(
			'echo'            => false,
			'theme_location' => 'top_bar_menu',
			'fallback_cb' => ''
		);
		$tb_menu_output .= '<nav class="top-menu clearfix">'. "\n";	
		if(function_exists('wp_nav_menu')) {
			$tb_menu_output .= wp_nav_menu( $tb_menu_args );
		}
		$tb_menu_output .= '</nav>'. "\n";
		
		
		// TOP BAR SWIFT SEARCH OUTPUT
		if ($ss_enable) {
			$swift_search_output .= '<div class="tb-text"><a class="swift-search-link" href="#"><i class="icon-zoom-in"></i><span>'.do_shortcode($tb_search_text).'</span></a></div>';
		}
		
		// TOP BAR LEFT OUTPUT
		if ($tb_config == "tb-1") {
		
			$tb_left_output = '<div class="tb-text clearfix">'. do_shortcode($tb_left_text). '</div>' . "\n";
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";
		
		} else if ($tb_config == "tb-2") {
		
			$tb_left_output = $tb_menu_output;
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";
		
		} else if ($tb_config == "tb-3") {
		
			$tb_left_output = '<div class="tb-text clearfix">'. do_shortcode($tb_left_text). '</div>' . "\n";
			$tb_right_output = $tb_menu_output;
		
		} else if ($tb_config == "tb-4") {
			
			$tb_left_output = sf_woo_links('top-menu', $tb_config);
			$tb_right_output = sf_aux_links('top-menu');
		
		} else if ($tb_config == "tb-5") {
			
			$tb_left_output = sf_woo_links('top-menu', $tb_config);
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";
		
		} else if ($tb_config == "tb-6") {
			
			$tb_left_output = sf_woo_links('top-menu', $tb_config);
			$tb_right_output = $tb_menu_output;
		
		} else if ($tb_config == "tb-7") {
			
			$tb_left_output = $swift_search_output;
			$tb_right_output = '<div class="tb-text clearfix">'. do_shortcode($tb_right_text). '</div>' . "\n";	
	
		} else {
			
			$tb_left_output = $swift_search_output;
			$tb_right_output = $tb_menu_output;
			
		}


		// TOP BAR OUTPUT
		$tb_output .= '<div id="top-bar" class="'.$tb_config.'">'. "\n";
		if ($ss_mobile) {
		$tb_output .= '<div class="tb-ss visible-phone">'.$swift_search_output.'</div>'. "\n";
		}
		$tb_output .= '<div class="container">'. "\n";
		$tb_output .= '<div class="row">'. "\n";
		$tb_output .= '<div class="tb-left span6 clearfix">'. "\n";
		$tb_output .= $tb_left_output;
		$tb_output .= '</div> <!-- CLOSE .tb-left -->'. "\n";		
		$tb_output .= '<div class="tb-right span6 clearfix">'. "\n";
		$tb_output .= $tb_right_output;
		$tb_output .= '</div> <!-- CLOSE .tb-right -->'. "\n";
		$tb_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$tb_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$tb_output .= '</div> <!-- CLOSE #top-bar -->'. "\n";
		
			
		// TOP BAR RETURN		
		return $tb_output;
	}
	
	
	/* HEADER
	================================================== */ 
	function sf_header() {
	
		// VARIABLES
		$options = get_option('sf_neighborhood_options');
		$header_layout = $options['header_layout'];
		$show_cart = $options['show_cart'];
		$show_wishlist = $options['show_wishlist'];
		$header_output = $main_menu = '';
				
		if ($header_layout == "header-1") {
		
		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="row">'. "\n";
		$header_output .= '<div class="header-left span4">'.sf_woo_links('header-menu', 'logo-left').'</div>'. "\n";
		$header_output .= sf_logo('span4 logo-center');
		$header_output .= '<div class="header-right span4">'.sf_aux_links('header-menu', TRUE).'</div>'. "\n";
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();
		$header_output .= '<div id="main-nav">'. "\n";
		$header_output .= sf_main_menu('main-navigation', 'full');
		$header_output .= '</div>'. "\n";
		
		} else if ($header_layout == "header-2") {
		
		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="row">'. "\n";
		$header_output .= sf_logo('span4 logo-left');
		$header_output .= '<div class="header-right span8">'.sf_aux_links('header-menu').'</div>'. "\n";
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();
		$header_output .= '<div id="main-nav">'. "\n";
		$header_output .= sf_main_menu('main-navigation', 'full');
		$header_output .= '</div>'. "\n";
		
		} else if ($header_layout == "header-3") {
		
		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="row">'. "\n";
		$header_output .= '<div class="header-left span8">'.sf_aux_links('header-menu').'</div>'. "\n";
		$header_output .= sf_logo('span4 logo-right');
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();
		$header_output .= '<div id="main-nav">'. "\n";
		$header_output .= sf_main_menu('main-navigation', 'full');
		$header_output .= '</div>'. "\n";
		
		} else if ($header_layout == "header-4") {
		
		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="row">'. "\n";
		$header_output .= sf_logo('span4 logo-left');
		$header_output .= '<div class="header-right span8">';
		$header_output .= '<nav>'. "\n";
		$header_output .= '<ul class="menu">'. "\n";
		if ($show_cart) {
		$header_output .= sf_get_cart();
		}
		if ( class_exists( 'YITH_WCWL_UI' ) &&  $show_wishlist)  {
		$header_output .= sf_get_wishlist();
		}
		$header_output .= '</ul>'. "\n";
		$header_output .= '</nav>'. "\n";
		$header_output .= sf_main_menu('main-navigation');
		$header_output .= '</div>'. "\n";
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();
		
		} else {
		
		$header_output .= '<header id="header" class="clearfix">'. "\n";
		$header_output .= '<div class="container">'. "\n";
		$header_output .= '<div class="row">'. "\n";
		$header_output .= sf_logo('span4 logo-right');
		$header_output .= '<div class="header-left span8">'.sf_main_menu('main-navigation').'</div>'. "\n";
		$header_output .= '</div> <!-- CLOSE .row -->'. "\n";
		$header_output .= '</div> <!-- CLOSE .container -->'. "\n";
		$header_output .= '</header>'. "\n";
		$header_output .= sf_mobile_search();
		
		}
		
		// HEADER RETURN
		return $header_output;
		
	}
	
	function sf_mini_header() {
		
		$mini_header_output = '';
		
		$mini_header_output .= '<div id="mini-header">';
		$mini_header_output .= sf_main_menu('mini-navigation', 'full');
		$mini_header_output .= '</div>';
	
		return $mini_header_output;
	}
	
	function sf_mobile_search() {
		
		$mobile_search_output = '';
		
		$mobile_search_output .= '<form method="get" class="mobile-search-form" action="'.home_url().'/"><input type="text" placeholder="'.__("Search", "swiftframework").'" name="s" autocomplete="off" /></form>';
	
		return $mobile_search_output;
	}
	
		
	/* LOGO
	================================================== */ 
	function sf_logo($logo_class) {
		
		//VARIABLES
		global $woocommerce;
		$options = get_option('sf_neighborhood_options');
		$show_cart = $options['show_cart'];
		$logo = $retina_logo = "";
		if (isset($options['logo_upload'])) {
		$logo = $options['logo_upload'];
		}
		if (isset($options['retina_logo_upload'])) {
		$retina_logo = $options['retina_logo_upload'];
		}
		if ($logo == "") {
		$logo = get_template_directory_uri() . '/images/logo.png';
		}
		if ($retina_logo == "") {
		$retina_logo = $logo;
		}
		$logo_output = "";		
		$logo_alt = get_bloginfo( 'name' );
		$logo_link_url = home_url();
		
		
		// LOGO OUTPUT
		$logo_output .= '<div id="logo" class="'.$logo_class.' clearfix">'. "\n";
		$logo_output .= '<a href="'.$logo_link_url.'">'. "\n";
		$logo_output .= '<img class="standard" src="'.$logo.'" alt="'.$logo_alt.'" />'. "\n";
		$logo_output .= '<img class="retina" src="'.$retina_logo.'" alt="'.$logo_alt.'" />'. "\n";
		$logo_output .= '</a>'. "\n";
		$logo_output .= '<a href="#" class="visible-phone show-main-nav"><i class="icon-align-justify"></i></a>'. "\n";
		if ($show_cart) {
		$logo_output .= '<a href="'.$woocommerce->cart->get_cart_url().'" class="visible-phone mobile-cart-link"><i class="sf-cart"></i></a>'. "\n";
		}
		$logo_output .= '<a href="#" class="visible-phone mobile-search-link"><i class="icon-search"></i></a>'. "\n";
		$logo_output .= '</div>'. "\n";
		
		
		// LOGO RETURN		
		return $logo_output;
	}
	
	
	/* MENU
	================================================== */ 
	function sf_main_menu($id, $layout = "") {
	
		// VARIABLES
		$options = get_option('sf_neighborhood_options');
		$show_cart = $options['show_cart'];
		$show_wishlist = $options['show_wishlist'];
		$menu_output = $menu_full_output = "";
		$main_menu_args = array(
			'echo'            => false,
			'theme_location' => 'main_navigation',
			'fallback_cb' => ''
		);
		
		
		// MENU OUTPUT
		if ($id == "mini-navigation") {
		$menu_output .= '<nav id="'.$id.'" class="mini-menu clearfix">'. "\n";
		} else {
		$menu_output .= '<nav id="'.$id.'" class="clearfix">'. "\n";		
		}	
		if(function_exists('wp_nav_menu')) {
			$menu_output .= wp_nav_menu( $main_menu_args );
		}
		$menu_output .= '</nav>'. "\n";
		
		
		// FULL WIDTH MENU OUTPUT
		if ($layout == "full") {	
			$menu_full_output .= '<div class="container">'. "\n";
			$menu_full_output .= '<div class="row">'. "\n";
			$menu_full_output .= '<div class="span9">'. "\n";
			$menu_full_output .= $menu_output . "\n";
			$menu_full_output .= '</div>'. "\n";
			$menu_full_output .= '<div class="span3 header-right">'. "\n";
			if ($id == "mini-navigation") {
			$menu_full_output .= '<nav class="mini-menu">'. "\n";
			} else {
			$menu_full_output .= '<nav>'. "\n";			
			}
			$menu_full_output .= '<ul class="menu">'. "\n";
			$menu_full_output .= '<li class="menu-search parent"><a href="#"><i class="icon-search"></i></a>'. "\n";
			$menu_full_output .= '<ul class="sub-menu">'. "\n";
			$menu_full_output .= '<li><form method="get" class="search-form" action="'.home_url().'/"><input type="text" placeholder="'.__("Search", "swiftframework").'" name="s" /></form></li>'. "\n";
			$menu_full_output .= '</ul>'. "\n";
			$menu_full_output .= '</li>'. "\n";
			if ($show_cart) {
			$menu_full_output .= sf_get_cart();
			}
			if ( class_exists( 'YITH_WCWL_UI' ) && $show_wishlist)  {
			$menu_full_output .= sf_get_wishlist();
			}
			$menu_full_output .= '</ul>'. "\n";
			$menu_full_output .= '</nav>'. "\n";
			$menu_full_output .= '</div>'. "\n";
			$menu_full_output .= '</div>'. "\n";
			$menu_full_output .= '</div>'. "\n";
			
			$menu_output = $menu_full_output;
		}
		
		
		// MENU RETURN		
		return $menu_output;
	}
	
	
	/* WOO LINKS
	================================================== */ 
	function sf_woo_links($position, $config = "") {
		
		// VARIABLES
		$options = get_option('sf_neighborhood_options');	
		$tb_search_text = $options['tb_search_text'];
		$woo_links_output = $ss_enable = "";
		
		if (isset($options['ss_enable'])) {
			$ss_enable = $options['ss_enable'];
		} else {
			$ss_enable = true;
		}
		
		// WOO LINKS OUTPUT
		$woo_links_output .= '<nav class="'.$position.'">'. "\n";
		$woo_links_output .= '<ul class="menu">'. "\n";
		if (is_user_logged_in()) {
			global $current_user;
			get_currentuserinfo();
			$woo_links_output .= '<li class="tb-welcome">' . __("Welcome", "swiftframework") . " " . $current_user->display_name . '</li>'. "\n";
		} else {
			$woo_links_output .= '<li class="tb-welcome">' . __("Welcome", "swiftframework") . '</li>'. "\n";
		}
		if ($ss_enable) {
			if ($position == "top-menu") {
			$woo_links_output .= '<li class="tb-woo-custom clearfix"><a class="swift-search-link" href="#"><i class="icon-zoom-in"></i><span>'.do_shortcode($tb_search_text).'</span></a></li>'. "\n";
			} else {
			$woo_links_output .= '<li class="hs-woo-custom clearfix"><a class="swift-search-link" href="#"><i class="icon-zoom-in"></i><span>'.do_shortcode($tb_search_text).'</span></a></li>'. "\n";		
			}
		}
		$woo_links_output .= '</ul>'. "\n";
		$woo_links_output .= '</nav>'. "\n";
		
		// RETURN
		return $woo_links_output;
	}
	
	
	/* AUX LINKS
	================================================== */ 
	function sf_aux_links($position, $alt_version = FALSE) {
	
		// VARIABLES
		$login_url = wp_login_url();
		$logout_url = wp_logout_url( home_url() );
		$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
		if ( $myaccount_page_id ) {
			$logout_url = wp_logout_url( get_permalink( $myaccount_page_id ) );
		  	$login_url = get_permalink( $myaccount_page_id );
		  	if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
		    	$logout_url = str_replace( 'http:', 'https:', $logout_url );
				$login_url = str_replace( 'http:', 'https:', $login_url );
			}
		}
		$options = get_option('sf_neighborhood_options');
		$show_sub = $options['show_sub'];
		$show_translation = $options['show_translation'];
		$sub_code = $options['sub_code'];
		$show_account = $options['show_account'];
		$tb_search_text = $options['tb_search_text'];
		$aux_links_output = $ss_enable = "";
		
		if (isset($options['ss_enable'])) {
			$ss_enable = $options['ss_enable'];
		} else {
			$ss_enable = true;
		}
		
		// LINKS + SEARCH OUTPUT
		$aux_links_output .= '<nav class="'.$position.'">'. "\n";
		$aux_links_output .= '<ul class="menu">'. "\n";
		if ($show_sub) {
			$aux_links_output .= '<li class="parent"><a href="#">'. __("Subscribe", "swiftframework") .'</a>'. "\n";
			$aux_links_output .= '<ul class="sub-menu">'. "\n";
			$aux_links_output .= '<li><div id="header-subscribe" class="clearfix">'. "\n";
			$aux_links_output .= $sub_code . "\n";
			$aux_links_output .= '</div></li>'. "\n";
			$aux_links_output .= '</ul>'. "\n";
			$aux_links_output .= '</li>'. "\n";
		}
		if ($show_translation) {
			$aux_links_output .= '<li class="parent aux-languages"><a href="#">'. __("Language", "swiftframework") .'</a>'. "\n";
			$aux_links_output .= '<ul id="header-languages" class="sub-menu">'. "\n";
			if (function_exists( 'language_flags' )) {
			$aux_links_output .= language_flags();
			}
			$aux_links_output .= '</ul>'. "\n";
			$aux_links_output .= '</li>'. "\n";
		}
		if ($show_account) {
			if (is_user_logged_in()) {
				$aux_links_output .= '<li><a href="'.wp_logout_url(home_url()).'">'. __("Sign Out", "swiftframework") .'</a></li>'. "\n";
				if ( $myaccount_page_id ) {
				$aux_links_output .= '<li><a href="'.get_permalink( $myaccount_page_id ).'" class="admin-link">'. __("My Account", "swiftframework") .'</a>'. "\n";
				} else {
				$aux_links_output .= '<li><a href="'.get_admin_url().'" class="admin-link">'. __("My Account", "swiftframework") .'</a>'. "\n";
				}
			} else {
				$aux_links_output .= '<li><a href="'.$login_url.'">'. __("Login", "swiftframework") .'</a>'. "\n";			
			}
		}
		if (($position == "header-menu" && !$alt_version) && $ss_enable) {
		$aux_links_output .= '<li><a class="swift-search-link" href="#"><i class="icon-zoom-in"></i><span>'.do_shortcode($tb_search_text).'</span></a></li>'. "\n";		
		}
		$aux_links_output .= '</ul>'. "\n";
		$aux_links_output .= '</nav>'. "\n";
	
	
		// RETURN
		return $aux_links_output;
	
	}

	function sf_get_cart() {
	
		$cart_output = "";
		
		// Check if WooCommerce is active
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		
			global $woocommerce;
			
			$cart_total = $woocommerce->cart->get_cart_total();
			$cart_count = $woocommerce->cart->cart_contents_count;
			
			$cart_output .= '<li class="parent shopping-bag-item"><a class="cart-contents" href="'.$woocommerce->cart->get_cart_url().'" title="'.__("View your shopping cart", "swiftframework").'"><i class="sf-cart"></i>'.$cart_total.'</a>';
            $cart_output .= '<ul class="sub-menu">';     
            $cart_output .= '<li>';                                      
			$cart_output .= '<div class="shopping-bag">';
			 
            if ( sizeof($woocommerce->cart->cart_contents)>0 ) {
            	
            	$cart_output .= '<div class="bag-header">'.sprintf(_n('1 item in the shopping bag', '%d items in the shopping bag', $woocommerce->cart->cart_contents_count, 'swiftframework'), $woocommerce->cart->cart_contents_count).'</div>';
            	
            	$cart_output .= '<div class="bag-contents">';
            	
            	foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) {
                
                    $bag_product = $cart_item['data']; 
                    $product_title = $bag_product->get_title();
                    $product_short_title = (strlen($product_title) > 25) ? substr($product_title, 0, 22) . '...' : $product_title;
                                                               
                    if ($bag_product->exists() && $cart_item['quantity']>0) {                                            
                        $cart_output .= '<div class="bag-product clearfix">';
                      	$cart_output .= '<figure><a class="bag-product-img" href="'.get_permalink($cart_item['product_id']).'">'.$bag_product->get_image().'</a></figure>';                      
                        $cart_output .= '<div class="bag-product-details">';
                        $cart_output .= '<div class="bag-product-title"><a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_short_title, $bag_product) . '</a></div>';
                        $cart_output .= '<div class="bag-product-price">'.__("Unit Price:", "swiftframework").' 
                        '.woocommerce_price($bag_product->get_price()).'</div>';
                        $cart_output .= '<div class="bag-product-quantity">'.__('Quantity:', 'swiftframework').' '.$cart_item['quantity'].'</div>';
                        $cart_output .= '</div>';
                        $cart_output .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
                        
                        $cart_output .= '</div>';
                	}
                }
                
                $cart_output .= '</div>';
                
                $cart_output .= '<div class="bag-buttons">';
                
                $cart_output .= '<a class="sf-roll-button bag-button" href="'.esc_url( $woocommerce->cart->get_cart_url() ).'"><span>'.__('View shopping bag', 'swiftframework').'</span><span>'.__('View shopping bag', 'swiftframework').'</span></a>';
                
                $cart_output .= '<a class="sf-roll-button checkout-button" href="'.esc_url( $woocommerce->cart->get_checkout_url() ).'"><span >'.__('Proceed to checkout', 'swiftframework').'</span><span>'.__('Proceed to checkout', 'swiftframework').'</span></a>';
                                
               	$cart_output .= '</div>';
                                                        
            } else {
           		
           		$cart_output .= '<div class="bag-header">'.__("0 items in the shopping bag", "swiftframework").'</div>';
           		
           		$cart_output .= '<div class="bag-empty">'.__('Unfortunately, your shopping bag is empty.','swiftframework').'</div>';                                    
            	
            	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
            	
            	$cart_output .= '<div class="bag-buttons">';
            	
            	$cart_output .= '<a class="sf-roll-button shop-button" href="'.esc_url( $shop_page_url ).'"><span>'.__('Go to the shop', 'swiftframework').'</span><span>'.__('Go to the shop', 'swiftframework').'</span></a>';
            	            	                
            	$cart_output .= '</div>';
            		
            }
            
		    $cart_output .= '</div>';
            $cart_output .= '</li>';                                                                                                          
            $cart_output .= '</ul>';                                                                                                          
            $cart_output .= '</li>';                                                                                                                      
        
        }
		
		return $cart_output;
	
	}
	
	function sf_get_wishlist() {
		
		global $wpdb, $yith_wcwl, $woocommerce;

		$wishlist_output = "";
				
		if ( is_user_logged_in() ) {
		    $user_id = get_current_user_id();
		}
		
		$count = array();
		
		if( is_user_logged_in() ) {
		    $count = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) as `cnt` FROM `' . YITH_WCWL_TABLE . '` WHERE `user_id` = %d', $user_id  ), ARRAY_A );
		    $count = $count[0]['cnt'];
		} elseif( yith_usecookies() ) {
		    $count[0]['cnt'] = count( yith_getcookie( 'yith_wcwl_products' ) );
		    $count = $count[0]['cnt'];
		} else {
		    $count[0]['cnt'] = count( $_SESSION['yith_wcwl_products'] );
		    $count = $count[0]['cnt'];
		}
		
		if (is_array($count)) {
			$count = 0;
		}
		
		$wishlist_output .= '<li class="parent wishlist-item"><a class="wishlist-link" href="'.$yith_wcwl->get_wishlist_url().'" title="'.__("View your wishlist", "swiftframework").'"><i class="icon-star"></i><span>'.$count.'</span></a>';
		$wishlist_output .= '<ul class="sub-menu">';
		$wishlist_output .= '<li>';
		$wishlist_output .= '<div class="wishlist-bag">';
		
		$current_page = 1;
		$limit_sql = '';
		$count_limit = 0;
		
		if( is_user_logged_in() )
		    { $wishlist = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s" . $limit_sql, $user_id ), ARRAY_A ); }
		elseif( yith_usecookies() )
		    { $wishlist = yith_getcookie( 'yith_wcwl_products' ); }
		else
		    { $wishlist = isset( $_SESSION['yith_wcwl_products'] ) ? $_SESSION['yith_wcwl_products'] : array(); }
						  
		do_action( 'yith_wcwl_before_wishlist_title' );
		    
		$wishlist_title = get_option( 'yith_wcwl_wishlist_title' );
		if( !empty( $wishlist_title ) ) {		
		$wishlist_output .= '<div class="bag-header">'.$wishlist_title.'</div>';
		}
		$wishlist_output .= '<div class="bag-contents">';
		
		$wishlist_output .= do_action( 'yith_wcwl_before_wishlist' );
          
        if ( count( $wishlist ) > 0 ) :
           	
           	foreach( $wishlist as $values ) :   
                
                if ($count_limit < 4) {
                
	                if( !is_user_logged_in() ) {
	    				if( isset( $values['add-to-wishlist'] ) && is_numeric( $values['add-to-wishlist'] ) ) {
	    					$values['prod_id'] = $values['add-to-wishlist'];
	    					$values['ID'] = $values['add-to-wishlist'];
	    				} else {
	    					$values['prod_id'] = $values['product_id'];
	    					$values['ID'] = $values['product_id'];
	    				}
	    			}
	                                 
	                $product_obj = get_product( $values['prod_id'] );
	                
	                if( $product_obj !== false && $product_obj->exists() ) : 
	                
	                $wishlist_output .= '<div id="wishlist-'.$values['ID'].'" class="bag-product clearfix">';
	                
	                if ( has_post_thumbnail($product_obj->id) ) {
	                	$image_link  		= wp_get_attachment_url( get_post_thumbnail_id($product_obj->id) );                        	
	                	$image = aq_resize( $image_link, 70, 70, true, false);
	                	
	                	if ($image) {
	                		$wishlist_output .= '<figure><a class="bag-product-img" href="'.esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ).'"><img itemprop="image" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" /></a></figure>';                      
	                	}            			
	                } 
	               		                
	                $wishlist_output .= '<div class="bag-product-details">';
	                $wishlist_output .= '<div class="bag-product-title"><a href="'.esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ).'">'. apply_filters( 'woocommerce_in_cartproduct_obj_title', $product_obj->get_title(), $product_obj ) .'</a></div>';
	                
	                if( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' ) {
	                $wishlist_output .= '<div class="bag-product-price">'.apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price_excluding_tax() ), $values, '' ).'</div>';
	               	} else {
	               	$wishlist_output .= '<div class="bag-product-price">'.apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price() ), $values, '' ).'</div>';
	                }  
	                $wishlist_output .= '</div>';                  
	                $wishlist_output .= '</div>';
	                
	                endif;
					
					$count_limit++;
				}
								
            endforeach;

        else :
            $wishlist_output .= '<div class="wishlist-empty">'. __( 'Your wishlist is currently empty.', 'swiftframework' ) .'</div>';
        endif;
        
        $wishlist_output .= '</div>';

		$wishlist_output .= '<div class="bag-buttons">';
		
		$wishlist_output .= '<a class="sf-roll-button shop-button" href="'.$yith_wcwl->get_wishlist_url().'"><span>'.__('Go to your wishlist', 'swiftframework').'</span><span>'.__('Go to your wishlist', 'swiftframework').'</span></a>';
		            	                
		$wishlist_output .= '</div>';
		
		
 		do_action( 'yith_wcwl_after_wishlist' );
 				
		$wishlist_output .= '</div>';                                                                                                          
		$wishlist_output .= '</li>';
		$wishlist_output .= '</ul>';                                                                                                          
		$wishlist_output .= '</li>'; 
				
		return $wishlist_output;
	}
?>