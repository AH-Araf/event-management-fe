<?php

// Shortcode for User Login
function user_login_shortcode() {
    ob_start();
    ?>
    <div class="login-form">
        <h2 class="login-form__title">User Login</h2>
        <input type="email" id="login_email" class="login-form__input" placeholder="Email" required>
        <input type="password" id="login_password" class="login-form__input" placeholder="Password" required>
        <button id="login_btn" class="login-form__button">Login</button>
        <div id="login_message" class="login-form__message"></div>
    </div>
    <script src="<?php echo plugin_dir_url(__FILE__) . '../js/login.js'; ?>"></script>
    <?php
    return ob_get_clean();
}
add_shortcode('user_login', 'user_login_shortcode');