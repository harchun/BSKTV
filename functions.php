<?php
if (!defined('ABSPATH')) exit;
require_once get_template_directory().'/inc/setup.php';
require_once get_template_directory().'/inc/taxonomies.php';
require_once get_template_directory().'/inc/metadata.php';
require_once get_template_directory().'/inc/helpers.php';
require_once get_template_directory().'/inc/features.php';
require_once get_template_directory().'/inc/seo.php';
function bsktv_assets(){ $v=wp_get_theme()->get('Version'); wp_enqueue_style('bsktv-style',get_stylesheet_uri(),array(),$v); wp_enqueue_script('bsktv-js',get_template_directory_uri().'/assets/js/bsktv.js',array(),$v,true); }
add_action('wp_enqueue_scripts','bsktv_assets');
function bsktv_widgets(){register_sidebar(array('name'=>'側邊欄','id'=>'sidebar-1','before_widget'=>'<section class="widget">','after_widget'=>'</section>','before_title'=>'<h2>','after_title'=>'</h2>'));} add_action('widgets_init','bsktv_widgets');
function bsktv_search_posts($q){if(!is_admin()&&$q->is_main_query()&&$q->is_search())$q->set('post_type','post');} add_action('pre_get_posts','bsktv_search_posts');
