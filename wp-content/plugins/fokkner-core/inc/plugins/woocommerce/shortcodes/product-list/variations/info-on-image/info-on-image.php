<?php

if ( ! function_exists( 'fokkner_core_add_product_list_variation_info_on_image' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function fokkner_core_add_product_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'fokkner-core' );

		return $variations;
	}

	add_filter( 'fokkner_core_filter_product_list_layouts', 'fokkner_core_add_product_list_variation_info_on_image' );
}

if ( ! function_exists( 'fokkner_core_register_shop_list_info_on_image_actions' ) ) {
	/**
	 * Function that override product item layout for current variation type
	 */
	function fokkner_core_register_shop_list_info_on_image_actions() {

		// Add additional tags around product list item
		add_action( 'woocommerce_before_shop_loop_item', 'fokkner_add_product_list_item_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
		add_action( 'woocommerce_after_shop_loop_item', 'fokkner_add_product_list_item_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

		// Add additional tags around product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'fokkner_add_product_list_item_image_holder', 5 ); // permission 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'fokkner_add_product_list_item_image_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 10

		// Add additional tags around content inside product list item image
		add_action( 'woocommerce_before_shop_loop_item_title', 'fokkner_add_product_list_item_additional_image_holder', 15 ); // permission 15 is set because woocommerce_template_loop_product_thumbnail hook is added on 10
		add_action( 'woocommerce_before_shop_loop_item_title', 'fokkner_add_product_list_item_additional_image_holder_end', 25 ); // permission 25 is set because fokkner_add_product_list_item_image_holder_end hook is added on 30

		// Change title position on product list
		remove_action( 'woocommerce_shop_loop_item_title', 'fokkner_woo_shop_loop_item_title', 10 ); // permission 10 is default
		add_action( 'woocommerce_before_shop_loop_item_title', 'fokkner_woo_shop_loop_item_title', 17 ); // permission 17 is set because fokkner_add_product_list_item_additional_image_holder hook is added on 15

		// Change price position on product list
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 ); // permission 10 is default
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 19 ); // permission 19 is set because fokkner_woo_shop_loop_item_title hook is added on 17

		// Add product categories on list
		//add_action( 'woocommerce_shop_loop_item_title', 'fokkner_add_product_list_item_categories', 18 ); // permission 8 is set to be before woocommerce_template_loop_product_title hook it's added on 10

		// Change add to cart position on product list
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // permission 10 is default
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 ); // permission 20 is set because fokkner_add_product_list_item_additional_image_holder hook is added on 15
	}

	add_action( 'fokkner_core_action_shop_list_item_layout_info-on-image', 'fokkner_core_register_shop_list_info_on_image_actions' );
}