<?php
if (!defined('ABSPATH')) exit;
require_once get_template_directory().'/inc/setup.php';
require_once get_template_directory().'/inc/taxonomies.php';
require_once get_template_directory().'/inc/metadata.php';
require_once get_template_directory().'/inc/helpers.php';
require_once get_template_directory().'/inc/features.php';
require_once get_template_directory().'/inc/seo.php';
function bsktv_assets(){ $v=wp_get_theme()->get('Version'); wp_enqueue_style('bsktv-style',get_stylesheet_uri(),array(),$v); wp_enqueue_script('bsktv-js',get_template_directory_uri().'/assets/js/bsktv.js',array(),$v,true); wp_localize_script('bsktv-js','BSKTV',array('ajaxUrl'=>admin_url('admin-ajax.php'),'nonce'=>wp_create_nonce('bsktv_frontend'),'homeUrl'=>home_url('/'))); }
add_action('wp_enqueue_scripts','bsktv_assets');
function bsktv_widgets(){register_sidebar(array('name'=>'側邊欄','id'=>'sidebar-1','before_widget'=>'<section class="widget">','after_widget'=>'</section>','before_title'=>'<h2>','after_title'=>'</h2>'));} add_action('widgets_init','bsktv_widgets');
function bsktv_search_posts($q){if(!is_admin()&&$q->is_main_query()&&$q->is_search())$q->set('post_type','post');} add_action('pre_get_posts','bsktv_search_posts');
function bsktv_excerpt_length(){return 24;} add_filter('excerpt_length','bsktv_excerpt_length');
function bsktv_customize($wp_customize){$wp_customize->add_section('bsktv_home',array('title'=>'BSKTV 首頁設定','priority'=>30));$wp_customize->add_setting('bsktv_hero_title',array('default'=>'探索台灣商務 KTV 與酒店資訊','sanitize_callback'=>'sanitize_text_field'));$wp_customize->add_control('bsktv_hero_title',array('label'=>'首頁主標題','section'=>'bsktv_home','type'=>'text'));$wp_customize->add_setting('bsktv_hero_text',array('default'=>'查找店家、消費方式、城市與特色，快速掌握店家資訊。','sanitize_callback'=>'sanitize_textarea_field'));$wp_customize->add_control('bsktv_hero_text',array('label'=>'首頁說明','section'=>'bsktv_home','type'=>'textarea'));$wp_customize->add_setting('bsktv_line_url',array('default'=>'','sanitize_callback'=>'esc_url_raw'));$wp_customize->add_control('bsktv_line_url',array('label'=>'聯絡幹部 LINE 加好友連結','description'=>'貼上你的 LINE 官方帳號／LINE@ 加好友連結，例如 https://lin.ee/xxxxx。店家頁右側「聯絡幹部」按鈕會統一使用此連結。','section'=>'bsktv_home','type'=>'url'));}
add_action('customize_register','bsktv_customize');
