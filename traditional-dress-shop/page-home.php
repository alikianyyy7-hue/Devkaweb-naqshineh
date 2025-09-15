  <?php get_header() ?>
  <main id="main" class="site-main ">
      <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_title('<h2>', '</h2>');
                //the_content();
                // the_post_thumbnail();
            }
        } else {
            echo '<p>No content found.</p>';
        }
        ?>
      <!-- Hero Section -->
      <?php get_template_part('template-parts/hero'); ?>

      <!-- Features Section -->
      <?php get_template_part('template-parts/features'); ?>

      <!-- FAQ Section -->
      <?php get_template_part('template-parts/faq'); ?>

  </main>
  <?php get_footer()
    ?>