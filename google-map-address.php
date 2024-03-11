// Function to generate Google Map Address shortcode [google_map_address]
// This shortcode extracts the place name, street address, city, state, zip from the Google Map field in ACF and displays it.
// Variable "location" refers to the ACF field key for the Google Map field type.
// This is used in the "events" Single Post element.

function display_google_map_address() {
    $location = get_field('location');
    if ($location) {

        // Initialize variables for each line
        $firstLine = '';
        $secondLine = '';
        $thirdLine = '';

        // Construct HTML for each line.
        if (isset($location['name'])) {
            $firstLine = sprintf('<span class="segment-name">%s</span><br>', $location['name']);
        }

        if (isset($location['street_number']) && isset($location['street_name'])) {
            $secondLine = sprintf('<span class="segment-street_number">%s</span> %s<br>', $location['street_number'], $location['street_name']);
        }

        if (isset($location['city'])) {
            $thirdLine = sprintf('<span class="segment-city">%s</span>', $location['city']);
        }

        if (isset($location['state'])) {
            $thirdLine .= sprintf(', %s ', $location['state']);
        }

        if (isset($location['post_code'])) {
            $thirdLine .= sprintf('%s', $location['post_code']);
        }

        // Display HTML.
        return '<p>' . $firstLine . $secondLine . $thirdLine . '</p>';
    } else {
        return '<p>No location set for this post.</p>';
    }
}

// Register the shortcode
add_shortcode('google_map_address', 'display_google_map_address');
