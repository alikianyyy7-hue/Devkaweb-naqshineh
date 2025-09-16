# Devkaweb-naqshineh


**Naqshineh** is an online store dedicated to traditional Iranian clothing, designed and developed by the **Devkaweb** team.  
Our main mission is to **promote Iranian culture** through modern and user-friendly digital solutions.

🔗 Live Demo: [http://devkaweb.hodecode.ir](http://devkaweb.hodecode.ir)

---

##  Features
- User-friendly product browsing and categorization  
- Advanced product search functionality  
- Welcome message for visitors  
- Like system for clothing items and articles  
- Online payment integration  
- Blog section for cultural articles  
- Dedicated sections: About Us, Contact Us, Products, and FAQ  

---

##  Values and Future Goals
- Modern and user-friendly design  
- Promoting and preserving **Iranian culture** through fashion  
- Expanding the collection to include all types of local and traditional clothing  
- Supporting artisans and creating job opportunities in handicrafts  
- Building a cultural e-commerce platform with long-term impact  

---

##  Tech Stack
- WordPress (PHP-based CMS)  
- Custom JavaScript  
- TailwindCSS  

---

##  Installation
1. Clone the repository or download the project files.  
2. Set up a local server environment (e.g., XAMPP, WAMP) or use a PHP-supported hosting.  
3. Import the database and configure the `wp-config.php` file.  
4. Upload the project files to the server or place them in the `htdocs` folder for local testing.  
5. Access the website through your localhost or domain.  

---

##  Challenges & Solutions

### 1. Inconsistent Like Counts Between Pages
- **Bug:** The number of likes on the homepage and the blog page were different.  
- **Cause:** Different meta keys were used (`post_likes` vs. `_post_likes`).  
- **Solution:** Unified the meta key across all sections:  
  ```php
  $likes = get_post_meta(get_the_ID(), 'post_likes', true);

2. Likes Resetting After Page Refresh

Bug: After liking a post and refreshing, the heart icon returned to empty.

Cause: The like state was only updated in JavaScript and not stored.

Solution:

Added cookies (liked_{post_id}) to persist likes for guest users.

Checked cookies in PHP before rendering the like button:
$user_liked = isset($_COOKIE['liked_' . get_the_ID()]);

3. Heart Icon Not Showing for Previous Likes

Bug: Previously liked articles didn’t display a filled heart on reload.

Cause: DOM-based checks only, with no cookie validation.

Solution: Verified cookies during page load and applied the liked class and red heart icon.

4. Like Script Not Loading on All Pages

Bug: Like button didn’t work on some pages, such as the blog page.

Cause: like.js was not enqueued site-wide.

Solution: Updated functions.php to enqueue the script globally:

function mytheme_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script(
        'like-js',
        get_template_directory_uri() . '/like.js',
        array('jquery'),
        null,
        true
    );
    wp_localize_script('like-js', 'like_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

5. Contact Form Validation Issue

Bug: When fields were incomplete, the form reset due to default browser validation on type="submit".

Cause: Browser’s built-in validation cleared form data.

Solution:

Changed the button type from submit to button.

Implemented full validation in JavaScript to handle success/error messages.

Fields remain filled unless the form is successfully submitted.

6. Responsive Design for "Our Partners" Section

Bug: Layout issues on tablets and laptops caused misaligned text and images.

Cause: Flexbox direction was not optimized for different breakpoints.

Solution:

Used flex-col for mobile (image above text).

Applied sm:flex-row for tablet/desktop (image on the right, text on the left).

Achieved consistent responsive design across all devices.
Team

This project was created and developed by Devkaweb team members:

Zahra Kiani

Reyhaneh Izadi
