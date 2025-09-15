<section class="py-12 px-4" style="background-color:#f4eddf;">
  <h2 class="text-2xl font-bold mb-8 text-right" style="color:#1c2a3a">
    وبلاگ ها
  </h2>

  <!-- کانتینر: عمودی روی موبایل، افقی و اسکرول روی تبلت و دسکتاپ -->
  <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0 overflow-x-auto">
    <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1
      );
      $query = new WP_Query($args);

      if($query->have_posts()):
        while($query->have_posts()): $query->the_post();

          // تعداد لایک
          $likes = get_post_meta(get_the_ID(), 'post_likes', true);
          if(!$likes) $likes = 0;

          // بررسی اینکه کاربر قبلا لایک کرده یا نه
          $user_liked = isset($_COOKIE['liked_' . get_the_ID()]);
    ?>

    <div class="bg-[#f6f0e9] border border-[#083b6a] rounded-2xl shadow flex-shrink-0 w-full sm:w-64 p-4 flex flex-col">
      <?php if(has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail('medium', ['class' => 'w-full h-36 object-cover rounded-xl mb-4']); ?>
        </a>
      <?php endif; ?>

      <h3 class="text-lg font-semibold mb-2 line-clamp-2"><?php the_title(); ?></h3>
      <p class="text-sm text-gray-500 mb-2">
        نویسنده: <?php the_author(); ?> | <?php echo get_the_date(); ?>
      </p>

      <p class="text-gray-700 text-sm mb-4 line-clamp-3">
        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
      </p>

      <!-- دکمه ادامه مطلب و در لایک کنار هم -->
      <div class="flex items-center justify-between mt-auto space-x-3">
        <a href="<?php the_permalink(); ?>" 
           class="flex-1 bg-[#083b6a] text-white px-3 py-2 rounded-lg text-sm text-center hover:bg--[#083b6a] transition">
          ادامه مطلب
        </a>

        <button class="like-button relative flex flex-col items-center text-lg <?php echo $user_liked ? 'liked' : ''; ?>" 
                data-post-id="<?php the_ID(); ?>">
          <span class="like-icon text-lg">
            <?php echo $user_liked ? '<i class="fas fa-heart text-red-500"></i>' : '<i class="far fa-heart"></i>'; ?>
          </span>
          <span class="like-count text-xs mt-0.5"><?php echo $likes; ?></span>
          <span class="like-circle absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-red-500 opacity-0"></span>
        </button>
      </div>
    </div>

    <?php
        endwhile;
        wp_reset_postdata();
      else:
        echo '<p>هیچ مقاله‌ای یافت نشد.</p>';
      endif;
    ?>
  </div>
</section>