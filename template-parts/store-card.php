<?php if(!defined('ABSPATH'))exit; $id=get_the_ID(); $cities=wp_get_post_terms($id,'bsktv_city',array('fields'=>'names')); $types=wp_get_post_terms($id,'bsktv_type',array('fields'=>'names')); $status=bsktv_meta('bsktv_status')?:'active'; $status_labels=array('active'=>'營業中','pending'=>'資料待確認','paused'=>'暫停營業','closed'=>'已歇業'); ?>
<article class="store-card">
<a class="store-card-media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
<?php if(has_post_thumbnail()) the_post_thumbnail('medium_large',array('loading'=>'lazy')); else echo '<div class="store-card-placeholder">BSKTV</div>'; ?>
<?php if(bsktv_is_featured()) echo '<span class="badge badge-gold">編輯推薦</span>'; ?>
</a>
<div class="store-card-body">
<div class="store-card-kicker"><?php echo esc_html(implode(' · ',$cities)); ?></div>
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<div class="store-status status-<?php echo esc_attr($status); ?>"><?php echo esc_html($status_labels[$status]??''); ?><?php if(bsktv_meta('bsktv_verified')==='1')echo ' · ✓ 資料已確認'; ?></div>
<?php if($types) echo '<div class="chips">'.implode('',array_map(function($x){return '<span class="chip">'.esc_html($x).'</span>';},$types)).'</div>'; ?>
<p><?php echo esc_html(wp_trim_words(get_the_excerpt(),20)); ?></p>
<a class="text-link" href="<?php the_permalink(); ?>">查看店家資訊 <span aria-hidden="true">→</span></a>
</div>
</article>
