// Custom function to display custom post tyle "events" based on 'datetime' short code [event_list]
// [event_list type="upcoming"] to display today and future events
// [event_list type="past"] to display yesterday and past events
// References CSS class "poster-image" see file "datetime.css" 

function display_events($atts) {
    // Shortcode attributes
    $atts = shortcode_atts(
        array(
            'type' => 'upcoming', // Default to upcoming events
        ),
        $atts,
        'event_list'
    );

    // Define custom query parameters
    $args = array(
        'post_type'      => 'events',
        'posts_per_page' => ($atts['type'] === 'past') ? 6 : -1, // Display all posts for upcoming, limit to 6 for past
        'meta_key'       => 'datetime',
        'orderby'        => 'meta_value',
        'order'          => ($atts['type'] === 'upcoming') ? 'ASC' : 'DESC', // Sort by 'datetime'
        'meta_query'     => array(
            array(
                'key'     => 'datetime',
                'value'   => date('Y-m-d H:i:s'),
                'compare' => ($atts['type'] === 'upcoming') ? '>=' : '<', // Upcoming events or past events
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
            <h4 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
add_shortcode('event_list', 'display_events');
