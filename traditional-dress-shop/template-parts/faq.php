<section class="w-full !mt-25"id="faq" >
  <div class="max-w-7xl mx-auto px-5   md:px-8 grid grid-cols-1 md:grid-cols-5 gap-8 p-6 md:p-10">
    
    <!-- text box -->
    <div class="flex flex-col justify-center relative md:col-span-2">
      <h2 class="text-3xl md:text-4xl font-bold text-[#1c2a3a] mb-4">
        <?php echo esc_html(get_theme_mod('faq_title', 'سوالات متداول')); ?>
      </h2>
      <p class="text-[#2e2e2e] leading-relaxed mb-4">
        <?php echo wp_kses_post(get_theme_mod('faq_desc', 'اینجا متن توضیحی بخش سوالات متداول قرار می‌گیرد.')); ?>
      </p>

      <?php $faq_right_img = get_theme_mod('faq_right_image'); ?>
      <?php if ($faq_right_img): ?>
        <img src="<?php echo esc_url($faq_right_img); ?>" 
             alt="faq right image" 
             class="mt-4 rounded-xl shadow-md w-32 md:w-48 lg:w-40 h-auto object-cover">
      <?php endif; ?>
    </div>

    <!-- question box-->
    <div class="bg-[#083b6a] text-white rounded-2xl p-4 md:p-6 shadow-lg md:col-span-3">
      <div class="space-y-4">
        <?php for ($i = 1; $i <= 6; $i++): 
          $q = get_theme_mod("faq_question_$i");
          $a = get_theme_mod("faq_answer_$i");
          if ($q): ?>
            <details class="bg-white rounded-lg p-4 text-black">
              <summary class="flex justify-between items-center cursor-pointer font-semibold">
                <?php echo esc_html($q); ?>
                <span class="w-8 h-8 flex items-center justify-center rounded-full text-xl transition-colors duration-300 hover:bg-gray-400">+</span>
              </summary>
              <?php if ($a): ?>
                <p class="mt-2 text-gray-600 text-sm md:text-base leading-relaxed">
                  <?php echo wp_kses_post($a); ?>
                </p>
              <?php endif; ?>
            </details>
          <?php endif;
        endfor; ?>
      </div>
    </div>

  </div>
</section>
