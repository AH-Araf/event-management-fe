<?php

// Function to fetch events from the Laravel API
function get_events_from_api($category = '') {
    $url = 'http://localhost:8000/api/v1/events';
    
    // Append category to the URL if provided
    if ($category) {
        $url .= '/category/' . $category;
    }

    // Make the API request
    $response = wp_remote_get($url);

    // Handle errors
    if (is_wp_error($response)) {
        return 'Failed to retrieve events';
    }

    // Get the body content of the response
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    // Check if the response is valid JSON and contains event data
    if (!$data || empty($data)) {
        return [];
    }

    return $data;
}

// Shortcode to display event list in a 3-column grid with card design
function event_list_shortcode() {
    // Get categories for the selection input
    $categories = [
        'All Events',
        'Conferences',
        'Workshops',
        'Seminars',
        'Webinars',
        'Festivals',
        'ProductLaunches',
        'CorporateMeetings',
        'TradeShows',
        'Fundraisers',
        'NetworkingEvents',
        'Music',
        'Dance',
        'Art',
        'Technology',
        'Health&Wellness',
    ];

    // Create the output with BEM-style classes
    $output = '<div class="event-filter">
                    <label for="categorySelect" class="event-filter__label">Select Category:</label>
                    <select id="categorySelect" class="event-filter__select">
                        <option value="">-- All Events --</option>';
    
    foreach ($categories as $category) {
        $output .= '<option value="' . esc_attr($category) . '">' . esc_html($category) . '</option>';
    }
    
    $output .= '</select>
                <button id="filterEvents" class="event-filter__button">Filter Events</button>
            </div>
            <div id="eventGrid" class="event-grid"></div>
            <div id="eventMessage" class="event-message"></div>
            <script>
                document.getElementById("filterEvents").onclick = async function() {
                    const selectedCategory = document.getElementById("categorySelect").value;
                    const url = selectedCategory ? "http://localhost:8000/api/v1/events/category/" + selectedCategory : "http://localhost:8000/api/v1/events";
                    
                    const response = await fetch(url);
                    const events = await response.json();
                    const eventGrid = document.getElementById("eventGrid");
                    const eventMessage = document.getElementById("eventMessage");
                    
                    eventGrid.innerHTML = "";
                    eventMessage.innerHTML = "";

                    if (events.length === 0) {
                        eventMessage.textContent = "No events found for the selected category.";
                        eventMessage.classList.add("event-message--error");
                        return;
                    }

                    events.forEach(event => {
                        eventGrid.innerHTML += `
                            <div class="event-card">
                                <h3 class="event-card__title">${event.title}</h3>
                                <p class="event-card__description">${event.description}</p>
                                <p class="event-card__date"><strong>Date:</strong> ${event.date} at ${event.time}</p>
                                <p class="event-card__location"><strong>Location:</strong> ${event.location}</p>
                                <p class="event-card__category"><strong>Category:</strong> ${event.category}</p>
                            </div>
                        `;
                    });
                };
            </script>';

    return $output;
}

// Register the shortcode
add_shortcode('event_list', 'event_list_shortcode');
