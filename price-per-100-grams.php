<?php
/**
 * Plugin Name: Price Per 100 Grams
 * Plugin URI: https://omarideh.com/wp-plugins
 * Description: Just Activate - No Options Needed - Show WooCommerce Product Price Per 100 gram on single product page and single category page if the product weight is equal or less than 250 grams, if more than that it will show the price per 1kg. It also works on sale products and it will change the price dynamically when sale date ends. You can access them through targeting class names : "price_per_100_single" and "price_per_100_category". FREE PLUGIN - show support rate 5 stars and share :).
 * Version: 1.0
 * Author: Omar Dieh
 * Author URI: https://omardieh.com
 */

 // single product page
add_action ('woocommerce_single_product_summary', 'price_per_100gm', 20);
function price_per_100gm() {
	global $product;
	$weight = $product->get_weight();

	global  $woocommerce;
	$currency = get_woocommerce_currency_symbol();

	$weight_unit = get_option('woocommerce_weight_unit');
	$gram_text = ' / 100'.$weight_unit.'';

	$unit_price = 0;
	if( $product->is_on_sale() ) {
    $unit_price = $product->get_sale_price();
	}
	else {
		$unit_price = $product->get_regular_price();
	}

		
	if ( $product->has_weight() && $product->get_weight() != "-" && $product->get_weight() <= 250 ) {
	echo '<p class="price_per_100_single"> '.esc_attr(round($unit_price / $weight *100, 2) .$currency .$gram_text).'</p>'.PHP_EOL;
	};
	
	if ( $product->has_weight() && $product->get_weight() != "-" && $product->get_weight() > 250 ) {
	echo '<p class="price_per_100_single"> '.esc_attr(round($unit_price / $weight *1000, 2) .$currency .' / 1kg').'</p>'.PHP_EOL;
	};
}

 // single category page
add_action( 'woocommerce_after_shop_loop_item', 'rs_price_per_100gm', 10 );
function rs_price_per_100gm() {
    global $product;
	$weight = $product->get_weight();

	global  $woocommerce;
	$currency = get_woocommerce_currency_symbol();

	$weight_unit = get_option('woocommerce_weight_unit');
	$gram_text = ' / 100'.$weight_unit.'';
	
	$unit_price = 0;
	if( $product->is_on_sale() ) {
    $unit_price = $product->get_sale_price();
	}
	else {
		$unit_price = $product->get_regular_price();
	}
	
    if ( $product->has_weight() && $product->get_weight() != "-" && $product->get_weight() <= 250 ) {
	echo '<p class="price_per_100_category"> '.esc_attr(round($unit_price / $weight *100, 2) .$currency .$gram_text).'</p>'.PHP_EOL;
	};
	
	if ( $product->has_weight() && $product->get_weight() != "-" && $product->get_weight() > 250 ) {
	echo '<p class="price_per_100_category"> '.esc_attr(round($unit_price / $weight *1000, 2) .$currency .' / 1kg').'</p>'.PHP_EOL;
	};
}