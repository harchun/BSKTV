<?php
if(!defined('ABSPATH'))exit;

function bsktv_store_lady_price_box(){add_meta_box('bsktv_lady_price','小姐費用','bsktv_store_lady_price_render','post','side','default');}
add_action('add_meta_boxes','bsktv_store_lady_price_box');

function bsktv_store_lady_price_render($post){
    wp_nonce_field('bsktv_lady_price_save','bsktv_lady_price_nonce');
    $value=get_post_meta($post->ID,'bsktv_lady_price',true);
    echo '<p><label><strong>小姐費用</strong><br><input style="width:100%" type="number" min="0" step="0.01" name="bsktv_lady_price" value="'.esc_attr($value).'" /></label></p><p class="description">前台右側店家資訊會顯示此費用。</p>';
}

function bsktv_store_lady_price_save($id){
    if(!isset($_POST['bsktv_lady_price_nonce'])||!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['bsktv_lady_price_nonce'])),'bsktv_lady_price_save'))return;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return;
    if(wp_is_post_revision($id)||!current_user_can('edit_post',$id))return;
    $value=isset($_POST['bsktv_lady_price'])?floatval(wp_unslash($_POST['bsktv_lady_price'])):0;
    if($value<=0)delete_post_meta($id,'bsktv_lady_price');else update_post_meta($id,'bsktv_lady_price',$value);
}
add_action('save_post_post','bsktv_store_lady_price_save',20);
