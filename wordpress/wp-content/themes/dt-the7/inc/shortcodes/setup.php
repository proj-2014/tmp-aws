<?php
/**
 * Shortcodes setup.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// TinyMCE button class
require_once( trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'class-register-button.php' );	

// Shortcode class
require_once( trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'class-shortcode.php' );

/**
 * Some shortcodes triks.
 * From: http://www.viper007bond.com/2009/11/22/wordpress-code-earlier-shortcodes/
 */
function dt_get_puny_shortcodes() {
	$puny_shortcodes = array(
		'dt_gap'			=> array( DT_Shortcode_Gap::get_instance(), 'shortcode' ),
		'dt_divider'		=> array( DT_Shortcode_Divider::get_instance(), 'shortcode' ),
		'dt_stripe'			=> array( DT_Shortcode_Stripe::get_instance(), 'shortcode' ),
		'dt_box'			=> array( DT_Shortcode_Box::get_instance(), 'shortcode' ),
		'dt_cell'			=> array( DT_Shortcode_Columns::get_instance(), 'shortcode_cell' ),
		'dt_code'			=> array( DT_Shortcode_Code::get_instance(), 'shortcode_prepare' ),

		'dt_toggle'			=> array( DT_Shortcode_Toggles::get_instance(), 'shortcode' ),
		'dt_item'			=> array( DT_Shortcode_Accordion::get_instance(), 'shortcode_item' ),

		'dt_benefits'		=> array( DT_Shortcode_Benefits::get_instance(), 'shortcode_benefits' ),
		'dt_benefit'		=> array( DT_Shortcode_Benefits::get_instance(), 'shortcode_benefit' ),

		'dt_progress_bars'	=> array( DT_Shortcode_ProgressBars::get_instance(), 'shortcode_bars' ),
		'dt_progress_bar'	=> array( DT_Shortcode_ProgressBars::get_instance(), 'shortcode_bar' ),

		'dt_button'			=> array( DT_Shortcode_Button::get_instance(), 'shortcode' ),
		'dt_teaser'			=> array( DT_Shortcode_Teaser::get_instance(), 'shortcode' ),
		'dt_call_to_action'	=> array( DT_Shortcode_CallToAction::get_instance(), 'shortcode' ),
		'dt_fancy_image'	=> array( DT_Shortcode_FancyImage::get_instance(), 'shortcode' ),

		'dt_list_item'		=> array( DT_Shortcode_List::get_instance(), 'shortcode_item' ),
		'dt_list'			=> array( DT_Shortcode_List::get_instance(), 'shortcode_list' ),

		'dt_quote'			=> array( DT_Shortcode_Quote::get_instance(), 'shortcode' ),
		'dt_banner'			=> array( DT_Shortcode_Banner::get_instance(), 'shortcode' ),
		'dt_accordion'		=> array( DT_Shortcode_Accordion::get_instance(), 'shortcode_accordion' ),
		'dt_text'			=> array( DT_Shortcode_AnimatedText::get_instance(), 'shortcode' ),

		'dt_social_icons'	=> array( DT_Shortcode_SocialIcons::get_instance(), 'shortcode_icons_content' ),
		'dt_social_icon'	=> array( DT_Shortcode_SocialIcons::get_instance(), 'shortcode_icon' ),

		'dt_vc_list_item'	=> array( DT_Shortcode_List_Vc::get_instance(), 'shortcode_item' ),
		'dt_vc_list'		=> array( DT_Shortcode_List_Vc::get_instance(), 'shortcode_list' ),
		// 'dt_benefits_vc'	=> array( DT_Shortcode_Benefits_Vc::get_instance(), 'shortcode' ),
	);

	return apply_filters( 'dt_get_puny_shortcodes', $puny_shortcodes );
}

/**
 * Actual processing of the shortcode happens here.
 */
function dt_run_puny_shortcode( $content ) {
	global $shortcode_tags;
/*
	echo "<!-- start\n";
	echo implode( ",\n", array_keys($shortcode_tags) );
	echo "\n-->";
*/
	// Backup current registered shortcodes and clear them all out
	$orig_shortcode_tags = $shortcode_tags;
	remove_all_shortcodes();

	foreach ( dt_get_puny_shortcodes() as $shortcode=>$callback ) {
		add_shortcode( $shortcode, $callback );
	}

	// Do the shortcode (only the one above is registered)
	$content = do_shortcode( shortcode_unautop($content) );

	// Put the original shortcodes back
	$shortcode_tags = $orig_shortcode_tags;

	return $content;
}
add_filter( 'the_content', 'dt_run_puny_shortcode', 7 );

// some new stuff from https://gist.github.com/bitfade/4555047
// add_filter("the_content", "dt_the_content_filter");

function dt_the_content_filter( $content ) {

	$shortcodes = array(
		'gallery',
		'layerslider_vc',
		'rev_slider_vc',
		'dt_cell',
		'dt_box',
		'dt_gap',
		'dt_divider',
		'dt_stripe',
		'dt_fancy_image',
		'dt_list_item',
		'dt_list',
		'dt_button',
		'dt_tooltip',
		'dt_highlight',
		'dt_code',
		'dt_code_final',
		'dt_tab',
		'dt_tabs',
		'dt_item',
		'dt_accordion',
		'dt_toggle',
		'dt_quote',
		'dt_call_to_action',
		'dt_teaser',
		'dt_banner',
		'dt_benefits',
		'dt_benefit',
		'dt_progress_bars',
		'dt_progress_bar',
		'dt_contact_form',
		'dt_social_icons',
		'dt_social_icon',
		'dt_map',
		'dt_blog_posts_small',
		'dt_blog_posts',
		'dt_portfolio',
		'dt_portfolio_jgrid',
		'dt_portfolio_slider',
		'dt_small_photos',
		'dt_slideshow',
		'dt_team',
		'dt_testimonials',
		'dt_logos',
		'dt_text',
		'dt_vc_list_item',
		'dt_vc_list',
		'dt_benefits_vc',
		'dt_fancy_video_vc'
	);

	// array of custom shortcodes requiring the fix 
	$block = join("|",$shortcodes);

	// opening tag
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

	// closing tag
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

	// from me with love
	$rep = preg_replace( "/\](\r?\n|\r)?\[/", "][", $rep );
/*
	echo "<!--\n";
	echo $content;
	echo '------------------------------------------------------------';
	echo $rep;
	echo "\n-->";
*/
	return $rep;
}