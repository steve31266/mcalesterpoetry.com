// Display Google Map
// This shortcode [display_google_map] displays a Google Map via Google Maps API using the Google Map pin stored in the Google Map Field of ACF.
// This uses the Google Map API account for steve@choctawwebsites.com, project ID: proud-armor-416306
// https://console.cloud.google.com/google/maps-apis/home?project=proud-armor-416306&authuser=1
// Variable "location" refers to the ACF field key for the "events" custom post type
// Note: Line 25 requires your actual Google Map API key "xxxxxx"

// Register the shortcode [display_google_map]
add_shortcode('display_google_map', 'display_google_map_shortcode');

// Shortcode callback function
function display_google_map_shortcode($atts) {
    // Check if Advanced Custom Fields plugin is active
    if (function_exists('get_field')) {
        // Get the location field value for the current post
        $location = get_field('location');

        // Check if the location field is not empty
        if ($location) {
            // Extract latitude and longitude from the location field
            $latitude = $location['lat'];
            $longitude = $location['lng'];
            
            // Output the Google Map with the specified coordinates and API key
            $api_key = 'xxxxxx'; // Replace with your actual API key
            $map_output = '<div id="google-map" style="height: 400px;"></div>';
            $map_output .= '<script>
                                function initMap() {
                                    var map = new google.maps.Map(document.getElementById("google-map"), {
                                        center: {lat: ' . $latitude . ', lng: ' . $longitude . '},
                                        zoom: 14
                                    });

                                    var marker = new google.maps.Marker({
                                        position: {lat: ' . $latitude . ', lng: ' . $longitude . '},
                                        map: map,
                                        title: "Event Location"
                                    });
                                }
                            </script>';
            $map_output .= '<script async defer src="https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&callback=initMap"></script>';

            return $map_output;
        } else {
            // Location field is empty
            return 'Location not set for this event.';
        }
    } else {
        // Advanced Custom Fields plugin is not active
        return 'Please install and activate the Advanced Custom Fields plugin.';
    }
}
