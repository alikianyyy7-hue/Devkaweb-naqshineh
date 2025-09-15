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
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>

<form class="woocommerce-cart-form p-6" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

		<!-- 🛒 لیست محصولات -->
		<div class="lg:col-span-2">
			<table class="w-full border-collapse bg-white rounded-lg shadow-sm overflow-hidden text-sm">
				<thead class="bg-gray-100 text-gray-700">
					<tr>
						<th class="p-3 text-center">حذف</th>
						<th class="p-3 text-center">تصویر</th>
						<th class="p-3 text-right">محصول</th>
						<th class="p-3 text-center">قیمت</th>
						<th class="p-3 text-center">تعداد</th>
						<th class="p-3 text-center">جمع کل</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
							$product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
					?>
					<tr class="border-b last:border-0 hover:bg-gray-50">
						<!-- حذف -->
						<td class="p-3 text-center">
							<a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>"
							   class="text-red-500 hover:text-red-700 font-bold text-lg">×</a>
						</td>

						<!-- تصویر -->
						<td class="p-3 text-center">
							<?php
							$thumbnail = $_product->get_image( 'woocommerce_thumbnail', ['class' => 'w-16 h-16 object-cover rounded-md mx-auto'] );
							echo $product_permalink ? '<a href="'.esc_url( $product_permalink ).'">'.$thumbnail.'</a>' : $thumbnail;
							?>
						</td>

						<!-- نام محصول -->
						<td class="p-3 text-right">
							<?php echo $product_permalink
								? '<a href="'.esc_url( $product_permalink ).'" class="font-medium text-gray-800 hover:text-[#940303]">'.$_product->get_name().'</a>'
								: $_product->get_name(); ?>

							<div class="text-xs text-gray-500 mt-1">
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
							</div>
						</td>

						<!-- قیمت -->
						<td class="p-3 text-center text-gray-700">
							<?php echo WC()->cart->get_product_price( $_product ); ?>
						</td>

						<!-- تعداد -->
						<td class="p-3 text-center">
							<?php
							echo woocommerce_quantity_input(
								[
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'classes'      => ['border', 'rounded-lg', 'px-2', 'py-1', 'w-20', 'text-center']
								],
								$_product,
								false
							);
							?>
						</td>

						<!-- جمع کل -->
						<td class="p-3 text-center font-medium text-gray-800">
							<?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?>
						</td>
					</tr>
					<?php endif; endforeach; ?>
				</tbody>
			</table>

			<!-- کوپن به روز رسانی-->
			<div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-6">
				<?php if ( wc_coupons_enabled() ) : ?>
				<div class="flex items-center gap-2 w-full sm:w-auto">
					<input type="text" name="coupon_code" class="border border-gray-300 rounded-lg px-3 py-2 w-full sm:w-40 text-sm"
					       placeholder="کد تخفیف">
					<button type="submit"
					        class="bg-[#940303] text-white text-sm px-4 py-2 rounded-lg hover:bg-red-700 transition"
					        name="apply_coupon"
					        value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
					       دریافت تخفیف
					</button>
				</div>
				<?php endif; ?>

				<button type="submit"
						class="bg-[#940303] text-white text-sm px-6 py-2 rounded-lg hover:bg-red-700 transition"
						name="update_cart"
						value="1">
						بروزرسانی سبد
				</button>
			</div>
		</div>

		<!-- 💰 جمع کل -->
		<div>
			<div class="bg-white rounded-lg shadow p-6 sticky top-6">
				<?php do_action( 'woocommerce_cart_collaterals' ); ?>
			</div>
		</div>
	</div>

	<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
