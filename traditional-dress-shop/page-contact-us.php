<?php get_header() ?>

<main class="bg-[#ebddc9]">

  <!-- بخش عنوان و معرفی -->
  <section class="container mx-auto px-4 py-12 text-center">
    <h1 class="text-3xl md:text-6xl font-bold text-red-800 mb-6">ارتباط با ما</h1>
    <p class="text-gray-700 max-w-2xl mx-auto mb-8 leading-relaxed">
      <?php echo get_theme_mod('contact_intro_text', 'سؤالی دارید یا نیاز به پشتیبانی دارید؟ از طریق فرم زیر یا اطلاعات تماس می‌توانید با ما در ارتباط باشید.'); ?>
    </p>
  </section>

  <!-- بخش فرم و اطلاعات تماس -->
  <section class="container mx-auto px-4 pb-16 grid md:grid-cols-2 gap-12 items-start">

    <!-- اطلاعات تماس + توضیح -->
    <div class="space-y-8 text-[#1c2a3a] md:pr-10 md:border-r md:border-gray-300">

      <!-- متن توضیحی -->
      <p class="font-bold text-gray-700">
        <?php echo get_theme_mod('contact_side_text_1', 'برای راحتی شما، می‌توانید پیام‌تان را مستقیم از طریق فرم مربوطه ارسال کنید. تیم ما در اولین فرصت پاسخگو خواهد بود.'); ?>
      </p>

      <!-- شماره تماس -->
      <div class="flex items-center gap-4 hover:translate-x-1 transition">
        <div class="bg-[#940303] text-white p-3 rounded-full flex items-center justify-center w-12 h-12">
          <i class="fas fa-phone-alt text-lg"></i>
        </div>
        <div>
          <h3 class="font-bold">تماس تلفنی</h3>
          <p class="text-gray-700 text-sm">
            <?php echo get_theme_mod('contact_phone', '09304444333'); ?>
          </p>
        </div>
      </div>

      <!-- ایمیل -->
      <div class="flex items-center gap-4 hover:translate-x-1 transition">
        <div class="bg-[#940303] text-white p-3 rounded-full flex items-center justify-center w-12 h-12">
          <i class="fas fa-envelope text-lg"></i>
        </div>
        <div>
          <h3 class="font-bold">ایمیل</h3>
          <p class="text-gray-700 text-sm">
            <?php echo get_theme_mod('contact_email', 'naghshineh-shop@gmail.com'); ?>
          </p>
        </div>
      </div>

      <!-- ساعات پاسخگویی -->
      <div class="flex items-center gap-4 hover:translate-x-1 transition">
        <div class="bg-[#940303] text-white p-3 rounded-full flex items-center justify-center w-12 h-12">
          <i class="fas fa-clock text-lg"></i>
        </div>
        <div>
          <h3 class="font-bold">ساعات پاسخگویی</h3>
          <p class="text-gray-700 text-sm">
            <?php echo get_theme_mod('contact_hours', '9 صبح تا 6 عصر'); ?>
          </p>
        </div>
      </div>

      <!-- آدرس -->
      <div class="flex items-center gap-4 hover:translate-x-1 transition">
        <div class="bg-[#940303] text-white p-3 rounded-full flex items-center justify-center w-12 h-12">
          <i class="fas fa-map-marker-alt text-lg"></i>
        </div>
        <div>
          <h3 class="font-bold">آدرس</h3>
          <p class="text-gray-700 text-sm">
            <?php echo get_theme_mod('contact_address', 'مشهد، خیابان فلان، کوچه بهمان'); ?>
          </p>
        </div>
      </div>

      <!-- دکمه سوالات متداول -->
      <a href="#faq"
        class="inline-block bg-[#940303] text-white px-8 py-3 rounded-xl font-semibold hover:bg-red-800 transition">
        مشاهده سوالات متداول
      </a>
    </div>

    <!-- فرم ارتباط با ما -->
    <div id="contact-form" class="bg-[#1c2a3a] shadow-md rounded-2xl p-8 space-y-5 self-start">
      <form method="post" action="" class="space-y-5">

        <input type="text" name="name" placeholder="نام و نام خانوادگی" required
          class="w-full rounded-xl p-3 bg-[#fff6eb] focus:outline-none focus:ring-2 focus:ring-red-600 shadow-sm">

        <input type="email" name="email" placeholder="ایمیل" required
          class="w-full rounded-xl p-3 bg-[#fff6eb] focus:outline-none focus:ring-2 focus:ring-red-600 shadow-sm">

        <input type="text" name="subject" placeholder="موضوع" required
          class="w-full rounded-xl p-3 bg-[#fff6eb] focus:outline-none focus:ring-2 focus:ring-red-600 shadow-sm">

        <textarea name="message" rows="4" placeholder="پیام شما" required
          class="w-full rounded-xl p-3 bg-[#fff6eb] focus:outline-none focus:ring-2 focus:ring-red-600 shadow-sm"></textarea>

        <button type="submit" name="send_message"
          class="w-full bg-[#940303] text-white py-3 rounded-xl font-bold hover:bg-red-800 transition cursor-pointer shadow-md">
          ارسال پیام
        </button>
      </form>
    </div>

  </section>

  <!-- نقشه -->
  <section class="container mx-auto px-5 pb-16">
    <div class="rounded-2xl mx-auto shadow-md w-full max-w-5xl overflow-hidden">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3214.2108785544638!2d59.53338057562263!3d36.33143867238449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6c9275e494cc47%3A0x8fd4510894855425!2sRazavi%20Khorasan%20Province%2C%20Mashhad%2C%20District%2011%2C%20Emamat%20Blvd%2C%20Iran!5e0!3m2!1sen!2snl!4v1757900044107!5m2!1sen!2snl" class="w-full" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>

</main>

<?php
// پردازش فرم
if (isset($_POST['send_message'])) {
  $name    = sanitize_text_field($_POST['name']);
  $email   = sanitize_email($_POST['email']);
  $subject = sanitize_text_field($_POST['subject']);
  $message = sanitize_textarea_field($_POST['message']);

  $to = get_theme_mod('contact_email', 'zkiani684@gmail.com');
  $headers = "From: $name <$email>";

  if (wp_mail($to, $subject, $message, $headers)) {
    echo "<p class='text-center text-green-600 mt-4'>پیام شما با موفقیت ارسال شد ✅</p>";
  } else {
    echo "<p class='text-center text-red-600 mt-4'>مشکلی در ارسال پیام رخ داد ❌</p>";
  }
}
?>

<!-- فونت آوسام برای آیکون‌ها -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php get_footer() ?>
