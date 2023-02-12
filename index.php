<?php

/*
    Plugin name: Our Word Filter Plugin
    Description: Repace a list of words.
    version: 1.0
    Author: Jayanta Biswas
    Author URI: http://jayanta.me
*/

if(! defined('ABSPATH')) exit; // Exit if accessed directly

class OurWordFilterPlugin {
    function __construct() {
        add_action('admin_menu', [$this, 'ourMenu']);
    }

    function ourMenu() {
        // Create main menu
        // add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage'], 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iY3VycmVudENvbG9yIiBjbGFzcz0iYmkgYmktZnVubmVsIiB2aWV3Qm94PSIwIDAgMTYgMTYiPgogIDxwYXRoIGQ9Ik0xLjUgMS41QS41LjUgMCAwIDEgMiAxaDEyYS41LjUgMCAwIDEgLjUuNXYyYS41LjUgMCAwIDEtLjEyOC4zMzRMMTAgOC42OTJWMTMuNWEuNS41IDAgMCAxLS4zNDIuNDc0bC0zIDFBLjUuNSAwIDAgMSA2IDE0LjVWOC42OTJMMS42MjggMy44MzRBLjUuNSAwIDAgMSAxLjUgMy41di0yem0xIC41djEuMzA4bDQuMzcyIDQuODU4QS41LjUgMCAwIDEgNyA4LjV2NS4zMDZsMi0uNjY2VjguNWEuNS41IDAgMCAxIC4xMjgtLjMzNEwxMy41IDMuMzA4VjJoLTExeiIvPgo8L3N2Zz4=', 100);
        add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage'], plugin_dir_url(__FILE__) . 'filter.svg', 100);
        // Create submenu page
        add_submenu_page('ourwordfilter', 'Word To Filter', 'Words List', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage']);
        add_submenu_page('ourwordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', [$this, 'optionsSubPage']);
    }

    function wordFilterPage() { ?>
        Hello world.
    <?php }

    function optionsSubPage() { ?>
        Hello world from the option page.
    <?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();