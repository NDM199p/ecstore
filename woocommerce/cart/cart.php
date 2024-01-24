<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

// defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<h1>Customs cart page</h1>

<?php do_action('woocommerce_before_cart_table'); ?>

<div class="div">
    <div class="div-2">
        <span class="span">
            <div class="div-3 w-fullx2">Product</div>
            <div class="div-4 w-full">Price</div>
            <div class="div-5 w-full">Quantity</div>
            <div class="div-6 w-full">Subtotal</div>
        </span>
    </div>

    <?php do_action('woocommerce_before_cart_contents'); ?>

    <?php
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
        /**
         * Filter the product name.
         *
         * @since 2.1.0
         * @param string $product_name Name of the product in the cart.
         * @param array $cart_item The product in the cart.
         * @param string $cart_item_key Key for the product in the cart.
         */
        $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>

            <span class="span-2">
                <span class="span-3 w-fullx2">
                    <div class="w-full">
                        <?php
                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                        if (!$product_permalink) {
                            echo $thumbnail; // PHPCS: XSS ok.
                        } else {
                            printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                        }
                        ?>
                    </div>
                    <div class="div-7 w-full">
                        <?php echo $product_name ?>
                    </div>
                </span>
                <div class="div-8 w-full">
                    <?php
                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                    ?>
                </div>
                <div class="w-full">
                    <?php
                    if ($_product->is_sold_individually()) {
                        $min_quantity = 1;
                        $max_quantity = 1;
                    } else {
                        $min_quantity = 0;
                        $max_quantity = $_product->get_max_purchase_quantity();
                    }

                    $product_quantity = woocommerce_quantity_input(
                        array(
                            'input_name' => "cart[{$cart_item_key}][qty]",
                            'input_value' => $cart_item['quantity'],
                            'max_value' => $max_quantity,
                            'min_value' => $min_quantity,
                            'product_name' => $product_name,
                        ),
                        $_product,
                        false
                    );

                    echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                    ?>
                </div>
                <div class="div-9 w-full">
                    <?php
                    echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                    ?>
                </div>
            </span>

            <tr
                class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                <td class="product-remove">
                    <?php
                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                            /* translators: %s is the product name */
                            esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                            esc_attr($product_id),
                            esc_attr($_product->get_sku())
                        ),
                        $cart_item_key
                    );
                    ?>
                </td>

                <td class="product-thumbnail">
                    <?php
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                    if (!$product_permalink) {
                        echo $thumbnail; // PHPCS: XSS ok.
                    } else {
                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                    }
                    ?>
                </td>

                <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                    <?php
                    if (!$product_permalink) {
                        echo wp_kses_post($product_name . '&nbsp;');
                    } else {
                        /**
                         * This filter is documented above.
                         *
                         * @since 2.1.0
                         */
                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                    }

                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                    // Meta data.
                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.
            
                    // Backorder notification.
                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                    }
                    ?>
                </td>

            </tr>
            <?php
        }
    }
    ?>

    <?php do_action('woocommerce_cart_contents'); ?>


    <?php do_action('woocommerce_after_cart_contents'); ?>

    <div class="div-13">
        <span class="span-6">Return To Shop</span>
        <button type="submit"
            class="span-6 button--<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
            name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
            <?php esc_html_e('Update cart', 'woocommerce'); ?>
        </button>

    </div>
    <div class="div-14">
        <div class="div-15">
            <div class="column">
                <div class="div-16">
                    <!-- Coupon code -->
                    <?php if (wc_coupons_enabled()) { ?>
                        <label for="coupon_code" class="screen-reader-text span-8">
                            <?php esc_html_e('Coupon:', 'woocommerce'); ?>
                        </label> <input type="text" name="coupon_code" class="input-text " id="coupon_code" value=""
                            placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
                        <button type="submit"
                            class="span-9 button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                            name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                            <?php esc_html_e('Apply coupon', 'woocommerce'); ?>
                        </button>
                        <?php do_action('woocommerce_cart_coupon'); ?>
                    <?php } ?>
                    <!-- End coupon code -->

                </div>
            </div>
            <div class="column-2">
                <span class="span-10">
                    <div class="div-17">Cart Total</div>
                    <span class="span-11">
                        <div class="div-18">Subtotal:</div>
                        <div class="div-19">$1750</div>
                    </span>
                    <div class="div-20"></div>
                    <span class="span-12">
                        <div class="div-21">Shipping:</div>
                        <div class="div-22">Free</div>
                    </span>
                    <div class="div-23"></div>
                    <span class="span-13">
                        <div class="div-24">Total:</div>
                        <div class="div-25">$1750</div>
                    </span>
                    <span class="span-14">Procees to checkout</span>
                </span>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_before_cart_collaterals'); ?>

<div class="cart-collaterals">
    <?php
    /**
     * Cart collaterals hook.
     *
     * @hooked woocommerce_cross_sell_display
     * @hooked woocommerce_cart_totals - 10
     */
    do_action('woocommerce_cart_collaterals');
    ?>
</div>

<?php do_action('woocommerce_after_cart'); ?>


<style>
    .div {
        display: flex;
        flex-direction: column;
    }

    .w-full {
        width: 100%;
    }

    .w-fullx2 {
        width: 200%;
    }

    .text-center {
        text-align: center;
    }

    .div-2 {
        justify-content: center;
        border-radius: 4px;
        box-shadow: 0px 1px 13px 0px rgba(0, 0, 0, 0.05);
        background-color: var(--Primary, #fff);
        display: flex;
        width: 100%;
        flex-direction: column;
        padding: 24px 40px;
    }

    @media (max-width: 991px) {
        .div-2 {
            max-width: 100%;

            /* padding: 0 20px; */
        }
    }

    .span {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    @media (max-width: 991px) {
        .span {
            max-width: 100%;
            flex-wrap: nowrap;
        }
    }

    .div-3 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-4 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-5 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-6 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .span-2 {

        border-radius: 4px;
        box-shadow: 0px 1px 13px 0px rgba(0, 0, 0, 0.05);
        background-color: var(--Primary, #fff);
        display: flex;
        margin-top: 40px;
        width: 100%;
        align-items: center;
        /* align-items: flex-start; */
        justify-content: space-between;
        gap: 20px;
        padding: 22px 30px;
    }

    @media (max-width: 991px) {
        .span-2 {
            max-width: 100%;
            flex-wrap: nowrap;
            padding: 0 20px;
        }
    }

    .span-3 {
        align-self: stretch;
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .img {
        aspect-ratio: 1.1;
        object-fit: contain;
        object-position: center;
        width: 64px;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        max-width: 100%;
    }

    .div-7 {
        color: #000;
        align-self: center;
        margin: auto 0;
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-8 {
        color: var(--Text2, #000);
        align-self: center;
        margin: auto 0;
        font: 400 16px/150% Poppins, sans-serif;
    }

    .img-2 {
        aspect-ratio: 1.6;
        object-fit: contain;
        object-position: center;
        width: 75px;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        align-self: center;
        max-width: 100%;
        margin: auto 0;
    }

    .div-9 {
        color: var(--Text2, #000);
        align-self: center;
        margin: auto 0;
        font: 400 16px/150% Poppins, sans-serif;
    }

    .span-4 {
        border-radius: 4px;
        box-shadow: 0px 1px 13px 0px rgba(0, 0, 0, 0.05);
        background-color: var(--Primary, #fff);
        display: flex;
        margin-top: 40px;
        width: 100%;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        padding: 24px 40px;
    }

    @media (max-width: 991px) {
        .span-4 {
            max-width: 100%;
            flex-wrap: wrap;
            padding: 0 20px;
        }
    }

    .span-5 {
        align-self: stretch;
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .img-3 {
        aspect-ratio: 1;
        object-fit: contain;
        object-position: center;
        width: 54px;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        max-width: 100%;
    }

    .div-10 {
        color: #000;
        margin: auto 0;
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-11 {
        color: var(--Text2, #000);
        align-self: center;
        margin: auto 0;
        font: 400 16px/150% Poppins, sans-serif;
    }

    .img-4 {
        aspect-ratio: 1.6;
        object-fit: contain;
        object-position: center;
        width: 75px;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        align-self: center;
        max-width: 100%;
        margin: auto 0;
    }

    .div-12 {
        color: var(--Text2, #000);
        align-self: center;
        margin: auto 0;
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-13 {
        display: flex;
        margin-top: 24px;
        width: 100%;
        justify-content: space-between;
        gap: 20px;
    }

    @media (max-width: 991px) {
        .div-13 {
            max-width: 100%;
            flex-wrap: wrap;
        }
    }

    .span-6 {
        color: var(--Text2, #000);
        white-space: nowrap;
        justify-content: center;
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.5);
        padding: 16px 48px;
        font: 500 16px/150% Poppins, sans-serif;
    }

    @media (max-width: 991px) {
        .span-6 {
            white-space: initial;
            padding: 0 20px;
        }
    }

    .span-7 {
        color: var(--Text2, #000);
        white-space: nowrap;
        justify-content: center;
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.5);
        padding: 16px 48px;
        font: 500 16px/150% Poppins, sans-serif;
    }

    @media (max-width: 991px) {
        .span-7 {
            white-space: initial;
            padding: 0 20px;
        }
    }

    .div-14 {
        margin-top: 80px;
        width: 100%;
    }

    @media (max-width: 991px) {
        .div-14 {
            max-width: 100%;
            margin-top: 40px;
        }
    }

    .div-15 {
        gap: 20px;
        display: flex;
    }

    @media (max-width: 991px) {
        .div-15 {
            flex-direction: column;
            align-items: stretch;
            gap: 0px;
        }
    }

    .column {
        display: flex;
        flex-direction: column;
        line-height: normal;
        width: 56%;
        margin-left: 0px;
    }

    @media (max-width: 991px) {
        .column {
            width: 100%;
        }
    }

    .div-16 {
        display: flex;
        gap: 16px;
    }

    @media (max-width: 991px) {
        .div-16 {
            max-width: 100%;
            margin-top: 40px;
            flex-wrap: wrap;
        }
    }

    .span-8 {
        color: var(--Text2, #000);
        white-space: nowrap;
        align-items: start;
        border-radius: 4px;
        border: 1px solid #000;
        flex-grow: 1;
        justify-content: center;
        padding: 20px 60px 20px 24px;
        font: 400 16px/150% Poppins, sans-serif;
    }

    @media (max-width: 991px) {
        .span-8 {
            white-space: initial;
            padding: 0 20px;
        }
    }

    .span-9 {
        color: var(--Text, #fafafa);
        white-space: nowrap;
        justify-content: center;
        border-radius: 4px;
        background-color: var(--Button2, #db4444);
        flex-grow: 1;
        padding: 16px 48px;
        font: 500 16px/150% Poppins, sans-serif;
    }

    @media (max-width: 991px) {
        .span-9 {
            white-space: initial;
            padding: 0 20px;
        }
    }

    .column-2 {
        display: flex;
        flex-direction: column;
        line-height: normal;
        width: 44%;
        margin-left: 20px;
    }

    @media (max-width: 991px) {
        .column-2 {
            width: 100%;
        }
    }

    .span-10 {
        border-radius: 4px;
        border: 1.5px solid #000;
        display: flex;
        flex-grow: 1;
        flex-direction: column;
        width: 100%;
        padding: 35px 24px;
    }

    @media (max-width: 991px) {
        .span-10 {
            max-width: 100%;
            margin-top: 40px;
            padding: 0 20px;
        }
    }

    .div-17 {
        color: var(--Text2, #000);
        align-self: stretch;
        font: 500 20px/140% Poppins, sans-serif;
    }

    @media (max-width: 991px) {
        .div-17 {
            max-width: 100%;
        }
    }

    .span-11 {
        align-self: stretch;
        display: flex;
        margin-top: 31px;
        justify-content: space-between;
        gap: 20px;
    }

    @media (max-width: 991px) {
        .span-11 {
            max-width: 100%;
            flex-wrap: wrap;
        }
    }

    .div-18 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-19 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-20 {
        background-color: #000;
        align-self: stretch;
        margin-top: 15px;
        height: 1px;
    }

    @media (max-width: 991px) {
        .div-20 {
            max-width: 100%;
        }
    }

    .span-12 {
        align-self: stretch;
        display: flex;
        margin-top: 16px;
        justify-content: space-between;
        gap: 20px;
    }

    @media (max-width: 991px) {
        .span-12 {
            max-width: 100%;
            flex-wrap: wrap;
        }
    }

    .div-21 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-22 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-23 {
        background-color: #000;
        align-self: stretch;
        margin-top: 15px;
        height: 1px;
    }

    @media (max-width: 991px) {
        .div-23 {
            max-width: 100%;
        }
    }

    .span-13 {
        align-self: stretch;
        display: flex;
        margin-top: 16px;
        justify-content: space-between;
        gap: 20px;
    }

    @media (max-width: 991px) {
        .span-13 {
            max-width: 100%;
            flex-wrap: wrap;
        }
    }

    .div-24 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .div-25 {
        color: var(--Text2, #000);
        font: 400 16px/150% Poppins, sans-serif;
    }

    .span-14 {
        color: var(--Text, #fafafa);
        white-space: nowrap;
        justify-content: center;
        border-radius: 4px;
        background-color: var(--Button2, #db4444);
        align-self: center;
        margin-top: 16px;
        padding: 16px 48px;
        font: 500 16px/150% Poppins, sans-serif;
    }

    @media (max-width: 991px) {
        .span-14 {
            white-space: initial;
            padding: 0 20px;
        }
    }
</style>