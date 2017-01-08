<?php

function woo_add_continue_shopping_button_to_cart() {
    $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
    echo '<div class="pull-right"><a href="'.$shop_page_url.'">';
    echo 'Czegoś brakuje? → Wróć do sklepu';
    echo '</a></div>';
}

add_action( 'woocommerce_after_cart_table', 'woo_add_continue_shopping_button_to_cart' );
//
//function custom_store_pickup_field( $fields ) {
//      $fields['billing']['store_pickup'] = array(
//            'type'     => 'select',
//            'options'  => array(
//                'option_1' => 'Option 1 text',
//                'option_2' => 'Option 2 text',
//                 'option_3' => 'Option 2 text'
//            ),
//            'label'     => __('Store Pick Up Location', 'woocommerce'),
//            'required'  => false,
//            'class'     => array('store-pickup form-row-wide'),
//            'clear'     => true
//     );
//
//     return $fields;
//}
//
//add_filter( 'woocommerce_checkout_fields' , 'custom_store_pickup_field');

function payment_methods_info( $fields ) {
      echo '<div>';
      echo '<p>Jeśli nie wiesz jaki paczkomat wybrać kliknij ';
      echo '<a target="_about:blank" href="https://twoj.inpost.pl/pl/znajdz-punkt-inpost">&gt;&gt;&gt;TUTAJ&lt;&lt;&lt;</a></p>';
}
add_action( 'woocommerce_checkout_before_order_review', 'payment_methods_info');

// define the woocommerce_bacs_accounts callback
function filter_woocommerce_bacs_account_fields( $this_account_details ) {
    unset($this_account_details['iban']);
    unset($this_account_details['bic']);
    return $this_account_details;
}

// add the filter
add_filter( 'woocommerce_bacs_account_fields', 'filter_woocommerce_bacs_account_fields', 10, 1 );

?>