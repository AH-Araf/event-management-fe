<?php
// Hello World Shortcode File

// Function to display "Hello, World!"
function hello_world_shortcode() {
    return "Hello, World!";
}

// Register the shortcode
add_shortcode('hello_world', 'hello_world_shortcode');
