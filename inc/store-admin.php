<?php
if(!defined('ABSPATH'))exit;

/**
 * Additional BSKTV store field: 小姐費用.
 * LINE contact URL is managed globally in Appearance > Customize > BSKTV 首頁設定.
 */
function bsktv_store_lady_price_field($post){
    $value=get_post_meta($post->ID,'bsktv_lady_price',true);
    echo '<p><label><strong>小姐費用</strong><br><input style="width:100%" type="number" min="0" step="0.01" name="bsktv_lady_price" value="'.esc_attr($value).'" /></label></p>';
}
add_action('bsktv_meta_box_after_fields','bsktv_store_lady_price_field');

function bsktv_store_lady_price_save($id){
    if(!isset($_POST['bsktv_meta_nonce'])||!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['bsktv_meta_nonce'])),'bsktv_meta_save'))return;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return;
    if(wp_is_post_revision($id)||!current_user_can('edit_post',$id))return;
    $value=isset($_POST['bsktv_lady_price'])?floatval(wp_unslash($_POST['bsktv_lady_price'])):0;
    if($value<=0)delete_post_meta($id,'bsktv_lady_price');else update_post_meta($id,'bsktv_lady_price',$value);
}
add_action('save_post_post','bsktv_store_lady_price_save',20);
