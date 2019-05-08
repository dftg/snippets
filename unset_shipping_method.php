add_filter('woocommerce_package_rates', 'deactivate_isolated_shipping_method', 10, 2);
  function deactivate_isolated_shipping_method($available_shipping_methods)
  {
    global $woocommerce;
    // Fill this array with items that do get the promo shipping rate.
    $products_array = array(
      11339,
      11265
    );
    // right-click, inspect element on shipping method to find the shipping code.
    $shipping_services_to_hide = array(
      'flat_rate:107'
    );
    // Get all products from the cart.
    $products = $woocommerce->cart->get_cart();
    // for each item in the cart:
    foreach($products as $key => $item) {
      // if the product is not found in the array we loaded earlier
      if (!in_array($item['product_id'], $products_array)) {
        // for each service
        foreach($shipping_services_to_hide as & $value) {
          // unset the method(s)
          unset($available_shipping_methods[$value]);
        }
        break;
      }
    }
    // return updated available_shipping_methods;
    return $available_shipping_methods;
  }

