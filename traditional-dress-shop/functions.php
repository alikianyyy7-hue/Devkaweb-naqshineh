<?php

// غیرفعال کردن استایل‌های پیشفرض ووکامرس

add_filter('woocommerce_enqueue_styles', '__return_false');



// پشتیبانی‌های قالب

function mytheme_setup() {
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('woocommerce');

    register_nav_menus([
        "Header" => "Header Menu",
        "Footer" => "Footer Menu",
    ]);
}
add_action('after_setup_theme', 'mytheme_setup');



// استایل‌ها و اسکریپت‌ها

function naghshineh_enqueue_styles() {
    wp_enqueue_style('naghshineh-style', get_stylesheet_uri());
    wp_enqueue_style('naghshineh-webfont', get_template_directory_uri() . "/assets/fontiran.css");
    wp_enqueue_script('tailwind', "https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4");
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'naghshineh_enqueue_styles');



// تنظیمات سفارشی‌سازی: لینک شبکه‌های اجتماعی

function mytheme_customize_register_social($wp_customize) {
    $wp_customize->add_section('naghshineh_social_links', [
        'title'    => __('Social Media Links', 'naghshineh'),
        'priority' => 30,
    ]);

    $socials = [
        'instagram' => 'Instagram URL',
        'telegram'  => 'Telegram URL',
        'linkedin'  => 'LinkedIn URL',
    ];

    foreach ($socials as $id => $label) {
        $wp_customize->add_setting("naghshineh_$id", [
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control("naghshineh_$id", [
            'label'   => __($label, 'naghshineh'),
            'section' => 'naghshineh_social_links',
            'type'    => 'url',
        ]);
    }
}
add_action('customize_register', 'mytheme_customize_register_social');



// تبدیل اعداد انگلیسی به فارسی

function toPersianNumerals($number) {
    $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    $english = ['0','1','2','3','4','5','6','7','8','9'];
    return str_replace($english, $persian, $number);
}



// غیرفعال‌سازی بخش‌های پیشفرض ووکامرس

function naghshineh_shop_remove_woocommerce_loop_actions() {
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
}
add_action('init', 'naghshineh_shop_remove_woocommerce_loop_actions');

function remove_woocommerce_sidebar_on_archive_product() {
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('wp', 'remove_woocommerce_sidebar_on_archive_product');

function remove_result_count_from_shop() {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
}
add_action('wp', 'remove_result_count_from_shop');

function rwoocommerce_catalog_ordering() {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}
add_action('template_redirect', 'rwoocommerce_catalog_ordering');

function disable_woocommerce_breadcrumb() {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action('wp', 'disable_woocommerce_breadcrumb');



// متاباکس دلخواه

function naghshineh_add_custom_field($fieldName, $postType, $title) {
    add_action('add_meta_boxes', function () use ($fieldName, $postType, $title) {
        add_meta_box(
            $fieldName . '_box',
            $title,
            function ($post) use ($fieldName) {
                $value = get_post_meta($post->ID, $fieldName, true);
                wp_nonce_field($fieldName . '_nonce', $fieldName . '_nonce_field');
                echo '<input type="text" style="width:100%" name="' . esc_attr($fieldName) . '" value="' . esc_attr($value) . '">';
            },
            $postType,
            'normal',
            'default'
        );
    });

    add_action('save_post', function ($post_id) use ($fieldName) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!isset($_POST[$fieldName . '_nonce_field'])) return;
        if (!wp_verify_nonce($_POST[$fieldName . '_nonce_field'], $fieldName . '_nonce')) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST[$fieldName])) {
            $san = sanitize_text_field(wp_unslash($_POST[$fieldName]));
            update_post_meta($post_id, $fieldName, $san);
        } else {
            delete_post_meta($post_id, $fieldName);
        }
    });
}



// افزودن به سبد خرید اختصاصی

function my_custom_add_to_cart_handler() {
    if (isset($_POST['my_add_to_cart_submit'])) {
        if (! isset($_POST['my_add_to_cart_nonce']) || ! wp_verify_nonce($_POST['my_add_to_cart_nonce'], 'my_add_to_cart_action')) {
            return;
        }

        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $quantity   = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        if ($product_id > 0) {
            WC()->cart->add_to_cart($product_id, $quantity);
            wp_safe_redirect(wc_get_cart_url());
            exit;
        }
    }
}
add_action('init', 'my_custom_add_to_cart_handler');

add_filter('woocommerce_add_to_cart_redirect', function() {
    return false; // جلوگیری از ریدایرکت
});



// کاستومایزر درباره ما (مأموریت + کارگاه‌ها + آیکون‌ها)

function mytheme_customize_register_about_section($wp_customize) {
    // بخش درباره ما
    $wp_customize->add_section('about_section', [
        'title' => __('درباره ما', 'mytheme'),
        'priority' => 30,
    ]);

    // متن مأموریت‌ها
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("mission_{$i}_text", [
            'default' => "این متن توضیح کوتاهی درباره مأموریت {$i} است.",
            'sanitize_callback' => 'sanitize_textarea_field'
        ]);
        $wp_customize->add_control("mission_{$i}_text_control", [
            'label' => __("متن مأموریت {$i}", 'mytheme'),
            'section' => 'about_section',
            'settings' => "mission_{$i}_text",
            'type' => 'textarea',
        ]);
    }

    // آیکون‌ها
    $wp_customize->add_section('icons_section', [
        'title' => __('آیکون‌ها', 'mytheme'),
        'priority' => 35,
    ]);

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("icon_{$i}_title", [
            'default' => "عنوان آیکون {$i}",
            'sanitize_callback' => 'sanitize_text_field'
        ]);
        $wp_customize->add_control("icon_{$i}_title_control", [
            'label' => "عنوان آیکون {$i}",
            'section' => 'icons_section',
            'settings' => "icon_{$i}_title",
            'type' => 'text',
        ]);

        $wp_customize->add_setting("icon_{$i}_img", [
            'default' => 'https://via.placeholder.com/100',
            'sanitize_callback' => 'esc_url'
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "icon_{$i}_img_control", [
            'label' => "آیکون {$i}",
            'section' => 'icons_section',
            'settings' => "icon_{$i}_img",
        ]));
    }

    // کارگاه‌ها
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("partner_{$i}_title", [
            'default' => "کارگاه {$i}",
            'sanitize_callback' => 'sanitize_text_field'
        ]);
        $wp_customize->add_control("partner_{$i}_title_control", [
            'label' => "عنوان کارگاه {$i}",
            'section' => 'about_section',
            'settings' => "partner_{$i}_title",
            'type' => 'text'
        ]);

        $wp_customize->add_setting("partner_{$i}_desc", [
            'default' => "توضیح کوتاه درباره کارگاه {$i}",
            'sanitize_callback' => 'sanitize_textarea_field'
        ]);
        $wp_customize->add_control("partner_{$i}_desc_control", [
            'label' => "توضیح کارگاه {$i}",
            'section' => 'about_section',
            'settings' => "partner_{$i}_desc",
            'type' => 'textarea'
        ]);

        $wp_customize->add_setting("partner_{$i}_image", [
            'default' => '',
            'sanitize_callback' => 'esc_url'
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "partner_{$i}_image_control",
            [
                'label' => "عکس کارگاه {$i}",
                'section' => 'about_section',
                'settings' => "partner_{$i}_image"
            ]
        ));
    }
}
add_action('customize_register', 'mytheme_customize_register_about_section');



// کاستومایزر سوالات متداول

function faq_customizer_settings($wp_customize) {
    $wp_customize->add_section('faq_section', [
        'title'    => 'سوالات متداول',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('faq_title', [
        'default' => 'سوالات متداول',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('faq_title', [
        'label'   => 'عنوان بخش',
        'section' => 'faq_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('faq_desc', [
        'default' => 'اینجا متن توضیحی بخش سوالات متداول قرار می‌گیرد.',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('faq_desc', [
        'label'   => 'پاراگراف زیر عنوان',
        'section' => 'faq_section',
        'type'    => 'textarea',
    ]);

    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting("faq_question_$i", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("faq_question_$i", [
            'label'   => "سوال $i",
            'section' => 'faq_section',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting("faq_answer_$i", [
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control("faq_answer_$i", [
            'label'   => "جواب $i",
            'section' => 'faq_section',
            'type'    => 'textarea',
        ]);
    }

    $wp_customize->add_setting('faq_right_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'faq_right_image',
        [
            'label' => 'عکس سمت راست',
            'section' => 'faq_section',
            'settings' => 'faq_right_image'
        ]
    ));
}
add_action('customize_register', 'faq_customizer_settings');



// مقالات و جستجوی AJAX

function mytheme_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script(
        'like-js',
        get_template_directory_uri() . '/like.js',
        ['jquery'],
        null,
        true
    );
    wp_localize_script('like-js', 'like_ajax', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

function handle_post_like_toggle() {
    $post_id = intval($_POST['post_id']);
    $liked = filter_var($_POST['liked'], FILTER_VALIDATE_BOOLEAN);

    if ($post_id) {
        $likes = get_post_meta($post_id, 'post_likes', true);
        $likes = $likes ? intval($likes) : 0;

        if ($liked) {
            $likes++;
        } else {
            $likes = max(0, $likes - 1);
        }

        update_post_meta($post_id, 'post_likes', $likes);
        echo $likes;
    }

    wp_die();
}
add_action('wp_ajax_post_like_toggle', 'handle_post_like_toggle');
add_action('wp_ajax_nopriv_post_like_toggle', 'handle_post_like_toggle');



// جستجوی ایجکسی مقالات

function enqueue_ajax_search() {
    wp_enqueue_script('ajax-search', get_template_directory_uri() . '/js/ajax-search.js', ['jquery'], null, true);
    wp_localize_script('ajax-search', 'ajaxsearch', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_search');

function search_articles() {
    $term = sanitize_text_field($_POST['term']);
    $query = new WP_Query([
        's' => $term,
        'post_type' => 'post',
        'posts_per_page' => 5
    ]);
    if ($query->have_posts()) {
        foreach ($query->posts as $post) {
            echo '<li><a href="' . get_permalink($post) . '" class="text-red-700 hover:underline">' . esc_html($post->post_title) . '</a></li>';
        }
    } else {
        echo '<li>مقاله‌ای یافت نشد</li>';
    }
    wp_die();
}
add_action('wp_ajax_nopriv_search_articles', 'search_articles');
add_action('wp_ajax_search_articles', 'search_articles');


// حذف نمایش عنوان صفحه در همه برگه‌ها
add_filter('the_title', function ($title, $id) {
    if (is_page() && in_the_loop() && !is_admin()) {
        return '';
    }
    return $title;
}, 10, 2);
