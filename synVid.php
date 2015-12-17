<?php
/*
Plugin Name: synVid Responsive Video Shortcode
Plugin URI: http://synergexis.com
Description: This plugin provides a shortcode you wrap around the ID of a video in youtube or Vimeo. The plugin then adds the necessary markup and CSS to make that video responsive. To use it, type [synVid vid="{video id}" (modestbranding="{0/1}" rel="{0/1}" showinfo="{0/1}") ]
Version: 1.0
Author: Jason Foster and Shane Phillips
Author URI: http://synergexis.com
License: Reserved
*/
function synVid_youtube_shortcode($atts)
{
    extract(shortcode_atts(array(
        'vid' => '',
        'modestbranding' => '1',
        'rel' => '0',
        'showinfo' => '0',
        'controls' => '0'
    ), $atts));
    
    foreach ($atts as $key => $key_value) {
        if ($key != 'vid') {
            $encoded_query[] = urlencode($key) . '=' . urlencode($key_value);
        }
    }
    
    $formatted_query = implode('&', $encoded_query);
    
    return '<div class="synVid_container synVid_youtube_container"><iframe src="//www.youtube.com/embed/' . $vid . '?modestbranding=' . $modestbranding . '&rel=' . $rel . '&showinfo=' . $showinfo . '&controls=' . $controls . '&' . $formatted_query . '" allowfullscreen="" frameborder="0"></iframe></div>
    <!--.synVid-youtube-container-->';
}
add_shortcode('synVid-youtube', 'synVid_youtube_shortcode');

function synVid_vimeo_shortcode($atts)
{
    extract(shortcode_atts(array(
        'vid' => '',
        'badge' => '0',
        'portrait' => '0',
        'title' => '0'
    ), $atts));
    
    foreach ($atts as $key => $key_value) {
        if ($key != 'vid') {
            $encoded_query[] = urlencode($key) . '=' . urlencode($key_value);
        }
    }
    
    $formatted_query = implode('&', $encoded_query);
    
    return '<div class="synVid_container synVid_vimeo_container"><iframe src="//player.vimeo.com/video/' . $vid . '?badge=' . $badge . '&portrait=' . $portrait . '&title=' . $title . '&' . $expanded_query . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
    <!--.synVid-vimeo-container-->';
    
}
add_shortcode('synVid-vimeo', 'synVid_vimeo_shortcode');

function synVid_add_stylesheet()
{
    wp_register_style('synVid_style', plugins_url('synVid.css', __FILE__));
    wp_enqueue_style('synVid_style');
}
add_action('wp_enqueue_scripts', 'synVid_add_stylesheet');
?>
