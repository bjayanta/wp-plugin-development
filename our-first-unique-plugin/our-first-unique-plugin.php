<?php

/*
    Plugin Name: Our Test Plugin
    Description: A truly amazing plugin.
    Version: 1.0
    Author: Jayanta
    Author URI: http://jayanta.me
*/

// Plugin 1:
add_filter('the_content', 'addToEndOfPost');

function addToEndOfPost($content) {
    if(is_single() && is_main_query()) {
        return $content . "<p>Hello World!</p>";
    }

    return $content;    
}