<?php
if(!defined('ABSPATH'))exit;
function bsktv_excerpt($length=30){$text=get_the_excerpt();return wp_trim_words(wp_strip_all_tags($text),$length,'…');}
function bsktv_views($id=null){return (int)get_post_meta($id?:get_the_ID(),'bsktv_views',true);}
function bsktv_store_view(){if(!is_singular('post')||is_admin()||wp_doing_ajax())return;$id=get_queried_object_id();if($id)update_post_meta($id,'bsktv_views',bsktv_views($id)+1);}add_action('template_redirect','bsktv_store_view');
