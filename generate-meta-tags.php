// This automatically generates META tags for the "events" custom post type and puts them into the <head>
// og:image is populated from "poster_image" field
// og:title is populated from the Post Title
// og:description is populated from the "description" field
// meta description is populated from the "description" field  

function custom_meta_tags_in_head() {
    if (is_single() && get_post_type() == 'events') {
        $post_id = get_the_ID();
        $image_url = get_field('poster_image', $post_id);
        $post_title = get_the_title() . ' | McAlester Poetry Club';
        $post_description = get_field('description', $post_id);

        if (!empty($image_url)) {
            echo '<meta property="og:image" content="' . esc_url($image_url) . '" />' . PHP_EOL;
        }

        if (!empty($post_title)) {
            echo '<meta property="og:title" content="' . esc_html($post_title) . '" />' . PHP_EOL;
        }

        if (!empty($post_description)) {
            // Strip HTML tags before limiting to 160 characters
            $stripped_description = wp_strip_all_tags($post_description);
            $trimmed_description = mb_substr($stripped_description, 0, 160);
            echo '<meta property="og:description" content="' . esc_html($trimmed_description) . '" />' . PHP_EOL;
            echo '<meta name="description" content="' . esc_html($trimmed_description) . '" />' . PHP_EOL;
        }
    }
}
add_action('wp_head', 'custom_meta_tags_in_head');
