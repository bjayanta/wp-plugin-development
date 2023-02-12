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
        $mainPageHook = add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage'], 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iY3VycmVudENvbG9yIiBjbGFzcz0iYmkgYmktZnVubmVsIiB2aWV3Qm94PSIwIDAgMTYgMTYiPgogIDxwYXRoIGQ9Ik0xLjUgMS41QS41LjUgMCAwIDEgMiAxaDEyYS41LjUgMCAwIDEgLjUuNXYyYS41LjUgMCAwIDEtLjEyOC4zMzRMMTAgOC42OTJWMTMuNWEuNS41IDAgMCAxLS4zNDIuNDc0bC0zIDFBLjUuNSAwIDAgMSA2IDE0LjVWOC42OTJMMS42MjggMy44MzRBLjUuNSAwIDAgMSAxLjUgMy41di0yem0xIC41djEuMzA4bDQuMzcyIDQuODU4QS41LjUgMCAwIDEgNyA4LjV2NS4zMDZsMi0uNjY2VjguNWEuNS41IDAgMCAxIC4xMjgtLjMzNEwxMy41IDMuMzA4VjJoLTExeiIvPgo8L3N2Zz4=', 100);
        // Create submenu page
        add_submenu_page('ourwordfilter', 'Word To Filter', 'Words List', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage']);
        add_submenu_page('ourwordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', [$this, 'optionsSubPage']);
        add_action("load-{$mainPageHook}", [$this, 'mainPageAssets']);
    }

    function mainPageAssets() {
        wp_enqueue_style('filterAdminCSS', plugin_dir_url(__FILE__) . 'styles.css');
    }

    function handleForm() {
        // check valid nonce and user permission
        if(wp_verify_nonce($_POST['ourNonce'], 'saveFilterWors') && current_user_can('manage_options')) {
            // Update 'wp_options' table
            update_option('plugin_words_to_filter', sanitize_text_field($_POST['plugin_words_to_filter'])); ?>

            <div class="updated">
                <p>Your filtered words were saved.</p>
            </div>
        <?php } else { ?>
            <!-- Error -->
            <div class="error">
                <p>Sorry, you do not have permission to perform that action.</p>
            </div>
        <?php }
    }

    function wordFilterPage() { ?>
        <div class="wrap">
            <h1>Word Filter</h1>

            <?php if(isset($_POST['justsubmitted']) && $_POST['justsubmitted'] == 'true') echo $this->handleForm(); ?>

            <form method="post">
                <!-- Cross-site request forgery -->
                <?php wp_nonce_field('saveFilterWors', 'ourNonce'); ?>

                <input type="hidden" name="justsubmitted" value="true">

                <label for="plugin_words_to_filter">Enter a <strong>comma(,) seperated</strong> list of words to filter from your site's content.</label>
                <div class="word-filter__flex-container">
                    <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible"><?php echo esc_textarea(get_option('plugin_words_to_filter')); ?></textarea>
                </div>

                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            </form>
        </div>
    <?php }

    function optionsSubPage() { ?>
        Hello world from the option page.
    <?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();