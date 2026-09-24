<?php if(!defined('ABSPATH'))exit; $id=get_the_ID(); $cities=wp_get_post_terms($id,'bsktv_city',array('fields'=>'names')); $types=wp_get_post_terms($id,'bsktv_type',array('fields'=>'names')); ?>
<article class="store-card">
<a class="store-card-media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
<?php if(has_post_thumbnail()) the_post_thumbnail('medium_large',array('loading'=>'lazy')); else echo '<div class="store-card-placeholder">BSKTV</div>'; ?>
<?php if(bsktv_is_featured()) echo '<span class="badge badge-gold">編輯推薦</span>'; ?>
</a>
<div class="store-card-body">
<div class="store-card-kicker"><?php echo esc_html(implode(' · ',$cities)); ?></div>
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<?php if($types) echo '<div class="chips">'.implode('',array_map(function($x){return '<span class="chip">'.esc_html($x).'</span>';},$types)).'</div>'; ?>
<?php if($p=bsktv_meta('bsktv_price')) echo '<div class="store-price">'.esc_html($p).'</div>'; ?>
<p><?php echo esc_html(wp_trim_words(get_the_excerpt(),20)); ?></p>
<a class="text-link" href="<?php the_permalink(); ?>">查看店家資訊 <span aria-hidden="true">→</span></a>
</div>
</article>
