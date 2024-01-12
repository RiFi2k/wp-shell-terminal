<?php
/**
 * Plugin Name: WP Shell Terminal
 * Description: A WordPress plugin to execute shell commands in a secure terminal interface.
 * Version: 1.0
 * Requires at least: 6.0.0
 * Author: Reilly Lowery
 * Author URI: https://github.com/RiFi2k/wp-shell-terminal
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action('admin_menu', 'wpst_add_admin_menu');
function wpst_add_admin_menu() {
    add_submenu_page(
        'tools.php',           // Parent slug
        'WP Shell Terminal',   // Page title
        'Shell Terminal',      // Menu title
        'manage_options',      // Capability
        'wp-shell-terminal',   // Menu slug
        'wpst_admin_page'      // Function to display the page
    );
}


function wpst_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div id="wpst-terminal">
            <textarea id="wpst-output" readonly></textarea>
            <input type="text" id="wpst-command-input" placeholder="Enter command">
            <button id="wpst-execute">Run</button>
        </div>
    </div>
    <script>
    document.getElementById('wpst-execute').addEventListener('click', function() {
        var command = document.getElementById('wpst-command-input').value;
        jQuery.post(wpstAjax.ajax_url, {
            'action': 'wpst_execute_command',
            'command': command
        }, function(response) {
            var outputArea = document.getElementById('wpst-output');
            outputArea.value += "\n$ " + command + "\n" + response;
            outputArea.scrollTop = outputArea.scrollHeight;
        });
    });
    </script>
    <style>
        #wpst-terminal { background-color: black; color: white; padding: 10px; }
        #wpst-output { width: 100%; height: 300px; margin-bottom: 10px; }
    </style>
    <?php
}

add_action('admin_enqueue_scripts', 'wpst_enqueue_scripts');
function wpst_enqueue_scripts() {
    wp_enqueue_script('wpst-ajax-script', admin_url('admin-ajax.php'), array('jquery'));
    wp_localize_script('wpst-ajax-script', 'wpstAjax', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_ajax_wpst_execute_command', 'wpst_execute_command');
function wpst_execute_command() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }

    $command = sanitize_text_field($_POST['command']);
    // Execute command and return output
    $output = shell_exec($command);
    echo esc_html($output);
    wp_die(); // this is required to terminate immediately and return a proper response
}
