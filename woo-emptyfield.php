<?php
/**
 * Plugin Name: WooEmptyField
 * Description: Adds an empty field in your order email recipet for manual notes.
 * Version: 1.1
 * Author: Bryce Callahan
 */

// prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// force WooCommerce to load the custom php from /emails
function woo_emptyfield_override_email_template($template, $template_name, $template_path) {
    if ($template_name === 'emails/email-order-items.php') {
        $plugin_template = plugin_dir_path(__FILE__) . 'emails/email-order-items.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    return $template;
}
add_filter('woocommerce_locate_template', 'woo_emptyfield_override_email_template', 10, 3);
