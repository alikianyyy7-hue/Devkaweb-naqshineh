<?php
defined('ABSPATH') || exit;

global $product;

if (! is_a($product, WC_Product::class) || ! $product->is_visible()) {
	return;
}
?>
<li <?php wc_product_class('list-none', $product); ?>>
	<div class="bg-white border border-gray-100 rounded-xl overflow-hidden hover:shadow-md transition-transform hover:-translate-y-1">

		<!-- بخش کلیک‌شدنی کارت -->
		<a href="<?php the_permalink(); ?>" class="block">
			<!-- تصویر محصول -->
			<?php if (has_post_thumbnail()): ?>
				<?php the_post_thumbnail('medium', ['class' => 'h-56 w-full object-cover']); ?>
			<?php else: ?>
				<img class="h-56 w-full object-cover" src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="تصویر محصول">
			<?php endif; ?>

			<div class="p-4">
				<!-- عنوان محصول -->
				<h2 class="font-medium text-sm text-gray-800 mb-1"><?php the_title(); ?></h2>

				<!-- دسته بندی -->
				<div class="text-xs text-gray-400 mb-3">
					<?php
					$categories = get_the_terms($product->get_id(), 'product_cat');
					if ($categories && !is_wp_error($categories)) {
						echo esc_html($categories[0]->name);
					}
					?>
				</div>

				<!-- قیمت (مثل نسخه اول سمت چپ) -->
				<div class="flex justify-between flex-row-reverse items-center mt-4">
					<?php
					$price = $product->get_price();
					$regularPrice = $product->get_regular_price();
					$offPercent = $regularPrice > 0 ? round(100 * ($regularPrice - $price) / $regularPrice) : 0;
					?>
					<span class="flex gap-2 items-center">
						<?php if ($offPercent > 0): ?>
							<span class="bg-red-600 text-white text-[11px] px-1.5 py-0.5 rounded-md">
								<?php echo toPersianNumerals($offPercent) ?>%
							</span>
							<span class="text-gray-400 line-through text-xs">
								<?php echo toPersianNumerals(number_format($regularPrice)) ?>
							</span>
						<?php endif; ?>
						<span class="font-semibold text-gray-900 text-sm">
							<?php echo toPersianNumerals(number_format($price)) ?>
						</span>
						<span class="text-xs text-gray-500">ریال</span>
					</span>
				</div>
			</div>
		</a>

		<!-- دکمه افزودن به سبد داخل کارت -->
		<div class="p-3 pt-0">
			<a href="<?php echo esc_url( add_query_arg( 'add-to-cart', get_the_ID() ) ); ?>" 
			   class="block text-center w-full bg-[#940303] text-white text-sm py-2 rounded-lg hover:bg-red-800 transition">
				افزودن به سبد
			</a>
		</div>
	</div>
</li>
