<?php
/* Template Name: Articles Page */
get_header();
?>

<div class="bg-[#ede1d4] min-h-screen p-4 sm:p-6">
  <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">

    <!-- سرچ مخصوص موبایل (بالای مقالات) -->
    <div class="block md:hidden mb-6">
      <form role="search" method="get" class="flex flex-col sm:flex-row gap-2" action="<?php echo home_url('/'); ?>">
        <input type="search" id="article-search" name="s" placeholder="جستجو..."
               class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-800"
               value="<?php echo get_search_query(); ?>">
        <button type="submit" class="bg-[#940303] text-white px-4 py-2 rounded hover:bg-red-800 w-full sm:w-auto">
          جستجو
        </button>
      </form>
      <ul id="search-suggestions" class="mt-2 space-y-1 text-gray-700"></ul>
    </div>

    <!-- Main Content -->
    <main class="md:col-span-3 space-y-6 bg-[#f4eddf] p-6 sm:p-10 order-1">

      <?php
      $articles_query = new WP_Query([
          'post_type' => 'post',
          'posts_per_page' => 10,
          'orderby' => 'date',
          'order' => 'DESC',
      ]);

      if($articles_query->have_posts()):
          while($articles_query->have_posts()): $articles_query->the_post(); ?>

          <article class="bg-[#eee2d0] rounded shadow p-4 sm:p-6 flex flex-col md:flex-row gap-4 sm:gap-6 hover:shadow-lg transition">

            <!-- عکس -->
            <div class="md:w-1/3">
              <?php if(has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url('medium'); ?>" 
                     class="rounded w-full h-48 sm:h-64 md:h-auto object-cover" 
                     alt="<?php the_title(); ?>">
              <?php endif; ?>
            </div>

            <!-- متن خلاصه -->
            <div class="md:w-2/3 flex flex-col">
              <h1 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2"><?php the_title(); ?></h1>
              <div class="text-gray-500 mb-4 text-sm sm:text-base">
                <span><?php echo get_the_date(); ?></span> | <span><?php the_author(); ?></span>
              </div>
              <p class="mb-4 text-gray-900 text-sm sm:text-base"><?php echo wp_trim_words(get_the_content(), 40, '...'); ?></p>

              <div class="container flex flex-col sm:flex-row sm:justify-between gap-2 sm:gap-0">
                 <a href="<?php the_permalink(); ?>" 
                    class="w-full sm:w-auto text-center bg-[#940303] text-white px-4 py-2 rounded hover:bg-red-800">
                    ادامه مطلب
                 </a>

                 <!-- دکمه لایک -->
                  <?php
                    $likes = get_post_meta(get_the_ID(), 'post_likes', true);
                    if(!$likes) $likes = 0;
                    $user_liked = isset($_COOKIE['liked_' . get_the_ID()]);
                  ?>
                  <button class="like-button relative flex items-center justify-center gap-1 text-lg sm:text-base <?php echo $user_liked ? 'liked' : ''; ?>" 
                          data-post-id="<?php the_ID(); ?>">
                      <span class="like-icon">
                          <?php echo $user_liked ? '<i class="fas fa-heart text-red-500"></i>' : '<i class="far fa-heart"></i>'; ?>
                      </span>
                      <span class="like-count text-xs"><?php echo $likes; ?></span>
                      <span class="like-circle absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-red-500 opacity-0"></span>
                  </button>
              </div>
            </div>

          </article>

      <?php endwhile;
      else:
          echo '<p>مقاله‌ای یافت نشد.</p>';
      endif;
      wp_reset_postdata();
      ?>

    </main>

    <!-- سایدبار (فقط در دسکتاپ) -->
    <aside class="hidden md:block md:col-span-1 space-y-6 sticky top-6 order-2">

      <!-- سرچ داخل سایدبار (فقط دسکتاپ) -->
      <div>
        <form role="search" method="get" class="flex" action="<?php echo home_url('/'); ?>">
          <input type="search" id="article-search" name="s" placeholder="جستجو..."
                 class="flex-1 border border-gray-300 rounded-l px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-800"
                 value="<?php echo get_search_query(); ?>">
          <button type="submit" class="bg-[#940303] text-white px-4 py-2 rounded-r hover:bg-red-800">
            جستجو
          </button>
        </form>
        <ul id="search-suggestions" class="mt-2 space-y-1 text-gray-700"></ul>
      </div>

      <!-- پست های اخیر -->
      <div>
        <h2 class="text-lg font-semibold text-blue-900 mb-2">آخرین مطالب</h2>
        <ul class="space-y-2">
          <?php
          $latest_posts = new WP_Query(['posts_per_page' => 5]);
          if($latest_posts->have_posts()):
            while($latest_posts->have_posts()): $latest_posts->the_post(); ?>
              <li>
                <a href="<?php the_permalink(); ?>" class="text-[#940303] hover:underline"><?php the_title(); ?></a>
              </li>
            <?php endwhile;
          endif;
          wp_reset_postdata();
          ?>
        </ul>
      </div>

      <!-- دسته بندی -->
      <div>
        <h2 class="text-lg font-semibold text-blue-900 mb-2">دسته‌بندی‌ها</h2>
        <ul class="space-y-2">
          <?php wp_list_categories([
            'title_li' => '',
            'show_count' => true,
          ]); ?>
        </ul>
      </div>

    </aside>

  </div>
</div>

<?php get_footer(); ?>
