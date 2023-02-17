<?php

/*
    Plugin Name: Multiple Choice Quize
    Description: Give your readers a multiple choice question.
    Version: 1.0
    Author: Jayanta
    Author URI: http://jayanta.me
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Blueprint or Class
class MultipleChoiceQuize {

    function __construct() {
        add_action('init', [$this, 'adminAssets']);
    }

    function adminAssets() {
        wp_register_style('quizeditcss', plugin_dir_url(__FILE__) . 'build/index.css');
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', ['wp-blocks', 'wp-element', 'wp-editor']);

        register_block_type('ourplugin/are-you-paying-attention', [
            'editor_script' => 'ournewblocktype',
            'editor_style' => 'quizeditcss',
            'render_callback' => [$this, 'theHTML']
        ]);
    }

    function theHTML($attributes) {
        if(!is_admin()) {
            wp_enqueue_script("attentionFrontend", plugin_dir_url(__FILE__) . 'build/frontend.js', ['wp-element']);
            wp_enqueue_style("attentionFrontendStyle", plugin_dir_url(__FILE__) . 'build/frontend.css');
        }

        ob_start(); ?>
        <div class="paying-attention-update-me">
            <pre><?php echo wp_json_encode($attributes); ?></pre>
        </div>
        <?php return ob_get_clean();
    }

}

// Object
$multipleChoiceQuize = new MultipleChoiceQuize();