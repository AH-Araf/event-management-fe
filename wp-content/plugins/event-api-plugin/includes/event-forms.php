<?php

// Function to handle the event creation form
function event_creation_form() {
    ob_start();
    ?>
    <h2 class="text-2xl font-bold mb-4">Create New Event</h2>
    <form id="createEventForm" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
        <div>
            <label for="title" class="block font-medium">Title:</label>
            <input type="text" id="title" name="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="description" class="block font-medium">Description:</label>
            <textarea id="description" name="description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>

        <div>
            <label for="date" class="block font-medium">Date:</label>
            <input type="date" id="date" name="date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="time" class="block font-medium">Time:</label>
            <input type="time" id="time" name="time" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="location" class="block font-medium">Location:</label>
            <input type="text" id="location" name="location" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="category" class="block font-medium">Category:</label>
            <select id="category" name="category" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="Conferences">Conferences</option>
                <option value="Workshops">Workshops</option>
                <option value="Seminars">Seminars</option>
                <option value="Webinars">Webinars</option>
                <option value="Festivals">Festivals</option>
                <option value="ProductLaunches">Product Launches</option>
                <option value="CorporateMeetings">Corporate Meetings</option>
                <option value="TradeShows">Trade Shows</option>
                <option value="Fundraisers">Fundraisers</option>
                <option value="NetworkingEvents">Networking Events</option>
                <option value="Music">Music</option>
                <option value="Dance">Dance</option>
                <option value="Art">Art</option>
                <option value="Technology">Technology</option>
                <option value="Health&Wellness">Health & Wellness</option>
            </select>
        </div>

        <button type="submit" class="mt-4 w-full bg-indigo-600 text-white font-bold py-2 rounded-md hover:bg-indigo-700">Create Event</button>
    </form>
    <div id="eventCreationMessage" class="mt-4"></div>

    <script>
        document.getElementById('createEventForm').onsubmit = async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const response = await fetch('http://localhost:8000/api/v1/events', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            const data = await response.json();
            const messageDiv = document.getElementById('eventCreationMessage');
            if (response.ok) {
                messageDiv.textContent = 'Event created successfully!';
                messageDiv.classList.add('text-green-500');
                document.getElementById('createEventForm').reset();
            } else {
                messageDiv.textContent = 'Error: ' + data.message;
                messageDiv.classList.add('text-red-500');
            }
        }
    </script>
    <?php
    return ob_get_clean();
}

// Function to handle the event update form
function event_update_form($event) {
    ob_start();
    ?>
    <h2 class="text-2xl font-bold mb-4">Update Event</h2>
    <form id="updateEventForm" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
        <input type="hidden" id="update_event_id" value="<?php echo esc_attr($event->id); ?>">
        
        <div>
            <label for="update_title" class="block font-medium">Title:</label>
            <input type="text" id="update_title" name="title" value="<?php echo esc_attr($event->title); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="update_description" class="block font-medium">Description:</label>
            <textarea id="update_description" name="description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"><?php echo esc_attr($event->description); ?></textarea>
        </div>

        <div>
            <label for="update_date" class="block font-medium">Date:</label>
            <input type="date" id="update_date" name="date" value="<?php echo esc_attr($event->date); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="update_time" class="block font-medium">Time:</label>
            <input type="time" id="update_time" name="time" value="<?php echo esc_attr($event->time); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="update_location" class="block font-medium">Location:</label>
            <input type="text" id="update_location" name="location" value="<?php echo esc_attr($event->location); ?>" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="update_category" class="block font-medium">Category:</label>
            <select id="update_category" name="category" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="Conferences" <?php selected($event->category, 'Conferences'); ?>>Conferences</option>
                <option value="Workshops" <?php selected($event->category, 'Workshops'); ?>>Workshops</option>
                <option value="Seminars" <?php selected($event->category, 'Seminars'); ?>>Seminars</option>
                <option value="Webinars" <?php selected($event->category, 'Webinars'); ?>>Webinars</option>
                <option value="Festivals" <?php selected($event->category, 'Festivals'); ?>>Festivals</option>
                <option value="ProductLaunches" <?php selected($event->category, 'ProductLaunches'); ?>>Product Launches</option>
                <option value="CorporateMeetings" <?php selected($event->category, 'CorporateMeetings'); ?>>Corporate Meetings</option>
                <option value="TradeShows" <?php selected($event->category, 'TradeShows'); ?>>Trade Shows</option>
                <option value="Fundraisers" <?php selected($event->category, 'Fundraisers'); ?>>Fundraisers</option>
                <option value="NetworkingEvents" <?php selected($event->category, 'NetworkingEvents'); ?>>Networking Events</option>
                <option value="Music" <?php selected($event->category, 'Music'); ?>>Music</option>
                <option value="Dance" <?php selected($event->category, 'Dance'); ?>>Dance</option>
                <option value="Art" <?php selected($event->category, 'Art'); ?>>Art</option>
                <option value="Technology" <?php selected($event->category, 'Technology'); ?>>Technology</option>
                <option value="Health&Wellness" <?php selected($event->category, 'Health&Wellness'); ?>>Health & Wellness</option>
            </select>
        </div>

        <button type="submit" class="mt-4 w-full bg-indigo-600 text-white font-bold py-2 rounded-md hover:bg-indigo-700">Update Event</button>
    </form>
    <div id="eventUpdateMessage" class="mt-4"></div>

    <script>
        document.getElementById('updateEventForm').onsubmit = async function(e) {
            e.preventDefault();
            const eventId = document.getElementById('update_event_id').value;
            const formData = new FormData(this);
            const response = await fetch('http://localhost:8000/api/v1/events/' + eventId, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            const data = await response.json();
            const messageDiv = document.getElementById('eventUpdateMessage');
            if (response.ok) {
                messageDiv.textContent = 'Event updated successfully!';
                messageDiv.classList.add('text-green-500');
            } else {
                messageDiv.textContent = 'Error: ' + data.message;
                messageDiv.classList.add('text-red-500');
            }
        }
    </script>
    <?php
    return ob_get_clean();
}

// Shortcode to display the creation and update forms
function event_management_shortcode() {
    $output = event_creation_form();
    
    // You may want to add an event selection dropdown to update an event
    // For now, we can just show the creation form
    return $output;
}

// Register the shortcode for event management
add_shortcode('event_management', 'event_management_shortcode');