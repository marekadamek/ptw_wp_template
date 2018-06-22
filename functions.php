<?php

function woo_add_continue_shopping_button_to_cart() {
    $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
    echo '<div class="pull-right"><a href="'.$shop_page_url.'">';
    echo 'Czegoś brakuje? → Wróć do sklepu';
    echo '</a></div>';
}

add_action( 'woocommerce_after_cart_table', 'woo_add_continue_shopping_button_to_cart' );

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

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 20;' ), 20 );


function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

// PROMOCJA
function bundles_discount(WC_Cart $cart) {
    global $woocommerce;

    $cd1 = false;
    $cd2 = false;
    $tshirt = false;

    foreach ($cart->get_cart() as $item ) {
       $product = $item['data'];
        if ($product->id == 235) { //NEGATYW
            $cd1 = true;
        }

        if ($product->id == 43) { // W POLSCE JEST OGIEN
            $cd2 = true;
        }

       if (has_term('koszulka', 'product_cat', $product->id )) {
           $tshirt = true;
       }
    }

    if ($cd1 && $cd2 && $tshirt) {
        $discount = $cart->subtotal * 0.15;
        $cart->add_fee('Rabacik 15% \m/ (2xpłyta+koszulka)', -$discount);
    } else if (($cd1 || $cd2) && $tshirt) {
        $discount = $cart->subtotal * 0.1;
        $cart->add_fee("Rabacik 10% \\m/ (płyta+koszulka)", -$discount);
    }
}

add_action('woocommerce_cart_calculate_fees', 'bundles_discount');

?>