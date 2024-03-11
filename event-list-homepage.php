// Displays the latest three upcoming events on the home page
// Queries the "events" custom post type
// Uses the "datetime" field key to restrict events to today and future events
// Uses the "poster_image" field to display the graphic image associated with the event
// Uses the Post Title as the event title
// Uses the [event_list_homepage] shortcode
// This is code is based on the [event_list] shortcode referenced in event-list.php
// This code uses the same CSS referenced in event-list.css
// 

function display_events_homepage($atts) {
    // Shortcode attributes
    $atts = shortcode_atts(
        array(),
        $atts,
        'event_list_homepage'
    );

    // Define custom query parameters
    $args = array(
        'post_type'      => 'events',
        'posts_per_page' => 3, // Display up to three events
        'meta_key'       => 'datetime',
        'orderby'        => 'meta_value',
        'order'          => 'ASC', // Sort by 'datetime' in ascending order
        'meta_query'     => array(
            array(
                'key'     => 'datetime',
                'value'   => date('Y-m-d H:i:s'),
                'compare' => '>=', // Only events occurring now or in the future
                'type'    => 'DATETIME',
            ),
        ),
    );

    // Custom query
    $events_query = new WP_Query($args);

    // Display events
    if ($events_query->have_posts()) {
        ob_start(); // Start output buffering
        ?>

        <div class="events-list">
            <?php while ($events_query->have_posts()) : $events_query->the_post(); ?>
                <div class="event">
                    <?php $poster_image = get_field('poster_image'); ?>
                    <?php if ($poster_image) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url($poster_image); ?>" alt="<?php the_title_attribute(); ?>" class="poster-image">
                        </a>
                    <?php endif; ?>
                    <h4><a href="<?php the_permalink(); ?>" class="event-title"><?php the_title(); ?></a></h4>
                    <p class="event-datetime"><?php echo date('F j, Y, g:i a', strtotime(get_field('datetime'))); ?></p>
                    <!-- Add other event details as needed -->
                </div>
            <?php endwhile; ?>
        </div>

        <?php
        wp_reset_postdata(); // Reset post data
        return ob_get_clean(); // Return buffered output
    }

    return ''; // Return an empty string if no events found
}
add_shortcode('event_list_homepage', 'display_events_homepage');
