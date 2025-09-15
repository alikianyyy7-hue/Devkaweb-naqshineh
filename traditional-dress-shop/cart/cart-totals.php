<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">خلاصه سفارش</h2>

    <table class="w-full text-sm border-collapse">
        <tbody class="divide-y divide-gray-200">

            <tr class="cart-subtotal">
                <th class="py-2 text-right font-medium text-gray-700">جمع جزء</th>
                <td class="py-2 text-left text-gray-800"><?php wc_cart_totals_subtotal_html(); ?></td>
            </tr>

            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <th class="py-2 text-right font-medium text-gray-700"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                    <td class="py-2 text-left text-green-600"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                </tr>
            <?php endforeach; ?>

            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                <?php wc_cart_totals_shipping_html(); ?>
            <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
                <tr class="shipping">
                    <th class="py-2 text-right font-medium text-gray-700">هزینه ارسال</th>
                    <td class="py-2 text-left"><?php woocommerce_shipping_calculator(); ?></td>
                </tr>
            <?php endif; ?>

            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                <tr class="fee">
                    <th class="py-2 text-right font-medium text-gray-700"><?php echo esc_html( $fee->name ); ?></th>
                    <td class="py-2 text-left text-gray-800"><?php wc_cart_totals_fee_html( $fee ); ?></td>
                </tr>
            <?php endforeach; ?>

            <?php
            if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
                if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                    foreach ( WC()->cart->get_tax_totals() as $code => $tax ) {
                        ?>
                        <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                            <th class="py-2 text-right font-medium text-gray-700"><?php echo esc_html( $tax->label ); ?></th>
                            <td class="py-2 text-left text-gray-800"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr class="tax-total">
                        <th class="py-2 text-right font-medium text-gray-700"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                        <td class="py-2 text-left text-gray-800"><?php wc_cart_totals_taxes_total_html(); ?></td>
                    </tr>
                    <?php
                }
            }
            ?>

            <tr class="order-total bg-gray-50 font-semibold">
                <th class="py-3 text-right text-gray-900">مبلغ نهایی</th>
                <td class="py-3 text-left text-[#940303] text-lg"><?php wc_cart_totals_order_total_html(); ?></td>
            </tr>

        </tbody>
    </table>

    <div class="wc-proceed-to-checkout mt-6">
        <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>
