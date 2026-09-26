<?php
if (!defined('ABSPATH')) exit;

require_once get_template_directory().'/inc/setup.php';
require_once get_template_directory().'/inc/taxonomies.php';
require_once get_template_directory().'/inc/metadata.php';
require_once get_template_directory().'/inc/helpers.php';
require_once get_template_directory().'/inc/features.php';
require_once get_template_directory().'/inc/seo.php';
require_once get_template_directory().'/inc/store-admin.php';
require_once get_template_directory().'/inc/gallery.php';
require_once get_template_directory().'/inc/admin-columns.php';
require_once get_template_directory().'/inc/ajax.php';

function bsktv_assets() {
    $theme = wp_get_theme();
    $v = $theme->get('Version');
    wp_enqueue_style('bsktv-style', get_stylesheet_uri(), array(), $v);
    wp_enqueue_script('bsktv-js', get_template_directory_uri().'/assets/js/bsktv.js', array(), $v, true);
    wp_localize_script('bsktv-js', 'BSKTV', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('bsktv_frontend'),
        'homeUrl' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'bsktv_assets');

function bsktv_widgets() {
    register_sidebar(array(
        'name' => '側邊欄',
        'id' => 'sidebar-1',
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'bsktv_widgets');

function bsktv_front_store_query($q) {
    $q->set('post_type', 'post');
    $q->set('post_status', 'publish');

    $existing = $q->get('meta_query');
    $meta_query = array('relation' => 'AND');
    if (is_array($existing) && $existing) {
        $meta_query[] = $existing;
    }
    $meta_query[] = bsktv_active_status_meta_query();
    $q->set('meta_query', $meta_query);
}

function bsktv_search_posts($q) {
    if (is_admin() || !$q->is_main_query()) return;

    if ($q->is_search()) {
        $q->set('orderby', 'modified');
        $q->set('order', 'DESC');
        bsktv_front_store_query($q);
    } elseif ($q->is_home() || $q->is_archive() || $q->is_tax()) {
        bsktv_front_store_query($q);
        if (!$q->get('orderby')) {
            $q->set('orderby', 'modified');
            $q->set('order', 'DESC');
        }
    }
}
add_action('pre_get_posts', 'bsktv_search_posts');

function bsktv_excerpt_length() {
    return 24;
}
add_filter('excerpt_length', 'bsktv_excerpt_length');

function bsktv_customize($wp_customize) {
    $wp_customize->add_section('bsktv_home', array(
        'title' => 'BSKTV 首頁設定',
        'priority' => 30,
    ));
    $wp_customize->add_setting('bsktv_hero_title', array(
        'default' => '探索台灣商務 KTV 與酒店資訊',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsktv_hero_title', array(
        'label' => '首頁主標題',
        'section' => 'bsktv_home',
        'type' => 'text',
    ));
    $wp_customize->add_setting('bsktv_hero_text', array(
        'default' => '以店家為核心，快速查找城市、類型、特色與完整店家介紹。',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsktv_hero_text', array(
        'label' => '首頁說明',
        'section' => 'bsktv_home',
        'type' => 'textarea',
    ));
    $wp_customize->add_setting('bsktv_line_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsktv_line_url', array(
        'label' => '聯絡幹部 LINE 加好友連結',
        'description' => '貼上你的 LINE 加好友網址。若個別店家未設定專屬 LINE，店家頁會使用此全站連結。',
        'section' => 'bsktv_home',
        'type' => 'url',
    ));
}
add_action('customize_register', 'bsktv_customize');
