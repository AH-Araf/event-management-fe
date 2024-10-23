<?php

// Shortcode for User Registration
function user_registration_shortcode() {
    ob_start();
    ?>
    <div class="registration-form">
        <h2 class="registration-form__title">User Registration</h2>
        <input type="email" id="reg_email" class="registration-form__input" placeholder="Email" required>
        <input type="password" id="reg_password" class="registration-form__input" placeholder="Password" required>
        <button id="register_btn" class="registration-form__button">Register</button>
        <div id="reg_message" class="registration-form__message"></div>
    </div>
    <script src="<?php echo plugin_dir_url(__FILE__) . '../js/registration.js'; ?>"></script>
    <?php
    return ob_get_clean();
}
add_shortcode('user_registration', 'user_registration_shortcode');