// This automatically creates a link rel=canonical tag for the current post, setting the current URL as the canonical

function add_canonical_tag() {
    // Check if it's a single post or page
    if (is_singular()) {
        global $post;
        $canonical_url = get_permalink($post->ID);
    } else {
        // If not a single post or page, use the current URL
        $canonical_url = home_url(add_query_arg(array(), $wp->request));
    }

    // Output the canonical tag in the head
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '" />' . "\n";
}

add_action('wp_head', 'add_canonical_tag');
