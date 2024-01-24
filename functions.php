<?php


$ecstore = array(
    'main' => require 'inc/class-ecstore.php'
);

if (!defined("OCEANWP_INC_DIR_URI")) {
    define("OCEANWP_INC_DIR_URI", untrailingslashit(get_template_directory()));
}

/**
 * Display top bar
 *
 * @since 1.1.2
 */
if (!function_exists('oceanwp_display_topbar')) {

    function oceanwp_display_topbar()
    {

        // Return true by default
        $return = true;

        // Return false if disabled via Customizer
        if (true != get_theme_mod('ocean_top_bar', true)) {
            $return = false;
        }

        return $return;

        // Apply filters and return
        // return apply_filters('ocean_display_top_bar', $return);

    }
}


/**
 * Top bar template
 * I make a function to be able to remove it for the Beaver Themer plugin
 *
 * @since 1.2.5
 */
if (!function_exists('oceanwp_top_bar_template')) {

    function oceanwp_top_bar_template()
    {

        // Return if no top bar
        if (!oceanwp_display_topbar()) {
            return;
        }

        get_template_part('partials/topbar/layout');

    }

    add_action('ocean_top_bar', 'oceanwp_top_bar_template');
}

require_once 'inc/customizer/library/customizer-custom-controls/functions.php';

require_once 'inc/customizer/class-ecstore-customizer.php';
