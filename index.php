<?php

/*
    Plugin Name: Are You Paying Attention Quize
    Description: Give your readers a multiple choice question.
    Version: 1.0
    Author: Jayanta
    Author URI: http://jayanta.me
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Blueprint or Class
class AreYouPayingAttention {

    function __construct() {
        // add_action('enqueue_block_editor_assets', [$this, 'adminAssets']);
        add_action('init', [$this, 'adminAssets']);
    }

    function adminAssets() {
        // wp_enqueue_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', ['wp-blocks', 'wp-element']);
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', ['wp-blocks', 'wp-element']);
        register_block_type('ourplugin/are-you-paying-attention', [
            'editor_script' => 'ournewblocktype',
            'render_callback' => [$this, 'theHTML']
        ]);
    }

    function theHTML($attributes, $content) {
        ob_start(); ?>
        <h3>Today the sky is <?php echo esc_html($attributes['skyColor']); ?> and the grass is <?php echo esc_html($attributes['grassColor']); ?> !!!</h3>
        <?php return ob_get_clean();
    }

}

// Object
$areYouPayingAttention = new AreYouPayingAttention();