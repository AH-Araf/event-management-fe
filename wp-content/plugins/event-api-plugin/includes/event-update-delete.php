
<?php

function get_event_by_id($event_id) {
    $url = 'http://localhost:8000/api/v1/events/' . $event_id;
    $response = wp_remote_get($url);

    if (is_wp_error($response)) {
        return null;
    }

    $body = wp_remote_retrieve_body($response);
    return json_decode($body);
}

function event_update_delete_shortcode() {
    ob_start();
    ?>
    <h2 class="text-2xl font-bold mb-4">Update or Delete Event</h2>
    <form id="eventSelectForm" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
        <div>
            <label for="event_id" class="block font-medium">Select Event to Update/Delete:</label>
            <select id="event_id" name="event_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">-- Select Event --</option>
                <?php
                $events = get_events_from_api();
                foreach ($events as $event) {
                    echo '<option value="' . esc_attr($event->id) . '">' . esc_html($event->title) . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="button" id="loadEvent" class="mt-4 w-full bg-indigo-600 text-white font-bold py-2 rounded-md hover:bg-indigo-700">Load Event</button>
    </form>

    <div id="eventFormContainer" class="mt-6"></div>

    <script>
        document.getElementById('loadEvent').onclick = async function() {
            const eventId = document.getElementById('event_id').value;
            if (!eventId) return;

            const response = await fetch('http://localhost:8000/api/v1/events/' + eventId);
            const event = await response.json();

            const formContainer = document.getElementById('eventFormContainer');
            formContainer.innerHTML = '';

            if (response.ok) {
                const formHtml = `
                    <h2 class="text-2xl font-bold mb-4">Update Event</h2>
                    <form id="updateEventForm" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
                        <input type="hidden" id="update_event_id" value="${event.id}">
                        <div>
                            <label for="update_title" class="block font-medium">Title:</label>
                            <input type="text" id="update_title" name="title" value="${event.title}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="update_description" class="block font-medium">Description:</label>
                            <textarea id="update_description" name="description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">${event.description}</textarea>
                        </div>
                        <div>
                            <label for="update_date" class="block font-medium">Date:</label>
                            <input type="date" id="update_date" name="date" value="${event.date}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <!-- Removed the Time Field -->
                        <div>
                            <label for="update_location" class="block font-medium">Location:</label>
                            <input type="text" id="update_location" name="location" value="${event.location}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="update_category" class="block font-medium">Category:</label>
                            <select id="update_category" name="category" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="Conferences" ${event.category === 'Conferences' ? 'selected' : ''}>Conferences</option>
                                <option value="Workshops" ${event.category === 'Workshops' ? 'selected' : ''}>Workshops</option>
                                <option value="Seminars" ${event.category === 'Seminars' ? 'selected' : ''}>Seminars</option>
                                <option value="Webinars" ${event.category === 'Webinars' ? 'selected' : ''}>Webinars</option>
                                <option value="Festivals" ${event.category === 'Festivals' ? 'selected' : ''}>Festivals</option>
                                <option value="ProductLaunches" ${event.category === 'ProductLaunches' ? 'selected' : ''}>Product Launches</option>
                                <option value="CorporateMeetings" ${event.category === 'CorporateMeetings' ? 'selected' : ''}>Corporate Meetings</option>
                                <option value="TradeShows" ${event.category === 'TradeShows' ? 'selected' : ''}>Trade Shows</option>
                                <option value="Fundraisers" ${event.category === 'Fundraisers' ? 'selected' : ''}>Fundraisers</option>
                                <option value="NetworkingEvents" ${event.category === 'NetworkingEvents' ? 'selected' : ''}>Networking Events</option>
                                <option value="Music" ${event.category === 'Music' ? 'selected' : ''}>Music</option>
                                <option value="Dance" ${event.category === 'Dance' ? 'selected' : ''}>Dance</option>
                                <option value="Art" ${event.category === 'Art' ? 'selected' : ''}>Art</option>
                                <option value="Technology" ${event.category === 'Technology' ? 'selected' : ''}>Technology</option>
                                <option value="Health&Wellness" ${event.category === 'Health&Wellness' ? 'selected' : ''}>Health & Wellness</option>
                            </select>
                        </div>
                        <button type="submit" class="mt-4 w-full bg-indigo-600 text-white font-bold py-2 rounded-md hover:bg-indigo-700">Update Event</button>
                    </form>
                    <div id="eventUpdateMessage" class="mt-4"></div>
                    <button id="deleteEvent" class="mt-4 w-full bg-red-600 text-white font-bold py-2 rounded-md hover:bg-red-700">Delete Event</button>
                `;
                formContainer.innerHTML = formHtml;

                document.getElementById('updateEventForm').onsubmit = async function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    // Exclude the time field from the form data if it exists
                    const dataToSend = Object.fromEntries(formData);
                    delete dataToSend.time; // Ensure the time field is removed

                    const response = await fetch('http://localhost:8000/api/v1/events/' + eventId, {
                        method: 'PUT',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(dataToSend) // Send updated data
                    });
                    const messageDiv = document.getElementById('eventUpdateMessage');
                    if (response.ok) {
                        messageDiv.textContent = 'Event updated successfully!';
                        messageDiv.classList.add('text-green-500');
                    } else {
                        const data = await response.json();
                        messageDiv.textContent = 'Error: ' + data.message;
                        messageDiv.classList.add('text-red-500');
                    }
                };

                document.getElementById('deleteEvent').onclick = async function() {
                    const confirmDelete = confirm('Are you sure you want to delete this event?');
                    if (!confirmDelete) return;

                    const response = await fetch('http://localhost:8000/api/v1/events/' + eventId, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        }
                    });
                    if (response.ok) {
                        alert('Event deleted successfully!');
                        formContainer.innerHTML = '';
                    } else {
                        const data = await response.json();
                        alert('Error: ' + data.message);
                    }
                };
            } else {
                formContainer.innerHTML = '<p class="text-red-500">Error loading event.</p>';
            }
        }
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('event_update_delete', 'event_update_delete_shortcode');
