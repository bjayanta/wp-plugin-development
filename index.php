<?php

/*
    Plugin Name: Are You Paying Attention Quize
    Description: Give your readers a multiple choice question.
    Version: 1.0
    Author: Jayanta
    Author URI: http://jayanta.me
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AreYouPayingAttention {

    function __construct() {
        add_action('enqueue_block_editor_assets', [$this, 'adminAssets']);
    }

    function adminAssets() {
        wp_enqueue_script('outnewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', ['wp-blocks', 'wp-element']);
    }

}

$areYouPayingAttention = new AreYouPayingAttention();