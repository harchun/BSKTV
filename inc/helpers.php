<?php
if (!defined('ABSPATH')) exit;

function bsktv_excerpt($length = 30) {
    $text = get_the_excerpt();
    return wp_trim_words(wp_strip_all_tags($text), $length, '…');
}

function bsktv_active_status_meta_query() {
    return array(
        'relation' => 'OR',
        array('key' => 'bsktv_status', 'compare' => 'NOT EXISTS'),
        array('key' => 'bsktv_status', 'value' => 'active', 'compare' => '='),
    );
}

function bsktv_is_active_store($post_id = 0) {
    $post_id = $post_id ? absint($post_id) : get_the_ID();
    if (!$post_id || get_post_type($post_id) !== 'post' || get_post_status($post_id) !== 'publish') {
        return false;
    }
    $status = get_post_meta($post_id, 'bsktv_status', true);
    return $status === '' || $status === 'active';
}

function bsktv_active_store_count() {
    $cached = wp_cache_get('bsktv_active_store_count', 'bsktv');
    if ($cached !== false) return (int) $cached;

    $q = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'no_found_rows' => false,
        'ignore_sticky_posts' => true,
        'meta_query' => bsktv_active_status_meta_query(),
    ));
    $count = (int) $q->found_posts;
    wp_reset_postdata();
    wp_cache_set('bsktv_active_store_count', $count, 'bsktv', 300);
    return $count;
}

function bsktv_clear_runtime_cache() {
    wp_cache_delete('bsktv_active_store_count', 'bsktv');
}
add_action('save_post_post', 'bsktv_clear_runtime_cache', 99);
add_action('before_delete_post', 'bsktv_clear_runtime_cache', 99);
