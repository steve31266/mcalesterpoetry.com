// Create 301 redirect from /events/ taxonomy page to /upcoming-events/ static page

function custom_redirect() {
    $requested_url = $_SERVER['REQUEST_URI'];

    // Check if the requested URL is the specified one
    if ($requested_url == '/events/') {
        // Redirect to the new URL with a 301 status code
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: https://www.mcalesterpoetry.com/upcoming-events/");
        exit();
    }
}

// Hook the custom_redirect function to the template_redirect action
add_action('template_redirect', 'custom_redirect');
