<?php
if(!defined('ABSPATH'))exit;
function bsktv_taxonomies(){register_taxonomy('bsktv_city','post',array('label'=>'城市','public'=>true,'hierarchical'=>true,'show_admin_column'=>true,'rewrite'=>array('slug'=>'city')));register_taxonomy('bsktv_type','post',array('label'=>'酒店類型','public'=>true,'hierarchical'=>true,'show_admin_column'=>true,'rewrite'=>array('slug'=>'ktv-type')));register_taxonomy('bsktv_feature','post',array('label'=>'店家特色','public'=>true,'hierarchical'=>false,'show_admin_column'=>true,'rewrite'=>array('slug'=>'feature')));} add_action('init','bsktv_taxonomies');
