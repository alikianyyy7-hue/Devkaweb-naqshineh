<?php
get_header();
?>

<style>
  :root{ --accent: #940303; }
</style>
<main class="flex items-center justify-center mt-14 py-12 px-4" dir="rtl">
  <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
    <!-- LEFT: تصویر -->
    <div class="hidden md:flex items-center justify-center bg-gradient-to-b from-[#fdecea] to-white p-6">
      <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/login-phot.jpg' ); ?>" alt="تصویر" class="w-full h-[420px] object-cover rounded-xl shadow-sm" />
    </div>

    <!-- RIGHT: فرم -->
    <div class="p-6 md:p-10">
      <div class="max-w-md mx-auto">
        <!-- لوگو + عنوان -->
        <div class="flex items-center gap-3 mb-6">
          <div class="flex items-center gap-3">
            <?php
              // اگر لوگو تنظیم شده باشد نمایش می‌دهد، در غیر این صورت نام سایت
              if ( function_exists('the_custom_logo') && has_custom_logo() ) {
                the_custom_logo();
              } else {
                echo '<div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-xl font-bold text-gray-700">' . esc_html( substr( get_bloginfo('name'), 0, 1 ) ) . '</div>';
              }
            ?>
            <div>
              <h1 id="auth-title" class="text-xl font-semibold text-gray-800">ثبت‌نام</h1>
              <p id="auth-sub" class="text-sm mt-1.5 text-gray-500">خوش آمدید — فرم را پر کنید</p>
            </div>
          </div>
        </div>

        <!-- پیام سروری (اختیاری) -->
        <?php if ( ! empty( $notice ) ): ?>
          <div class="mb-4 rounded-md bg-yellow-50 border border-yellow-100 text-yellow-800 px-4 py-2 text-sm">
            <?php echo esc_html( $notice ); ?>
          </div>
        <?php endif; ?>

        <!-- فرم (یک فرم که حالتش با js تغییر می‌کنه) -->
        <form id="auth-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>" class="space-y-4" novalidate>
          <?php wp_nonce_field( 'auth_action', 'auth_nonce' ); ?>
          <input type="hidden" name="mode" id="auth-mode" value="register">

          <!-- REGISTER fields -->
          <div id="field-username" class="">
            <label class="block text-sm text-gray-600 mb-1">نام کاربری</label>
            <input name="username" type="text" autocomplete="username"
                   class="w-full px-3 py-2 rounded-md border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition" required>
          </div>

          <div id="field-email" class="">
            <label class="block text-sm text-gray-600 mb-1">ایمیل</label>
            <input name="email" type="email" autocomplete="email"
                   class="w-full px-3 py-2 rounded-md border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition" required>
          </div>

          <div id="field-pass" class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <label class="block text-sm text-gray-600 mb-1">رمز عبور</label>
              <input name="password" type="password" autocomplete="new-password"
                     class="w-full px-3 py-2 rounded-md border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition" required>
            </div>

            <!-- confirm password only visible in register -->
            <div id="field-pass-confirm">
              <label class="block text-sm text-gray-600 mb-1">تکرار رمز عبور</label>
              <input name="password_confirm" type="password" autocomplete="new-password"
                     class="w-full px-3 py-2 rounded-md border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-[var(--accent)] transition" required>
            </div>
          </div>

          <!-- BUTTONS: دکمه ثبت + لینک وضعیت ورود -->
          <div class="flex items-center gap-3 justify-between">
            <button type="submit" name="register" id="submit-btn"
                    class="flex-1 bg-[var(--accent)] text-white py-2 rounded-md font-medium hover:brightness-90 transition">
              ثبت‌نام
            </button>

            <div class="text-sm text-gray-600">
              <span id="have-account-text">حساب دارد؟</span>
              <button type="button" id="toggle-link" class="text-[var(--accent)] font-semibold mr-2 focus:outline-none">
                وارد شوید
              </button>
            </div>
          </div>
        </form>

        <!-- لینک کمکی (مثلاً فراموشی رمز) -->
        <div class="mt-4 text-center text-sm">
          <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-gray-500 hover:text-[var(--accent)]">فراموشی رمز عبور</a>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- جاوااسکریپت سبک برای سوییچ بین ثبت‌نام و ورود -->
<script>
  (function(){
    const titleEl = document.getElementById('auth-title');
    const subEl = document.getElementById('auth-sub');
    const modeInput = document.getElementById('auth-mode');
    const submitBtn = document.getElementById('submit-btn');
    const toggleBtn = document.getElementById('toggle-link');
    const haveText = document.getElementById('have-account-text');

    const fieldUsername = document.getElementById('field-username');
    const fieldEmail = document.getElementById('field-email');
    const fieldPass = document.getElementById('field-pass');
    const fieldPassConfirm = document.getElementById('field-pass-confirm');

    // وضعیت فعلی: true = register, false = login
    let isRegister = true;

    function switchToLogin() {
      isRegister = false;
      // عنوان و توضیح
      titleEl.textContent = 'ورود';
      subEl.textContent = 'وارد شوید تا به حساب‌تان دسترسی داشته باشید.';
      // فیلدها: در ورود تکرار رمز را پنهان کن، ولی نام کاربری و ایمیل و رمز را نمایش بده
      fieldPassConfirm.style.display = 'none';
      // تغییر mode hidden input
      modeInput.value = 'login';
      // دکمه submit
      submitBtn.textContent = 'ورود';
      submitBtn.name = 'login';
      // لینک کنار دکمه حالا بگو «حساب نداری؟ ثبت‌نام»
      haveText.textContent = 'حساب ندارید؟';
      toggleBtn.textContent = 'ثبت‌نام';
      // تمرکز روی اولین فیلد مناسب
      fieldUsername.querySelector('input').focus();
    }

    function switchToRegister() {
      isRegister = true;
      titleEl.textContent = 'ثبت‌نام';
      subEl.textContent = 'فرم ثبت‌نام را تکمیل کنید.';
      fieldPassConfirm.style.display = 'block';
      modeInput.value = 'register';
      submitBtn.textContent = 'ثبت‌نام';
      submitBtn.name = 'register';
      haveText.textContent = 'حساب دارید؟';
      toggleBtn.textContent = 'وارد شوید';
      fieldUsername.querySelector('input').focus();
    }

    // مقدار اولیه: ثبت‌نام
    switchToRegister();

    // handler برای لینک
    toggleBtn.addEventListener('click', function(){
      if (isRegister) switchToLogin();
      else switchToRegister();
    });

    // برای دسترسی با کیبورد
    toggleBtn.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault(); toggleBtn.click();
      }
    });
  })();
</script>

<?php get_footer(); ?>
