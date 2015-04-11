<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; $woocommerce_checkout = $woocommerce->checkout();

$woocommerce->show_messages();

$options = get_option('sf_neighborhood_options');

//do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
	if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
		echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
		return;
	}
} else {
	if (get_option('woocommerce_enable_signup_and_login_from_checkout')=="no" && get_option('woocommerce_enable_guest_checkout')=="no" && !is_user_logged_in()) :
		echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce'));
		return;
	endif;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url() );

if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
	if ( $checkout->enable_signup && ! is_user_logged_in() ) { ?>
		<script type='text/javascript'>
		//<![CDATA[ 
		
		jQuery(document).ready(function() {	
			jQuery('#sign-in').show();
			jQuery('a[href="#sign-in"]').addClass('active');
			
		});
		
		//]]>  
		</script>
	<?php } else { ?>
		<script type='text/javascript'>
		//<![CDATA[ 
		
		jQuery(document).ready(function() {
			jQuery('#billing').show();
			jQuery('a[href="#billing"]').addClass('active');
		});
		
		//]]>  
		</script>
	
	<?php } ?>
<?php } else {
	if ( get_option('woocommerce_enable_signup_and_login_from_checkout')=="yes" && ! is_user_logged_in() ) { ?>
		<script type='text/javascript'>
		//<![CDATA[ 
		
		jQuery(document).ready(function() {	
			jQuery('#sign-in').show();
			jQuery('a[href="#sign-in"]').addClass('active');
			
		});
		
		//]]>  
		</script>
	<?php } else { ?>
		<script type='text/javascript'>
		//<![CDATA[ 
		
		jQuery(document).ready(function() {
			jQuery('#billing').show();
			jQuery('a[href="#billing"]').addClass('active');
		});
		
		//]]>  
		</script>
	
	<?php } ?>
<?php } ?>

<script type='text/javascript'>
//<![CDATA[ 

jQuery(document).ready(function() {		
	jQuery('.checkout-process li').on('click', 'a', function(e) {
		e.preventDefault();
		
		jQuery('.checkout-process li .active').removeClass('active');
		jQuery(this).addClass('active');
		
		var targetPaneID = jQuery(this).attr('href');
		changeCheckoutPanel(targetPaneID);
	});
	
	jQuery('.continue-button').on('click', '', function(e) {
		e.preventDefault();
		var target = jQuery(this).attr('data-target');
		continueProcess(target);
	});
	
	jQuery('.guest-button').on('click', function() {
		jQuery('#createaccount').prop('checked', false);
	});
	
	jQuery('.create-account-button').on('click', function() {
		jQuery('#createaccount').prop('checked', true);
	});
	
	function continueProcess(target) {
		jQuery('.checkout-process li .active').removeClass('active');
		jQuery('.checkout-process li a[href="'+ target +'"]').addClass('active');
		changeCheckoutPanel(target);
		jQuery('body,html').animate({scrollTop: 0}, 400);
	}
	
	function changeCheckoutPanel(targetID) {
		jQuery('.checkout-pane').css('display', 'none');
		jQuery(targetID).css('display', 'block');
	}
});

//]]>  
</script>

<?php sf_woo_help_bar(); ?>

<ul class="checkout-process clearfix">
	<li><a href="#sign-in"><?php _e("1. Sign In", "swiftframework"); ?></a></li>
	<li><a href="#billing"><?php _e("2. Billing & Shipping", "swiftframework"); ?></a></li>
	<li><a href="#review"><?php _e("3. Review & Payment", "swiftframework"); ?></a></li>
	<li><p><?php _e("4. Confirmation", "swiftframework"); ?></p></li>
</ul>


<div class="checkout-pane active" id="sign-in" style="display: none;">
	
	<div class="col2-set" id="account_details">
	
		<?php if (!is_user_logged_in()) { ?>
		
		<div class="col-1 login">
			<h4 class="lined-heading"><span><?php _e("I already have an account", "swiftframework"); ?></span></h4>
			<?php
				echo woocommerce_checkout_login_form(
					array(
						'message'  => '',
						'redirect' => get_permalink( woocommerce_get_page_id( 'checkout') ),
						'hidden'   => false
					)
				);
			?>
		</div>
	
		<div class="col-2">
			<h4 class="lined-heading"><span><?php _e("I'm new here", "swiftframework"); ?></span></h4>
			<div class="new-here-text">
				<?php echo $options['checkout_new_account_text']; ?>
			</div>
			<div class="bag-buttons">
				<a id="checkout-create-account" class="sf-roll-button create-account-button" href="#create-account" data-toggle="modal"><span><?php _e('Create an account', 'swiftframework'); ?></span><span><?php _e('Create an account', 'swiftframework'); ?></span></a>
				
				<?php if (get_option('woocommerce_enable_guest_checkout') == "yes") { ?>
				<a class="sf-roll-button guest-button continue-button" href="#" data-target="#billing"><span ><?php _e('Checkout as a guest', 'swiftframework'); ?></span><span><?php _e('Checkout as a guest', 'swiftframework'); ?></span></a>
				<?php } ?>
			</div>
		</div>
		
		<?php } else { ?>
		
		<div class="already-logged-in">
			<p><?php _e("You are already logged in, please continue to the next step.", "swiftframework"); ?></p>
			<a class="sf-roll-button alt-button continue-button" href="#" data-target="#billing"><span ><?php _e('Continue', 'swiftframework'); ?></span><span><?php _e('Continue', 'swiftframework'); ?></span></a>
		</div>
		
		<?php } ?>
			
	</div>
	
</div>
		
<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
	
	<div class="checkout-pane" id="billing" style="display: none;">
	
		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		
		<div class="col2-set" id="customer_details">
	
			<div class="col-1">
	
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
	
			</div>
	
			<div class="col-2">
	
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
	
			</div>
	
		</div>
		
		<div class="proceed clearfix">
			<a class="sf-roll-button alt-button continue-button" href="#" data-target="#review"><span ><?php _e('Proceed with purchase', 'swiftframework'); ?></span><span><?php _e('Proceed with purchase', 'swiftframework'); ?></span></a>
		</div>
	
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
	
	</div>
	
	<div class="checkout-pane" id="review" style="display: none;">
		  	
		<h4 id="order_review_heading" class="lined-heading"><span><?php _e( 'Your order summary', 'swiftframework' ); ?></span></h4>
		
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	
	</div>
	
	<div id="create-account" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="create-account-modal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="create-account-modal"><?php _e("Register", "swiftframework"); ?></h3>
		</div>
		<div class="modal-body">
			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>
		
			<div class="create-account">
						
				<?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>
		
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
		
				<?php endforeach; ?>
		
				<div class="clear"></div>
		
			</div>
		
			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
			
			<a class="sf-roll-button alt-button continue-button" href="" data-dismiss="modal" data-target="#billing"><span ><?php _e("And we're done!", "swiftframework"); ?></span><span><?php _e('Continue', 'swiftframework'); ?></span></a>
	
		</div>
	</div>

</form>

<?php do_action('woocommerce_after_checkout_form'); ?>