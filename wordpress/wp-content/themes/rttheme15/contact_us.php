<?php
/* 
* rt-theme Contact Us Page
*/

#
#	Contact Page Options 
$map_code 				= get_option(THEMESLUG.'_map_code');
$contact_title			= wpml_t(THEMESLUG, 'Contact - Title', get_option(THEMESLUG.'_contact_title'));
$contact_text 			= wpml_t(THEMESLUG, 'Contact - Text', get_option(THEMESLUG.'_contact_text'));
$address 				= wpml_t(THEMESLUG, 'Contact - Address', get_option(THEMESLUG.'_address'));
$phone 					= wpml_t(THEMESLUG, 'Contact - Phone', get_option(THEMESLUG.'_phone'));
$email 					= wpml_t(THEMESLUG, 'Contact - Email', get_option(THEMESLUG.'_email_contact'));
$support_email 			= wpml_t(THEMESLUG, 'Contact - Support Email', get_option(THEMESLUG.'_support_email'));
$fax 					= wpml_t(THEMESLUG, 'Contact - Fax', get_option(THEMESLUG.'_fax'));
$link_for_map 			= wpml_t(THEMESLUG, 'Contact - Link for Map', get_option(THEMESLUG.'_link_for_map'));
$contact_form_title 	= wpml_t(THEMESLUG, 'Contact - Contact Form Title', get_option(THEMESLUG.'_contact_form_title'));
$contact_email 			= wpml_t(THEMESLUG, 'Contact - Contact Form Email', get_option(THEMESLUG.'_contact_email'));
$third_party_plugin		= get_option(THEMESLUG.'_third_party_plugin');
$contact_form_active	= get_option(THEMESLUG.'_contact_form_active');
$contact_details_active	= get_option(THEMESLUG.'_details_active'); 

?>
		

	<!-- Google Map-->
	<?php
	if($map_code) echo $map_code.'<div class="bold_line"></div>';
	?>
	
	<?php
	if ($contact_form_active && $contact_details_active){
		echo '<div class="box two first">';
	}elseif ($contact_form_active || $contact_details_active){
		echo '<div class="box full first">';
	}
	?>
	
		<?php if ($contact_details_active):?>
			<!-- Contact Details -->
			<?php if($contact_title) echo '<h5>'.$contact_title.'</h5><div class="bold_line"></div>';?>
			<?php if($contact_text) echo '<p>'.$contact_text.'</p>';?>
		
			<ul class="contact_list">
				<?php if($address) echo '<li class="home">'.$address.'</li>';?>
				<?php if($phone) echo '<li class="phone">'.$phone.'</li>';?>
				<?php if($fax) echo '<li class="fax">'.$fax.'</li>';?>
				<?php if($email) echo '<li class="mail"><a href="mailto:'.$email.'">'.$email.'</a></li>';?>
				<?php if($support_email) echo '<li class="help"><a href="mailto:'.$support_email.'">'.$support_email.'</a></li>';?>
			</ul>
		<?php endif;?>
	
	<?php
	if ($contact_form_active && $contact_details_active){
		echo '</div><div class="box two last">'; 
	}elseif ($contact_details_active && !$contact_form_active){
		echo '</div>';
	}

		if ($contact_form_active){
	
			if($contact_form_title) echo '<h5>'.$contact_form_title.'</h5><div class="bold_line"></div>';
	
			//Default Contact Form
			if($contact_form_active && $contact_email && !$third_party_plugin){			
				echo	do_shortcode('[contact_form email="'.$contact_email.'"]');
			}
		
			//3rd Party Contact Form Plugins
			if($third_party_plugin){
				echo	do_shortcode($third_party_plugin);
			}
		}

	if ($contact_form_active){
		echo '</div>';
	}
	?>

	<div class="clear"></div>  
 