<?php

$options = array (

			array(
					"name"	=> __("Select Your Contact Page",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_contact_page",
					"options" => RTTheme::rt_get_pages(),	
					"desc" => __("Select a page to use as a contact page.",'rt_theme_admin'),
					"select" 	=> __("Select a page",'rt_theme_admin'),
					"type" 	=> "select"
				),
			
			array(
					"name" => __("CONTACT DETAILS",'rt_theme_admin'),
					"type" => "heading"),

			array(
					"name" => __("Turn on/off the Contact Details Column",'rt_theme_admin'),
					"id" => THEMESLUG."_details_active",
					"type" => "checkbox",
					"hr" => "true",	
					"default" => "checked"),
			
			array(
					"name" => __("Title for contact details column",'rt_theme_admin'),
					"id" => THEMESLUG."_contact_title",
					"default"=> "Contact Details",
					"hr" => "true",	
					"type" => "text"),
			
			array(
					"name" => __("Text",'rt_theme_admin'),
					"id" => THEMESLUG."_contact_text",
					"hr" => "true",	
					"type" => "textarea"),
			
			array(
					"name" => __("Address",'rt_theme_admin'),
					"id" => THEMESLUG."_address",
					"hr" => "true",		
					"type" => "text"),

			array(
					"name" => __("Phone",'rt_theme_admin'),
					"id" => THEMESLUG."_phone",
					"hr" => "true",		
					"type" => "text"),

			array(
					"name" => __("Email",'rt_theme_admin'),
					"id" => THEMESLUG."_email_contact",
					"hr" => "true",		
					"type" => "text"),

			array(
					"name" => __("Support Email",'rt_theme_admin'),
					"id" => THEMESLUG."_support_email",
					"hr" => "true",		
					"type" => "text"),

			array(
					"name" => __("Fax",'rt_theme_admin'),
					"id" => THEMESLUG."_fax",	
					"type" => "text"),

			array(
					"name" => __("CONTACT FORM",'rt_theme_admin'), 
					"type" => "heading"), 

			array(
					"name" => __("Turn on/off the Contact Form",'rt_theme_admin'),
					"id" => THEMESLUG."_contact_form_active",
					"type" => "checkbox",
					"hr" => "true",	
					"default" => "checked"),
			
			array(
					"name" => __("Title for contact form column",'rt_theme_admin'),
					"id" => THEMESLUG."_contact_form_title",
					"default"=> "Contact Form",
					"type" => "text"),

			array(
					"name" => __("Contact Form Email",'rt_theme_admin'),
					"desc" => __("the contact form will be submited this email",'rt_theme_admin'),
					"id" => THEMESLUG."_contact_email",
					"default"	=> get_option('admin_email'),
					"type" => "text",
					"hr" => "true"),

			array(
					"name" => __("3rd Party Contact Form Plugin",'rt_theme_admin'),
					"desc" => __('You are free to use 3rd party contact form plugins on the contact page. There are some great contact form plugins on the <a href="http://wordpress.org/extend/plugins/">WordPress plugins page</a> like <a href="http://wordpress.org/extend/plugins/contact-form-7/">Contact Form 7</a>. Paste the plugin shortcode in the box below to use it instead of the default form.','rt_theme_admin'),
					"id" => THEMESLUG."_third_party_plugin",
					"type" => "textarea"),
			
			array(
					"name" => __("GOOGLE MAP",'rt_theme_admin'), 
					"type" => "heading"), 
			
			array(
					"name" => __("Map Code",'rt_theme_admin'),
					"desc" => __('Map code width must be 640px and recommended height is 200px. You can generate your own map code from <a href="http://maps.google.com">http://maps.google.com</a> Click the link icon top of the Google Maps page then click "Customize and preview embedded map" link on the pop-up page.','rt_theme_admin'),
					"id" => THEMESLUG."_map_code",
					"default" => '<iframe width="640" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=tr&amp;geocode=&amp;q=New+Yourk+Prime,+Myrtle+Beach,+SC,+United+States&amp;aq=1&amp;sll=37.0625,-95.677068&amp;sspn=45.149289,85.429688&amp;ie=UTF8&amp;hq=New+Yourk+Prime,&amp;hnear=Myrtle+Beach,+Horry,+G%C3%BCney+Karolina&amp;ll=33.712917,-78.868618&amp;spn=0.028559,0.109863&amp;z=13&amp;output=embed"></iframe>',
					"type" => "textarea"),				
); 
?>