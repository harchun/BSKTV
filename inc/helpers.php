<?php
if (!defined('ABSPATH')) exit;

function bsktv_excerpt($length = 30) {
    $text = get_the_excerpt();
    return wp_trim_words(wp_strip_all_tags($text), $length, '…');
}
