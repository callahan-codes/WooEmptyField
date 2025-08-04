<?php
/**
 * Plugin Name: WooEmptyField
 * Description: Adds an empty field in your order email recipet for manual notes.
 * Version: 1.0
 * Author: Bryce Callahan
 */

// prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// override WooCommerce email-order-items.php only for admin-type emails
function woo_emptyfield_override_email_template($template, $template_name, $template_path) {

    if ($template_name === 'emails/email-order-items.php') {
        if (isset($GLOBALS['email']) && is_object($GLOBALS['email'])) {
            $email_id = $GLOBALS['email']->id;

            // apply override only for new_order, cancelled_order, and failed_order
            $allowed_ids = ['new_order', 'cancelled_order', 'failed_order'];

            if (in_array($email_id, $allowed_ids, true)) {
                $plugin_template = plugin_dir_path(__FILE__) . 'emails/email-order-items.php';
                if (file_exists($plugin_template)) {
                    return $plugin_template;
                }
            }
        }
    }

    return $template;
}
add_filter('woocommerce_locate_template', 'woo_emptyfield_override_email_template', 10, 3);
