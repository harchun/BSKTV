<?php
if (!defined('ABSPATH')) exit;

function bsktv_ajax_check_nonce() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'bsktv_frontend')) {
        wp_send_json_error(array('message' => 'Invalid request.'), 403);
    }
}

function bsktv_ajax_store_allowed($post_id) {
    return bsktv_is_active_store($post_id);
}

function bsktv_ajax_store_payload($post_id) {
    $cities = wp_get_post_terms($post_id, 'bsktv_city', array('fields' => 'names'));
    return array(
        'id' => $post_id,
        'title' => get_the_title($post_id),
        'url' => get_permalink($post_id),
        'image' => get_the_post_thumbnail_url($post_id, 'medium_large') ?: '',
        'city' => is_wp_error($cities) ? '' : implode('、', $cities),
    );
}

function bsktv_ajax_card_html($post_id) {
    if (!bsktv_ajax_store_allowed($post_id)) return '';

    global $post;
    $previous_post = $post;
    $post = get_post($post_id);
    if (!$post) {
        $post = $previous_post;
        return '';
    }

    setup_postdata($post);
    ob_start();
    get_template_part('template-parts/store-card');
    $html = ob_get_clean();
    wp_reset_postdata();
    $post = $previous_post;
    return $html;
}

function bsktv_ajax_favorites() {
    bsktv_ajax_check_nonce();
    $ids = isset($_POST['ids']) ? (array) wp_unslash($_POST['ids']) : array();
    $ids = array_values(array_unique(array_filter(array_map('absint', $ids))));
    $ids = array_slice($ids, 0, 50);

    $out = array();
    foreach ($ids as $id) {
        if (bsktv_ajax_store_allowed($id)) $out[] = bsktv_ajax_store_payload($id);
    }
    wp_send_json_success($out);
}
add_action('wp_ajax_bsktv_favorites', 'bsktv_ajax_favorites');
add_action('wp_ajax_nopriv_bsktv_favorites', 'bsktv_ajax_favorites');

function bsktv_ajax_search() {
    bsktv_ajax_check_nonce();
    $term = isset($_POST['term']) ? sanitize_text_field(wp_unslash($_POST['term'])) : '';
    $length = function_exists('mb_strlen') ? mb_strlen($term, 'UTF-8') : strlen($term);
    if ($length < 2) wp_send_json_success(array());

    $q = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 8,
        's' => $term,
        'orderby' => 'relevance',
        'no_found_rows' => true,
        'ignore_sticky_posts' => true,
        'meta_query' => bsktv_active_status_meta_query(),
    ));

    $out = array();
    foreach ($q->posts as $post_item) {
        if (bsktv_ajax_store_allowed($post_item->ID)) $out[] = bsktv_ajax_store_payload($post_item->ID);
    }
    wp_reset_postdata();
    wp_send_json_success($out);
}
add_action('wp_ajax_bsktv_search', 'bsktv_ajax_search');
add_action('wp_ajax_nopriv_bsktv_search', 'bsktv_ajax_search');

function bsktv_ajax_home_latest() {
    bsktv_ajax_check_nonce();
    $page = isset($_POST['page']) ? max(2, absint($_POST['page'])) : 2;

    $q = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'paged' => $page,
        'orderby' => 'modified',
        'order' => 'DESC',
        'ignore_sticky_posts' => true,
        'meta_query' => bsktv_active_status_meta_query(),
    ));

    $html = '';
    foreach ($q->posts as $post_item) {
        $html .= bsktv_ajax_card_html($post_item->ID);
    }
    wp_reset_postdata();

    wp_send_json_success(array(
        'html' => $html,
        'page' => $page,
        'hasMore' => $page < $q->max_num_pages,
    ));
}
add_action('wp_ajax_bsktv_home_latest', 'bsktv_ajax_home_latest');
add_action('wp_ajax_nopriv_bsktv_home_latest', 'bsktv_ajax_home_latest');

function bsktv_ajax_line_click() {
    bsktv_ajax_check_nonce();
    $id = isset($_POST['id']) ? absint($_POST['id']) : 0;
    if (!$id || !bsktv_ajax_store_allowed($id)) {
        wp_send_json_error(array('message' => 'Store not found.'), 404);
    }

    $cookie = 'bsktv_line_clicked_' . $id;
    if (isset($_COOKIE[$cookie])) wp_send_json_success(array('tracked' => false));

    $count = (int) get_post_meta($id, 'bsktv_line_clicks', true);
    $updated = update_post_meta($id, 'bsktv_line_clicks', $count + 1);
    if ($updated === false && get_post_meta($id, 'bsktv_line_clicks', true) !== (string) ($count + 1)) {
        wp_send_json_error(array('message' => 'Could not record click.'), 500);
    }

    $expires = time() + 1800;
    $path = defined('COOKIEPATH') && COOKIEPATH ? COOKIEPATH : '/';
    setcookie($cookie, '1', array(
        'expires' => $expires,
        'path' => $path,
        'secure' => is_ssl(),
        'httponly' => true,
        'samesite' => 'Lax',
    ));
    $_COOKIE[$cookie] = '1';

    wp_send_json_success(array('tracked' => true));
}
add_action('wp_ajax_bsktv_line_click', 'bsktv_ajax_line_click');
add_action('wp_ajax_nopriv_bsktv_line_click', 'bsktv_ajax_line_click');
