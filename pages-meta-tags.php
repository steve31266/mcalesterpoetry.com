// Write Meta tags for the site's static pages
// "case 25" refers to post_id 25

function add_custom_meta_tags() {
    // Get the current post ID
    $post_id = get_the_ID();

    // Define default values for meta tags
    $default_description = "McAlester Poetry Club meets every second Thursday of the month at 5:30 PM at McAlester Public Library and is open to the public.";
    $default_image = "https://www.mcalesterpoetry.com/wp-content/uploads/2024/03/mcalester-poetry-club-facebook-image.jpg";

    // Set specific values for each post ID
    switch ($post_id) {
        case 25: // Home Page
            $description = "McAlester Poetry Club meets every second Thursday of the month at 5:30 PM at McAlester Public Library and is open to the public.";
            $og_title = "McAlester Poetry Club | Home";
            $og_description = $description;
            $og_image = $default_image;
            break;

        case 1389: // Upcoming Events
            $description = "A list of upcoming events hosted by McAlester Poetry Club, including monthly meetings, workshops, readings, guest speakers, and special events.";
            $og_title = "Upcoming Events | McAlester Poetry Club";
            $og_description = $description;
            $og_image = $default_image;
            break;

        case 528: // Contact
            $description = "Contact the McAlester Poetry Club, learn how to join, the mailing address for the club, and send us a message.";
            $og_title = "Contact Us | McAlester Poetry Club";
            $og_description = $description;
            $og_image = $default_image;
            break;

        default:
            // Use default values for other pages
            $description = $default_description;
            $og_title = get_the_title();
            $og_description = $default_description;
            $og_image = $default_image;
            break;
    }

    // Output the meta tags in the <head> section
    echo '<meta name="description" content="' . esc_attr($description) . '" />' . PHP_EOL;
    echo '<meta property="og:title" content="' . esc_attr($og_title) . '" />' . PHP_EOL;
    echo '<meta property="og:description" content="' . esc_attr($og_description) . '" />' . PHP_EOL;
    echo '<meta property="og:image" content="' . esc_url($og_image) . '" />' . PHP_EOL;
}

// Hook the function to the wp_head action
add_action('wp_head', 'add_custom_meta_tags');
