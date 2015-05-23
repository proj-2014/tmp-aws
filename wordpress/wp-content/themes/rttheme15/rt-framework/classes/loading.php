<?php
#-----------------------------------------
#	RT-Theme loading.php
#	version: 1.0
#-----------------------------------------

#
# 	Load the theme
#

class RTTheme{
	 
	
	//Cufon Font Files
	public $fonts=array(
				"Aller_Light_400.font" =>  array("Aller Light","Aller Light"),
				"bebas-neue.cufonfonts" =>  array("Bebas Neue","Bebas Neue"), 
				"Cicle_400.font" => array("Cicle","Cicle"),
				"Comfortaa.font" => array("Comfortaa","Comfortaa"),
				"ColaborateLight_400.font" => array("ColaborateLight","Colaborate Light"), 
				"Diavlo.font" => array("Diavlo","Diavlo"),
				"Droid_Serif_400.font" => array("Droid Serif","Droid Serif"),  
				"PT_Sans_400.font" => array("PT Sans","PT Sans"),
				"Museo.font" => array("Museo","Museo Normal"),
				"Museo.light.font" => array("Museo Light","Museo Light"),
				"Sansation.light.font" => array("Sansation Light","Sansation Light"),
				"Sansation.font" => array("Sansation","Sansation Normal"), 
				"TitilliumText22L_Lt_300.font" => array("TitilliumText22L Lt","Titillium Text"),
				"Vegur_300.font" => array("Vegur-Light","Vegur Light"),  
				);
	
	//Google Font Files
	public $google_fonts=array( 
				"Cabin+Condensed" => array("Cabin Condensed","Cabin Condensed"),
				"Cagliostro" => array("Cagliostro","Cagliostro"),
				"Lemon" => array("Lemon","Lemon"),
				"Aguafina+Script" => array("Aguafina Script","Aguafina Script"),
				"Iceland" => array("Iceland","Iceland"),
				"Signika" => array("Signika","Signika"),
				"Prociono" => array("Prociono","Prociono"),
				"Arapey" => array("Arapey","Arapey"),
				"Convergence" => array("Convergence","Convergence"),
				"Rammetto+One" => array("Rammetto One","Rammetto One"),
				"Linden+Hill" => array("Linden Hill","Linden Hill"),
				"Dorsa" => array("Dorsa","Dorsa"),
				"Merienda+One" => array("Merienda One","Merienda One"),
				"Petrona" => array("Petrona","Petrona"),
				"Nova+Square" => array("Nova Square","Nova Square"),
				"Jockey+One" => array("Jockey One","Jockey One"),
				"Antic" => array("Antic","Antic"),
				"Abel" => array("Abel","Abel"),
				"Nova+Flat" => array("Nova Flat","Nova Flat"),
				"Sansita+One" => array("Sansita One","Sansita One"),
				"Marvel" => array("Marvel","Marvel"),
				"Ubuntu+Condensed" => array("Ubuntu Condensed","Ubuntu Condensed"),
				"Rationale" => array("Rationale","Rationale"),
				"Anton" => array("Anton","Anton"),
				"Michroma" => array("Michroma","Michroma"),
				"Paytone+One" => array("Paytone One","Paytone One"), 
				"Expletus+Sans" => array("Expletus Sans","Expletus Sans"),
				"Orbitron" => array("Orbitron","Orbitron"),
				"Gruppo" => array("Gruppo","Gruppo"),
				"Chewy" => array("Chewy","Chewy"),
				"Wire+One" => array("Wire One","Wire One"),
				"Aclonica" => array("Aclonica","Aclonica"),
				"Damion" => array("Damion","Damion"),
				"Swanky+and+Moo+Moo" => array("Swanky and Moo Moo","Swanky and Moo Moo"),
				"News+Cycle" => array("News Cycle","News Cycle"),
				"Over+the+Rainbow" => array("Over the Rainbow","Over the Rainbow"),
				"Wallpoet" => array("Wallpoet","Wallpoet"),
				"Special+Elite" => array("Special Elite", "Special Elite"),
				"MedievalSharp" => array("MedievalSharp","MedievalSharp"),
				"Waiting+for+the+Sunrise" => array("Waiting for the Sunrise","Waiting for the Sunrise"),
				"Quattrocento+Sans" => array("Quattrocento Sans","Quattrocento Sans"),
				"The+Girl+Next+Door" => array("The Girl Next Door","The Girl Next Door"),
				"Nova+Slim" => array("Nova Slim","Nova Slim"),
				"Smythe" => array("Smythe","Smythe"),
				"Miltonian+Tattoo" => array("Miltonian Tattoo","Miltonian Tattoo"),
				"Kristi" => array("Kristi","Kristi"),
				"Sue+Ellen+Francisco" => array("Sue Ellen Francisco","Sue Ellen Francisco"),
				"Bangers" => array("Bangers","Bangers"),
				"Terminal+Dosis+Light" => array("Terminal Dosis Light","Terminal Dosis Light"),
				"Annie+Use+Your+Telescope" => array("Annie Use Your Telescope","Annie Use Your Telescope"),
				"EB+Garamond" => array("EB Garamond","EB Garamond"),
				"EB+Garamond&subset=cyrillic,latin" => array("EB Garamond","EB Garamond Cyrillic"),
				"Irish+Grover" => array("Irish Grover","Irish Grover"),
				"Dawning+of+a+New+Day" => array("Dawning of a New Day","Dawning of a New Day"),
				"Crimson+Text" => array("Crimson Text","Crimson Text"),
				"Quattrocento" => array("Quattrocento","Quattrocento"),
				"Expletus+Sans" => array("Expletus Sans","Expletus Sans"),
				"Maiden+Orange" => array("Maiden Orange","Maiden Orange"),
				"Sniglet:800" => array("Sniglet","Sniglet"),
				"Astloch" => array("Astloch","Astloch"),
				"Pacifico" => array("Pacifico","Pacifico"),
				"Indie+Flower" => array("Indie Flower","Indie Flower"),
				"VT323" => array("VT323","VT323"),
				"Vollkorn" => array("Vollkorn","Vollkorn"),
				"Architects+Daughter" => array("Architects Daughter","Architects Daughter"),
				"Michroma" => array("Michroma","Michroma"),
				"Anton" => array("Anton","Anton"),
				"Bevan" => array("Bevan","Bevan"),
				"Allan:bold" => array("Allan","Allan"),
				"Kenia" => array("Kenia","Kenia"),
				"Six+Caps" => array("Six Caps","Six Caps"),
				"Lekton" => array("Lekton","Lekton"),
				"UnifrakturMaguntia" => array("UnifrakturMaguntia","UnifrakturMaguntia"),
				"Oswald&v1" => array("Oswald","Oswald"),
				"Oswald&subset=latin,latin-ext" => array("Oswald","Oswald Latin Extended"),
				"League+Script" => array("League Script","League Script"),
				"Orbitron" => array("Orbitron","Orbitron"),
				"Cuprum" => array("Cuprum","Cuprum"),
				"Cabin" => array("Cabin","Cabin"),
				"Philosopher" => array("Philosopher","Philosopher"),
				"Walter+Turncoat" => array("Walter Turncoat","Walter Turncoat"),
				"Candal" => array("Candal","Candal"),
				"Cabin+Sketch:bold" => array("Cabin Sketch","Cabin Sketch"),
				"Droid+Sans+Mono" => array("Droid Sans Mono","Droid Sans Mono"),
				"Calligraffitti" => array("Calligraffitti","Calligraffitti"),
				"Neucha" => array("Neucha","Neucha"),
				"Rock+Salt" => array("Rock Salt","Rock Salt"),
				"Lato" => array("Lato","Lato"),
				"Luckiest+Guy" => array("Luckiest Guy","Luckiest Guy"),
				"Mountains+of+Christmas" => array("Mountains of Christmas","Mountains of Christmas"),
				"Raleway:100" => array("Raleway","Raleway"),
				"Geo" => array("Geo","Geo"),
				"Slackey" => array("Slackey","Slackey"),
				"Corben:bold" => array("Corben","Corben"),
				"Unkempt" => array("Unkempt","Unkempt"),
				"Droid+Sans:400,700&v2" => array("Droid Sans","Droid Sans"),
				"Cherry+Cream+Soda" => array("Cherry Cream Soda","Cherry Cream Soda"),
				"Vibur" => array("Vibur","Vibur"),
				"Gruppo" => array("Gruppo","Gruppo"),
				"Permanent+Marker" => array("Permanent Marker","Permanent Marker"),
				"Coda:800" => array("Coda","Coda"),
				"Cousine" => array("Cousine","Cousine"),
				"Crafty+Girls" => array("Crafty Girls","Crafty Girls"),
				"Schoolbell" => array("Schoolbell","Schoolbell"),
				"Kranky" => array("Kranky","Kranky"),
				"Covered+By+Your+Grace" => array("Covered By Your Grace","Covered By Your Grace"),
				"Syncopate" => array("Syncopate","Syncopate"),
				"PT+Serif" => array("PT Serif","PT Serif"),				
				"PT+Serif&subset=cyrillic,latin" => array("PT Serif","PT Serif Cyrillic"),
				"Josefin+Sans" => array("Josefin Sans","Josefin Sans"),
				"Homemade+Apple" => array("Homemade Apple","Homemade Apple"),
				"Molengo" => array("Molengo","Molengo"),
				"Yanone+Kaffeesatz" => array("Yanone Kaffeesatz","Yanone Kaffeesatz"),
				"Radley" => array("Radley","Radley"),
				"Chewy" => array("Chewy","Chewy"),
				"Neuton" => array("Neuton","Neuton"),
				"Tinos" => array("Tinos","Tinos"),
				"Tangerine" => array("Tangerine","Tangerine"),
				"Allerta" => array("Allerta","Allerta"),
				"PT+Sans" => array("PT Sans","PT Sans"),
				"PT+Sans+Narrow&subset=cyrillic,latin" => array("PT Sans Narrow","PT Sans Narrow Cyrillic"),
				"Inconsolata" => array("Inconsolata","Inconsolata"),
				"Droid+Serif:400,400italic&v2" => array("Droid Serif","Droid Serif"),
				"Sunshiney" => array("Sunshiney","Sunshiney"),
				"Bentham" => array("Bentham","Bentham"),
				"Just+Another+Hand" => array("Just Another Hand","Just Another Hand"),
				"Cardo" => array("Cardo","Cardo"),
				"Cantarell" => array("Cantarell","Cantarell"),
				"OFL+Sorts+Mill+Goudy+TT" => array("OFL Sorts Mill Goudy TT","OFL Sorts Mill Goudy TT"),
				"Ubuntu" => array("Ubuntu","Ubuntu"),
				"Ubuntu&subset=greek,latin" => array("Ubuntu","Ubuntu Greek"),
				"Ubuntu&subset=cyrillic,latin" => array("Ubuntu","Ubuntu Cyrillic"),	
				"Reenie+Beanie" => array("Reenie Beanie","Reenie Beanie"),
				"Arvo" => array("Arvo","Arvo"),
				"Coming+Soon" => array("Coming Soon","Coming Soon"),
				"Josefin+Slab" => array("Josefin Slab","Josefin Slab"),
				"Fontdiner+Swanky" => array("Fontdiner Swanky","Fontdiner Swanky"),
				"Old+Standard+TT" => array("Old Standard TT","Old Standard TT"),
				"Puritan" => array("Puritan","Puritan"),
				"Merriweather" => array("Merriweather","Merriweather"),
				"UnifrakturCook:bold" => array("UnifrakturCook","UnifrakturCook"),
				"Crushed" => array("Crushed","Crushed"),
				"Buda:light" => array("Buda","Buda"),
				"IM+Fell+Great+Primer" => array("IM Fell Great Primer","IM Fell Great Primer"),						
				"Goudy+Bookletter+1911" => array("Goudy Bookletter 1911","Goudy Bookletter 1911"),
				"Nobile" => array("Nobile","Nobile"),
				"Copse" => array("Copse","Copse"),
				"Lobster" => array("Lobster","Lobster"),
				"Allerta+Stencil" => array("Allerta Stencil","Allerta Stencil"),
				"Arimo" => array("Arimo","Arimo"),
				"Meddon" => array("Meddon","Meddon"),
				"Dancing+Script" => array("Dancing Script","Dancing Script"),
				"Just+Me+Again+Down+Here" => array("Just Me Again Down Here","Just Me Again Down Here"),
				"Amaranth" => array("Amaranth","Amaranth"),
				"Anonymous+Pro" => array("Anonymous Pro","Anonymous Pro"),
				"Kreon" => array("Kreon","Kreon"),
				"Carter+One" => array("Carter One","Carter One")				
				);
	
	//Available Social Media Icons
	public $social_media_icons=array(
				"RSS" 		=> "rss",
				"Email" 		=> "email",
				"Twitter"		=> "twitter",
				"Flickr" 		=> "flickr",
				"Facebook" 	=> "facebook", 
				"AIM" 		=> "aim",
				"Apple" 		=> "apple",
				"Appstore" 	=> "appstore",
				"Bing" 		=> "bing",
				"Blogger" 	=> "blogger",
				"Bookmark" 	=> "bookmark",
				"Delicious" 	=> "delicious",
				"Deviantart" 	=> "deviantart",
				"Digg" 		=> "digg",
				"Dribble" 	=> "dribble", 
				"Evernote" 	=> "evernote",
				"Feedburner" 	=> "feedburner",
				"Forrst" 		=> "forrst",
				"Friendfeed" 	=> "friendfeed",
				"Google Plus" 	=> "googleplus",
				"Google" 		=> "google",
				"Google Buzz" 	=> "googlebuzz",
				"GTalk" 		=> "gtalk",
				"Lastfm" 		=> "lastfm",
				"Linkedin" 	=> "linkedin",
				"Messenger" 	=> "messenger",
				"Myspace" 	=> "myspace",
				"Reddit" 		=> "reddit", 
				"Skype" 		=> "skype",
				"Technorati" 	=> "technorati", 
				"Vimeo" 		=> "vimeo",
				"Yahoo" 		=> "yahoo",
				"YouTube" 	=> "youtube",
				"Pinterest" 	=> "pinterest"
				);
				

	function start($v){
		
		global $fonts,$google_fonts,$social_media_icons;
		$fonts = $this->fonts;
		$google_fonts = $this->google_fonts;
		$social_media_icons = $this->social_media_icons;
		

 
		// Load text domain
		load_theme_textdomain('rt_theme', get_template_directory().'/languages' );

		//Call Theme Constants
		$this->theme_constants($v);	  
 
		//Load Classes
		$this->load_classes($v);
		
		//Load Widgets
		$this->load_widgets($v);		
		
		//Load Functions
		$this->load_functions($v);
		
		//Admin Panel Options
		if(is_admin()){		
			require_once (THEMEFRAMEWORKDIR.'/classes/admin.php'); 
			$RTadmin = new RTThemeAdmin();
			$RTadmin -> admin_init();
		}
		
		//Save Default Options
		$this_page_url='http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['SCRIPT_NAME'];
		$option_page_url=WPADMINURI.'admin.php'; 
		if(get_option(THEMESLUG.'_defaults')!='saved' || (@$_GET['reset_settings']=='true') ){ 
			$this->rt_save_defaults($RTadmin);
			if($_GET['reset_settings']=='true') add_action('admin_notices', array(&$this,'reset_message')); 		
		}
		
		//Create Menus 
		add_action('init', array(&$this,'rt_create_menus'));
				
		//Theme Supports
		$this->theme_supports();
	}
	
	
	#
	#	Messages
	#
	
	function reset_message(){
		echo '<div id="notice" class="error"><p>'.__('theme options has been resetted.', 'rt_theme_admin').'</p></div>';
	}   
    
    
	#
	#	Theme Constants
	#
    
	function theme_constants($v) {
		define('THEMENAME', $v['theme']);
		define('THEMESLUG', $v['slug']);
		define('THEMEVERSION', $v['version']); 
		define('THEMEDIR', get_template_directory());
		define('THEMEURI', get_template_directory_uri());
	
		if(function_exists('icl_get_home_url')){
		   define('BLOGURL', icl_get_home_url());
		}else{
		    define('BLOGURL', home_url() );  
		}
	
		define('FRAMEWORKSLUG', 'rt-framework'); 
		define('THEMEFRAMEWORKDIR', get_template_directory().'/rt-framework'); 
		define('THEMEADMINDIR', get_template_directory().'/rt-framework/admin');
		define('THEMEADMINURI', get_template_directory_uri().'/rt-framework/admin');
		define('WPADMINURI', get_admin_url());
		define('BLOGPAGE', get_option('rttheme_blog_page'));
		define('PRODUCTPAGE', get_option('rttheme_product_list'));
		define('PORTFOLIOPAGE', get_option('rttheme_portf_page'));
		define('CONTACTPAGE', get_option('rttheme_contact_page'));
		define('THEMESTYLE', get_option(THEMESLUG."_style"));

		// Constants for notifier
		define( 'NOTIFIER_THEME_FOLDER_NAME', 'rttheme15' );  
		define( 'NOTIFIER_XML_FILE', 'http://templatemints.com/theme_updates/rttheme15/notifier.xml' ); 
		define( 'NOTIFIER_CACHE_INTERVAL', 21600 );
			
	}    
    
	#
	#	Load Functions
	#
    
	function load_functions($v) {
		include(THEMEFRAMEWORKDIR . "/functions/rt_comments.php");
		include(THEMEFRAMEWORKDIR . "/functions/custom_posts.php");
		include(THEMEFRAMEWORKDIR . "/functions/theme_functions.php");
		include(THEMEFRAMEWORKDIR . "/functions/rt_breadcrumb.php");
		include(THEMEFRAMEWORKDIR . "/functions/rt_shortcodes.php");		
		include(THEMEFRAMEWORKDIR . "/functions/wpml_functions.php");
		include(THEMEFRAMEWORKDIR . "/plugins/vt_resize.php");		
		include(THEMEFRAMEWORKDIR . "/functions/custom_styling.php");

		if(!function_exists('dropdown_menu')){		
			include(THEMEFRAMEWORKDIR . "/plugins/dropdown-menus.php");
		}
				
	}

	#
	#	Load Classes
	#
    
	function load_classes($v) {
		
		//Create Sidebars
		include(THEMEFRAMEWORKDIR . "/classes/sidebar_creator.php");  
		$createSidebars = new RT_Create_Sidebars(); 

		//is login or register page		
		$is_login = in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ));

		//Theme
		if(!is_admin() && !$is_login){			
			require_once (THEMEFRAMEWORKDIR.'/classes/theme.php'); 
			$RTThemeSite = new RTThemeSite();
			$RTThemeSite -> theme_init();
		}
	}    	 

	#
	#	Load Widgets
	#
    
	function load_widgets($v) {
		  
		//flickr
		include(THEMEFRAMEWORKDIR . "/widgets/flickr.php");		
		register_widget('Flickr_Widget');

		//recent posts with thumbnails
		include(THEMEFRAMEWORKDIR . "/widgets/latest_posts.php");		
		register_widget('Latest_Posts');

		//recent posts
		include(THEMEFRAMEWORKDIR . "/widgets/latest_posts_2.php");		
		register_widget('Latest_Posts_2'); 

		//popular posts
		include(THEMEFRAMEWORKDIR . "/widgets/popular_posts.php");		
		register_widget('Popular_Posts');
		
		//contact info
		include(THEMEFRAMEWORKDIR . "/widgets/contact_info.php");		
		register_widget('Contact_Info');

		//testimonials
		include(THEMEFRAMEWORKDIR . "/widgets/testimonials.php");		
		register_widget('Testimonials');

		//Recent Posts Gallery
		include(THEMEFRAMEWORKDIR . "/widgets/recent_posts_gallery.php");		
		register_widget('Recent_Posts_Gallery');				
	}
	
	
	#
	#	Save Default Values	
	#
	
	function rt_save_defaults($RTadmin) {
	
		if(is_array($RTadmin->panel_pages)){
			foreach($RTadmin->panel_pages  as $menu_slug => $page_title){
				
				if($menu_slug!="rt_sidebar_options"){			
					include(THEMEADMINDIR . "/options/$menu_slug.php");
		
					if(is_array($options)){
						foreach($options as $k => $v){
							if(@$v['default'] && @!$v['dont_save']) {
								update_option( @$v['id'], stripslashes(@$v['default']));
							}else{
								update_option( @$v['id'], '' );
							}
						}
					}
					
					update_option(THEMESLUG.'_defaults','saved');
				}
			} 
		} 
	}
	
	#
	#	Create WP Menus
	#

	function rt_create_menus() {
		
		register_nav_menu( 'rt-theme-main-navigation', __( 'RT Theme Main Navigation' , 'rt_theme_admin') ); 
		register_nav_menu( 'rt-theme-footer-navigation', __( 'RT Theme Footer Navigation' , 'rt_theme_admin' ));

		wp_create_nav_menu( 'RT Theme Main Navigation Menu', array( 'slug' => 'rt-theme-main-navigation' ) );
		wp_create_nav_menu( 'RT Theme Footer Navigation Menu', array( 'slug' => 'rt-theme-footer-navigation') );
		
	}

	#
	#	Theme Supports
	#
	 
	function theme_supports(){
		//Featured Images
		add_theme_support( 'post-thumbnails', array( 'post','slider','home_page','page') );
		
		//Custom background support
		add_theme_support( 'custom-background' );
		
		//Automatic Feed Links
		add_theme_support( 'automatic-feed-links' );
	}	


	#
	#	Get Pages as array
	#

	public static function rt_get_pages(){
		  
		// Pages		
		$pages = query_posts('posts_per_page=-1&post_type=page&orderby=title&order=ASC');
		$rt_getpages = array();
		
		if(is_array($pages)){
			foreach ($pages as $page_list ) {
				$rt_getpages[$page_list->ID] = $page_list ->post_title;
			}
		}
		
		wp_reset_query();
		return $rt_getpages;
		
	}


	#
	#	Get Blog Categories - only post categories
	#

	public static function rt_get_categories(){

		// Categories
		$args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'category',
			'pad_counts'               => false
			);
		
		
		$categories = get_categories($args);
		$rt_getcat = array();
		
		if(is_array($categories)){
			foreach ($categories as $category_list ) {
				$rt_getcat[$category_list->cat_ID] = $category_list->cat_name;
			}
		}
	
		return $rt_getcat;
	}

	#
	#	Get Product Categories - only product categories
	#

	public static function rt_get_product_categories(){

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'product_categories',
			'pad_counts'               => false
			);
		
		
		$product_categories = get_categories($product_args);
		$rt_product_getcat = array();
		
		if(is_array($product_categories)){
			foreach ($product_categories as $category_list ) {
				@$rt_product_getcat[$category_list->cat_ID] = @$category_list->cat_name;
			}
		}
		
		return $rt_product_getcat;
		
	}

	#
	#	Get Portfolio Categories
	#

	public static function rt_get_portfolio_categories(){

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'portfolio_categories',
			'pad_counts'               => false
			);
		
		
		$portfolio_categories = get_categories($product_args);
		$rt_portfolio_getcat = array(); 
		
		if(is_array($portfolio_categories)){
			foreach ($portfolio_categories as $category_list ) {
				@$rt_portfolio_getcat[$category_list->cat_ID] = @$category_list->cat_name;
			}
		}
		
		return $rt_portfolio_getcat;
		
	}


	#
	#	Get Products
	#

	public static function rt_get_products(){

		
		$products  = query_posts('posts_per_page=-1&post_type=products&orderby=title&order=ASC'); // Products 
		$rt_get_product= array();

		if(is_array($products)){
			foreach ($products as $post_list ) {	// add product posts to the list
				$rt_get_product[$post_list->ID] = $post_list ->post_title;
			}
		}
		
		wp_reset_query();
		return $rt_get_product;
		
	}	
	
}


?>