<?php get_header(); ?>

<main class="single-post max-w-6xl mx-auto px-6 py-10 bg-[#fdfbf7] rounded-2xl shadow-sm text-gray-800 leading-relaxed">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <!-- عنوان مقاله -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">
      <?php the_title(); ?>
    </h1>

    <!-- اطلاعات نویسنده و تاریخ -->
    <div class="text-sm text-gray-500 mb-6">
      نوشته شده توسط <?php the_author(); ?> در <?php the_time( get_option('date_format') ); ?>
    </div>

    <!-- تصویر شاخص -->
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="my-6">
        <?php the_post_thumbnail( 'large', [
          'class' => 'rounded-xl shadow-sm w-full h-auto object-cover max-h-[600px]'
        ] ); ?>
      </div>
    <?php endif; ?>

    <!-- محتوای مقاله -->
    <div class="prose prose-lg max-w-none">
      <?php the_content(); ?>
    </div>

    <!-- ناوبری پست بعد/قبل -->
    <div class="flex justify-between items-center mt-10 pt-6 border-t border-gray-200 text-sm">
      <div class="text-left">
        <?php previous_post_link( '<span class="block text-gray-500">← مقاله قبل</span> %link' ); ?>
      </div>
      <div class="text-right">
        <?php next_post_link( '<span class="block text-gray-500">مقاله بعد →</span> %link' ); ?>
      </div>
    </div>

  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
