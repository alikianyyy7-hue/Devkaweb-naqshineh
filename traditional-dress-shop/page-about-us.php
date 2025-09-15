<?php get_header() ?>
<main class="bg-[#ebddc9]">

  <!-- سکشن درباره ما -->
  <section class="container mx-auto px-3 md:px-16 text-center py-16">
    <div class="text-gray-700 leading-relaxed space-y-6 mx-auto">

      <!-- تیتر اصلی -->
      <h1 class="text-6xl font-bold text-[#940303] p-5 mb-7">
        <?php the_title(); ?>
      </h1>

      <h2 class="text-2xl font-semibold text-[#083b6a] mb-4">
        سرگذشت ما...
      </h2>

      <!-- محتوای اصلی -->
      <div class="text-lg text-justify ">
        <p>«فروشگاه ما با الهام از فرهنگ و هنر اصیل ایرانی شکل گرفته است. ما باور داریم که هر محصول سنتی داستانی از تاریخ و هویت سرزمین‌مان را روایت می‌کند. هدف ما حفظ این میراث ارزشمند و رساندن آن به دست شما با بهترین کیفیت و عشق است.»</p>
        
      </div>
    </div>
  </section>


<!-- سکشن ماموریت‌ها -->
<section class="container mx-auto px-4 py-26 relative px-[10%]">
  <h2 class="text-3xl font-bold mx-auto text-[#083b6a] mb-12 text-center">
    ماموریت‌ها
  </h2>

  <div class="relative flex">
    <!-- خط تایم‌لاین (فقط دسکتاپ) -->
    <div class="hidden md:block w-1 bg-[#083b6a] absolute top-0 bottom-0 right-0 md:right-1/2 md:translate-x-1/2 "></div>

    <div class="flex flex-col space-y-10 w-full relative z-10">
      <?php 
      for($i=1;$i<=4;$i++):
          $mission_text  = get_theme_mod("mission_{$i}_text", "این متن توضیح کوتاهی درباره ماموریت {$i} است.");
          $is_even = $i % 2 == 0; // جفت یا فرد بودن
      ?>
      <div class="flex items-start md:justify-<?php echo $is_even ? 'start' : 'end'; ?> relative mx-[3%]">
        
        <!-- نقطه تایم‌لاین -->
        <div class="hidden md:block w-6 h-6 bg-[#083b6a] rounded-full z-20 absolute right-1/2 translate-x-1/2 top-2"></div>
        
        <!-- باکس متن -->
        <div class="max-w-md bg-[#f4eddf] rounded-2xl shadow p-5 w-full md:w-auto">
          <p class="text-[#062e55] text-md leading-relaxed"><?php echo $mission_text; ?></p>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- سکشن شرکای ما -->
<section class="container mx-auto py-16 px-4 sm:px-6 lg:px-20">
  <div class="bg-[#f4eddf] rounded-2xl p-6 shadow mx-auto w-full max-w-6xl">
    <h3 class="text-2xl font-bold text-center text-gray-700 mb-10">
      قصه پشت صحنه لباس ها (شرکای ما)
    </h3>

    <!-- Grid: موبایل و تبلت 1 کارت در هر ردیف، دسکتاپ 2 کارت -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <?php 
      for($i=1;$i<=4;$i++):
          $partner_title = get_theme_mod("partner_{$i}_title", "کارگاه {$i}");
          $partner_desc  = get_theme_mod("partner_{$i}_desc", "توضیح کوتاه درباره کارگاه {$i}");
          $partner_img   = get_theme_mod("partner_{$i}_image", "https://via.placeholder.com/150");
      ?>

      <!-- کارت -->
      <div class="bg-[#eee2d0] rounded-xl flex flex-col sm:flex-row-reverse lg:flex-row items-start p-6 transition-all duration-300 w-full">
        
        <!-- عکس -->
        <img src="<?php echo esc_url($partner_img); ?>" 
             class="w-36 h-36 sm:w-40 sm:h-40 rounded-lg mb-4 sm:mb-0 sm:ml-0 sm:mr-4 lg:ml-4 lg:mr-0 flex-shrink-0" 
             alt="<?php echo esc_attr($partner_title); ?>">

        <!-- متن -->
        <div class="text-center sm:text-left lg:text-right flex-1">
          <h4 class="font-bold text-[#083b6a] text-right text-lg mb-2"><?php echo $partner_title; ?></h4>
          <p class="text-gray-600 text-sm text-right "><?php echo $partner_desc; ?></p>
        </div>
      </div>

      <?php endfor; ?>
    </div>
  </div>

</main>


<?php get_footer() ?>