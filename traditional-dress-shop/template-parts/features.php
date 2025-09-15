<section class="w-full !mt-15">
  <div class="max-w-6xl mx-auto py-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-center">
    <?php for ($i = 1; $i <=4; $i++): ?>
      <div class="flex flex-col items-center space-y-3 p-6 shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1)] bg-[#ebddc9] rounded-lg mx-[15px]">
        
        <!-- icons -->
        <div class="duration-300  hover:-translate-y-3">
          <?php if ($icon = get_theme_mod("feature_icon_$i")): ?>
            <img src="<?php echo esc_url($icon); ?>" alt="icon"
                 class="w-24 h-24 object-contain">
          <?php else: ?>
            <span class="text-gray-400">?</span>
          <?php endif; ?>
        </div>

        <!-- text under icon-->
        <p class="text-[#063157] font-bold">
          <?php echo esc_html(get_theme_mod("feature_text_$i", "ویژگی $i")); ?>
        </p>

      </div>
    <?php endfor; ?>
  </div>
</section>