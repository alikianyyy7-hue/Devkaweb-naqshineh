<section class="w-full ">
  <div>

  <div class="w-full">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/graphic_strip_repeat.png" 
          alt="نوار گرافیکی"
          class="w-full h-[40px] object-cover rounded-lg shadow" />
    </div>

  <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 items-center gap-20">
    <!-- متن سمت راست -->
    <div class="pr-[25px]">
      <div class="text-right space-y-6 order-2 md:order-1">
        <!-- عنوان (عنوان برگه) -->
        <h1 class="text-4xl md:text-6xl font-bold text-[#1c2a3a] pr-[5px]">
          <?php the_title(); ?>
        </h1>

        <!-- متن (محتوای برگه) -->
        <div class="text-base md:text-lg text-[#2e2e2e] leading-relaxed">
          <?php the_content(); ?>
        </div>

        <!-- دکمه (لینک به فروشگاه) -->
        <div class="flex justify-center md:justify-start">
          <a href="<?php echo esc_url(get_permalink( wc_get_page_id('shop') )); ?>" 
            class="hover:bg-[#940303] bg-red-700 text-white px-6 py-3 rounded-lg transition">
         مشاهده محصولات
          </a>
        </div>

      </div>
    </div>

    <!-- picture-->
    <div class="flex justify-center md:justify-start order-1 md:order-2 " >
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('large', [
          'class' => 'w-full h-auto max-w-md md:w-[460px] md:h-[500px] object-contain rounded-lg shadow-lg'
        ]); ?>
      <?php endif; ?>
    </div>

    </div>
  </div>
</section>