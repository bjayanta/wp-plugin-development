<?php

/*
    Plugin Name: Our Test Plugin
    Description: A truly amazing plugin.
    Version: 1.0
    Author: Jayanta
    Author URI: http://jayanta.me
*/

// Plugin 2:
class WordCountAndTimePlugin {
    function __construct() {
        add_action('admin_menu', [$this, 'adminPage']);
        add_action('admin_init', [$this, 'settings']);
        add_filter('the_content', [$this, 'ifWrap']);
        add_action('init', [$this, 'languages']);
    }

    function languages() {
        load_plugin_textdomain('wcpdomain', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    function ifWrap($content) {
        if(is_main_query() && is_single() && (get_option('wcp_wordcount', '1') || get_option('wcp_charactercount', '1') || get_option('wcp_readtime', '1'))) {
            return $this->createHTML($content);
        }

        return $content;
    }

    function createHTML($content) { 
        $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>'; 

        // get word count once because both wordcount and read time will neet it.
        if(get_option('wcp_wordcount', '1') || get_option('wcp_readtime', '1')) {
            $wordCount = str_word_count(strip_tags($content));
        }

        if(get_option('wcp_wordcount', '1')) {
            $html .= esc_html__('This post has', 'wcpdomain') . ' ' . $wordCount . ' ' . __('words', 'wcpdomain') . '.<br/>';
        }

        if(get_option('wcp_charactercount', '1')) {
            $html .= __('This post has', 'wcpdomain') . ' ' . strlen(strip_tags($content)) . ' ' . __('characters', 'wcpdomain') . '.<br/>';
        }

        if(get_option('wcp_readtime', '1')) {
            $html .= __('This post will take about', 'wcpdomain') . ' ' . round($wordCount/225) . ' minute(s) to read.<br/>';
        }

        $html .= '</p>';

        if(get_option('wcp_location', '0') == '0') {
            return $html . $content;
        }

        return $content . $html;
    }

    function settings() {
        add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');

        // Location
        add_settings_field('wcp_location', 'Display Location', [$this, 'locationHTML'], 'word-count-settings-page', 'wcp_first_section');
        register_setting('WordCountPlugin', 'wcp_location', ['sanitize_callback' => [$this, 'sanitizeLocation'], 'default' => '0']);

        // Headline
        add_settings_field('wcp_headline', 'Headline Test', [$this, 'headlineHTML'], 'word-count-settings-page', 'wcp_first_section');
        register_setting('WordCountPlugin', 'wcp_headline', ['sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics']);

        // Word Count
        add_settings_field('wcp_wordcount', 'Word Count', [$this, 'checkboxHTML'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_wordcount']);
        register_setting('WordCountPlugin', 'wcp_wordcount', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);

        // Character count
        add_settings_field('wcp_charactercount', 'Character Count', [$this, 'checkboxHTML'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_charactercount']);
        register_setting('WordCountPlugin', 'wcp_charactercount', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);

        // Read time
        add_settings_field('wcp_readtime', 'Read Time', [$this, 'checkboxHTML'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_readtime']);
        register_setting('WordCountPlugin', 'wcp_readtime', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);
    }

    function sanitizeLocation($input) {
        if($input != '0' && $input != '1') {
            add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end.');
            return get_option('wcp_location');
        }

        return $input;
    }

    function locationHTML() { ?>
        <select name="wcp_location">
            <option value="0" <?php selected(get_option('wcp_location'), '0'); ?>>Beginning of post</option>
            <option value="1" <?php selected(get_option('wcp_location'), '1'); ?>>End of post</option>
        </select>
    <?php }

    function headlineHTML() { ?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')); ?>">
    <?php }

    /*
    function wordcountHTML() { ?>
        <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1')?>>
    <?php }

    function charactercountHTML() { ?>
        <input type="checkbox" name="wcp_charactercount" value="1" <?php checked(get_option('wcp_charactercount'), '1')?>>
    <?php }

    function readtimeHTML() { ?>
        <input type="checkbox" name="wcp_readtime" value="1" <?php checked(get_option('wcp_readtime'), '1')?>>
    <?php }
    */

    // reusable checkbox function
    function checkboxHTML($args) { ?>
        <input type="checkbox" name="<?php echo $args['theName']; ?>" value="1" <?php checked(get_option($args['theName']), '1'); ?>>
    <?php }

    function adminPage() {
        add_options_page('Word Count Settings', __('Word Count', 'wcpdomain'), 'manage_options', 'word-count-settings-page', [$this, 'ourHTML']);
    }

    function ourHTML() { ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="post">
                <?php
                    settings_fields('WordCountPlugin');
                    do_settings_sections('word-count-settings-page');
                    submit_button();
                ?>
            </form>
        </div>
    <?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();