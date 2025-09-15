<?php get_header(); ?>
<?php
defined('ABSPATH') || exit;

global $product;
if (empty($product) || !($product instanceof WC_Product)) {
	$product = wc_get_product(get_the_ID());
}
if (empty($product) || !($product instanceof WC_Product)) {
	return;
}

function _fmt_num($num)
{
	return function_exists('toPersianNumerals') ? toPersianNumerals($num) : $num;
}

$product_id     = $product->get_id();
$main_image_id  = get_post_thumbnail_id($product_id);
$main_image_src = $main_image_id ? wp_get_attachment_image_url($main_image_id, 'large') : wc_placeholder_img_src();
$gallery_ids    = $product->get_gallery_image_ids();

$price         = (float) $product->get_price();
$regular_price = (float) $product->get_regular_price();
$offPercent    = ($regular_price > 0 && $price < $regular_price) ? round(100 * ($regular_price - $price) / $regular_price) : 0;
?>

<div class="container mx-auto px-4 py-10">

	<div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

		<!-- تصویر محصول -->
		<div class="text-center">
			<div class="rounded-lg overflow-hidden border border-gray-200 bg-white relative aspect-[3/2]">
				<img id="main-product-image"
					src="<?php echo esc_url($main_image_src); ?>"
					data-full="<?php echo esc_url($main_image_src); ?>"
					alt="<?php echo esc_attr(get_the_title($product_id)); ?>"
					class="w-full h-full object-cover cursor-zoom-in">
			</div>

			<?php if (!empty($gallery_ids)): ?>
				<div class="flex gap-2 mt-4 justify-center">
					<?php foreach ($gallery_ids as $aid):
						$thumb = wp_get_attachment_image_url($aid, 'thumbnail');
						$large = wp_get_attachment_image_url($aid, 'large');
					?>
						<button type="button"
							class="gallery-thumb border border-gray-200 rounded-md overflow-hidden"
							data-full="<?php echo esc_attr($large); ?>">
							<img src="<?php echo esc_url($thumb); ?>" alt="" class="w-16 h-16 object-cover">
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<!-- اطلاعات محصول -->
		<div class="text-right">
			<h1 class="text-2xl font-bold text-gray-900 mb-6"><?php the_title(); ?></h1>

			<div class="text-sm text-gray-500 mb-8">
				<?php
				$categories = get_the_terms($product_id, 'product_cat');
				if ($categories && !is_wp_error($categories)) {
					echo esc_html($categories[0]->name);
				}
				?>
			</div>

			<!-- قیمت -->
			<div class="mb-6">
				<?php if ($offPercent > 0): ?>
					<span class="bg-[#940303] text-white text-xs px-2 py-1 rounded-md ml-2">
						<?php echo _fmt_num($offPercent); ?>%
					</span>
					<span class="text-gray-400 line-through mr-2">
						<?php echo _fmt_num(number_format($regular_price)); ?> ریال
					</span>
				<?php endif; ?>

				<span class="text-2xl font-bold text-[#940303] block mt-2">
					<?php echo _fmt_num(number_format($price)); ?> ریال
				</span>
			</div>

			<?php
			// بررسی دسته‌بندی محصول برای اینکه جدول فقط در صفحه جزئیات محصول زنانه نمایش داده بشه
			if (has_term('womens-clothing', 'product_cat', get_the_ID())) : ?>

				<!-- 📏 جدول سایز بندی -->
				<div class="bg-white border rounded-lg shadow p-4 mt-6">
					<h3 class="text-lg font-semibold text-gray-800 mb-3">جدول سایزبندی</h3>
					<div class="overflow-x-auto">
						<table class="w-full text-sm text-center border-collapse">
							<thead class="bg-gray-100 text-gray-700">
								<tr>
									<th class="p-2 border">سایز</th>
									<th class="p-2 border">دور سینه (cm)</th>
									<th class="p-2 border">دور کمر (cm)</th>
									<th class="p-2 border">قد (cm)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="p-2 border">S</td>
									<td class="p-2 border">84 - 88</td>
									<td class="p-2 border">64 - 68</td>
									<td class="p-2 border">160 - 165</td>
								</tr>
								<tr class="bg-gray-50">
									<td class="p-2 border">M</td>
									<td class="p-2 border">88 - 92</td>
									<td class="p-2 border">68 - 72</td>
									<td class="p-2 border">165 - 170</td>
								</tr>
								<tr>
									<td class="p-2 border">L</td>
									<td class="p-2 border">92 - 96</td>
									<td class="p-2 border">72 - 76</td>
									<td class="p-2 border">170 - 175</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			<?php endif; ?>


			<!-- انتخاب سایز + تعداد + افزودن به سبد -->
			<div class="mb-8">
				<form class="cart space-y-4" method="post" enctype="multipart/form-data">
					<?php do_action('woocommerce_before_add_to_cart_button'); ?>

					<!-- انتخاب سایز -->
					<div>
						<label for="size" class="block mb-2 text-sm font-medium text-gray-700">انتخاب سایز:</label>
						<select id="size" name="attribute_pa_size"
							class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#940303]">
							<option value="">یک سایز انتخاب کنید</option>
							<option value="s">S</option>
							<option value="m">M</option>
							<option value="l">L</option>
							<option value="xl">XL</option>
						</select>
					</div>

					<!-- انتخاب تعداد -->
					<div>
						<label for="quantity" class="block mb-2 text-sm font-medium text-gray-700">تعداد:</label>
						<input type="number" id="quantity" name="quantity" min="1" value="1"
							class="w-24 border border-gray-300 rounded-lg px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-[#940303]">
					</div>

					<!-- دکمه افزودن به سبد -->
					<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product_id); ?>"
						class="bg-[#940303] text-white font-medium px-6 py-3 rounded-full w-full sm:w-auto hover:bg-red-700 transition">
						افزودن به سبد خرید
					</button>

					<?php do_action('woocommerce_after_add_to_cart_button'); ?>
				</form>
			</div>

		</div>
	</div>

	<!-- تب‌ها -->
	<div class="mt-16">
		<div class="flex border-b border-gray-300 mb-6 gap-8">
			<button class="tab-button active px-4 py-2 text-sm font-medium text-[#940303] border-b-2 border-[#940303]" data-tab="desc">توضیحات</button>
			<button class="tab-button px-4 py-2 text-sm font-medium text-gray-600" data-tab="features">ویژگی‌ها</button>
		</div>

		<div id="tab-desc" class="tab-content text-gray-700 leading-relaxed">
			<?php the_content(); ?>
		</div>

		<div id="tab-features" class="tab-content hidden text-gray-700 leading-relaxed">
			<?php
			$attributes = $product->get_attributes();
			if (!empty($attributes)) {
				echo '<ul class="list-disc list-inside space-y-2">';
				foreach ($attributes as $attribute) {
					$label = wc_attribute_label($attribute->get_name());
					if ($attribute->is_taxonomy()) {
						$terms = wc_get_product_terms($product_id, $attribute->get_name(), ['fields' => 'names']);
						echo '<li>' . esc_html($label) . ': ' . esc_html(implode(', ', $terms)) . '</li>';
					} else {
						$options = $attribute->get_options();
						echo '<li>' . esc_html($label) . ': ' . esc_html(implode(', ', $options)) . '</li>';
					}
				}
				echo '</ul>';
			} else {
				echo '<p class="text-sm text-gray-500">ویژگی‌ای ثبت نشده است.</p>';
			}
			?>
		</div>
	</div>
</div>

<style>
	#product-image-modal {
		display: none;
		position: fixed;
		inset: 0;
		background: rgba(0, 0, 0, 0.6);
		align-items: center;
		justify-content: center;
		z-index: 9999;
	}

	#product-image-modal img {
		max-width: 90%;
		max-height: 90%;
		box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
		border-radius: 6px;
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// تب‌ها
		const buttons = document.querySelectorAll('.tab-button');
		const contents = document.querySelectorAll('.tab-content');
		buttons.forEach(btn => {
			btn.addEventListener('click', () => {
				buttons.forEach(b => {
					b.classList.remove('active', 'text-[#940303]', 'border-b-2', 'border-[#940303]');
					b.classList.add('text-gray-600');
				});
				contents.forEach(c => c.classList.add('hidden'));

				btn.classList.add('active', 'text-[#940303]', 'border-b-2', 'border-[#940303]');
				btn.classList.remove('text-gray-600');
				document.getElementById('tab-' + btn.dataset.tab).classList.remove('hidden');
			});
		});

		// گالری
		const mainImg = document.getElementById('main-product-image');
		document.querySelectorAll('.gallery-thumb').forEach(btn => {
			btn.addEventListener('click', function() {
				const full = this.getAttribute('data-full');
				if (full) {
					mainImg.src = full;
					mainImg.setAttribute('data-full', full);
				}
			});
		});

		// مودال زوم
		let modal = document.createElement('div');
		modal.id = 'product-image-modal';
		modal.innerHTML = '<div><img src="" alt=""/></div>';
		document.body.appendChild(modal);
		const modalImg = modal.querySelector('img');

		mainImg.addEventListener('click', function() {
			const src = this.getAttribute('data-full') || this.src;
			modalImg.src = src;
			modal.style.display = 'flex';
		});
		modal.addEventListener('click', function(e) {
			if (e.target === this) {
				this.style.display = 'none';
			}
		});
	});
</script>

<?php get_footer(); ?>