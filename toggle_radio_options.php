<!-- this code opens up separate options based on whether a customer chooses a single purchase or a subscription using the radio buttons. -->

<!-- Add this section to your scripts/custom.js file -->

// Custom show/hide toggle for Subscribe all of the things single product
	$('.wcsatt-toggle input[name="wcsatt-toggle"]').on('change', function(event) {
		event.preventDefault();
		
		var $selectedInput = $('.wcsatt-toggle input[name="wcsatt-toggle"]:checked');
		var uid = $selectedInput.closest('.wcsatt-toggle').data('rel');
		var selectedValue = $selectedInput.val();
		var $subscriptionOptionsWrap = $( '#wcsatt-toggle-' + uid );

		if( 'subscription' === selectedValue ) {
			$subscriptionOptionsWrap.show();
			$("#wcsatt-options-product-" + uid).val( $("#wcsatt-options-product-" + uid + " option:eq(1)").val() );
		}
		else {
			$subscriptionOptionsWrap.hide();
			$("#wcsatt-options-product-" + uid).val( $("#wcsatt-options-product-" + uid + " option:eq(0)").val() );
		}
	});	


<!-- Replace the product_subscription-options.php file in woocommerce subscriptions with this template. -->

<?php
/**
 * Single-Product Subscription Options Template.
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/product-subscription-options.php'.
 *
 * On occasion, this template file may need to be updated and you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * We try to do this as little as possible, but it does happen.
 * When this occurs the version of the template file will be bumped and the readme will list any important changes.
 *
 * @version 2.1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wcsatt_uid = uniqid();
?>

<div class="wcsatt-options-wrapper" <?php echo count( $options ) === 1 ? 'style="display:none;"' : '' ?>>

	<div class="wcsatt-toggle" data-rel="<?= $wcsatt_uid ?>">
		<label for="wcsatt-toggle-single">
			<input type="radio" id="wcsatt-toggle-single" name="wcsatt-toggle" value="single" checked> Single Purchase
		</label>
		<label for="wcsatt-toggle-subscription">
			<input type="radio" id="wcsatt-toggle-subscription" name="wcsatt-toggle" value="subscription"> Auto-Ship
		</label>
	</div>
	
	<div id="wcsatt-toggle-<?= $wcsatt_uid ?>" style="display: none">
		<?php
		if ( $prompt ) {
			echo $prompt;
		} else {
			?><h3><?php
				_e( 'Choose a subscription plan:', 'woocommerce-subscribe-all-the-things' );
			?></h3><?php
		}
		?>

		<select class="wcsatt-options-product" id="wcsatt-options-product-<?= $wcsatt_uid ?>" name="convert_to_sub_<?php echo absint( $product_id ); ?>"><?php
			foreach ( $options as $option ) {
				?><option class="<?php echo esc_attr( $option[ 'class' ] ); ?>" data-custom_data="<?php echo esc_attr( json_encode( $option[ 'data' ] ) ); ?>" value="<?php echo esc_attr( $option[ 'value' ] ); ?>" <?php selected( $option[ 'selected' ], true, true ); ?> >
						<?php echo '<span class="' . esc_attr( $option[ 'class' ] ) . '-details">' . $option[ 'description' ] . '</span>'; ?>
				</option><?php
			}
		?></select>
	</div>
</div>