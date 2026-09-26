<?php get_header(); ?>
<main>
<section class="hero">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow">BSKTV · BUSINESS KTV GUIDE</span>
      <h1><?php echo esc_html(get_theme_mod('bsktv_hero_title','探索台灣商務 KTV 與酒店資訊')); ?></h1>
      <p><?php echo esc_html(get_theme_mod('bsktv_hero_text','以店家為核心，快速查找城市、類型、特色與完整店家介紹。')); ?></p>
      <form class="hero-search" action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search">
        <label class="screen-reader-text" for="hero-search">搜尋店家</label>
        <input id="hero-search" name="s" type="search" autocomplete="off" enterkeyhint="search" placeholder="搜尋店家名稱、城市、類型…">
        <button type="submit">搜尋店家</button>
      </form>
      <div class="hero-links">
        <a href="#cities">依城市探索</a>
        <a href="#types">依類型探索</a>
        <a href="#latest">最新收錄</a>
      </div>
    </div>
  </div>
</section>

<?php
$home_cities = get_terms(array('taxonomy'=>'bsktv_city','hide_empty'=>true));
$home_types = get_terms(array('taxonomy'=>'bsktv_type','hide_empty'=>true));
?>
<section class="home-discovery">
  <div class="container">
    <div class="home-summary" aria-label="平台摘要">
      <strong><?php echo esc_html(bsktv_active_store_count()); ?></strong><span>營業中店家</span>
      <i aria-hidden="true"></i>
      <strong><?php echo esc_html(!is_wp_error($home_cities)?count($home_cities):0); ?></strong><span>城市</span>
      <i aria-hidden="true"></i>
      <strong><?php echo esc_html(!is_wp_error($home_types)?count($home_types):0); ?></strong><span>店家類型</span>
    </div>
    <?php if(!is_wp_error($home_cities)&&$home_cities): ?>
      <div class="quick-browse">
        <span class="quick-browse-label">熱門城市</span>
        <div class="quick-browse-links">
          <?php foreach(array_slice($home_cities,0,8) as $city){$link=get_term_link($city);if(is_wp_error($link))continue; ?>
            <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($city->name); ?></a>
          <?php } ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php
$featured = new WP_Query(array(
  'post_type'=>'post',
  'post_status'=>'publish',
  'posts_per_page'=>6,
  'orderby'=>'modified',
  'order'=>'DESC',
  'ignore_sticky_posts'=>true,
  'meta_key'=>'bsktv_home_featured',
  'meta_value'=>'1',
  'meta_query'=>bsktv_active_status_meta_query(),
));
if($featured->have_posts()):
?>
<section class="section">
  <div class="container">
    <div class="section-head">
      <div><span class="eyebrow">EDITOR'S PICKS</span><h2>精選店家</h2><p class="section-subtitle">值得深入了解的店家資訊。</p></div>
      <a class="text-link" href="<?php echo esc_url(get_post_type_archive_link('post')?:home_url('/')); ?>">查看全部 →</a>
    </div>
    <div class="store-grid">
      <?php while($featured->have_posts()):$featured->the_post();get_template_part('template-parts/store-card');endwhile; ?>
    </div>
  </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<section class="section section-dark" id="cities">
  <div class="container">
    <div class="section-head">
      <div><span class="eyebrow">DISCOVER BY CITY</span><h2>依城市探索</h2><p class="section-subtitle">從城市開始找到店家。</p></div>
      <?php if(!is_wp_error($home_cities)&&count($home_cities)>12): ?><span class="section-count"><?php echo esc_html(count($home_cities)); ?> 個城市</span><?php endif; ?>
    </div>
    <div class="term-grid">
      <?php if(!is_wp_error($home_cities)) foreach(array_slice($home_cities,0,12) as $city){$link=get_term_link($city);if(is_wp_error($link))continue; ?>
        <a class="term-card" href="<?php echo esc_url($link); ?>">
          <div><strong><?php echo esc_html($city->name); ?></strong><span><?php echo esc_html($city->count); ?> 間店家</span></div>
          <span aria-hidden="true">→</span>
        </a>
      <?php } ?>
    </div>
  </div>
</section>

<section class="section" id="types">
  <div class="container">
    <div class="section-head">
      <div><span class="eyebrow">BROWSE BY TYPE</span><h2>依類型探索</h2><p class="section-subtitle">依店家類型快速縮小範圍。</p></div>
      <?php if(!is_wp_error($home_types)&&count($home_types)>12): ?><span class="section-count"><?php echo esc_html(count($home_types)); ?> 種類型</span><?php endif; ?>
    </div>
    <div class="term-grid term-grid-light">
      <?php if(!is_wp_error($home_types)) foreach(array_slice($home_types,0,12) as $type){$link=get_term_link($type);if(is_wp_error($link))continue; ?>
        <a class="term-card" href="<?php echo esc_url($link); ?>">
          <div><strong><?php echo esc_html($type->name); ?></strong><span><?php echo esc_html($type->count); ?> 間店家</span></div>
          <span aria-hidden="true">→</span>
        </a>
      <?php } ?>
    </div>
  </div>
</section>

<section class="section section-muted" id="latest">
  <div class="container">
    <div class="section-head">
      <div><span class="eyebrow">LATEST</span><h2>最新收錄</h2><p class="section-subtitle">最近加入或更新的店家。</p></div>
      <a class="text-link" href="<?php echo esc_url(get_post_type_archive_link('post')?:home_url('/')); ?>">探索全部 →</a>
    </div>
    <div class="store-grid" data-home-latest data-home-latest-items data-page="1">
      <?php
      $latest = new WP_Query(array(
        'post_type'=>'post',
        'post_status'=>'publish',
        'posts_per_page'=>6,
        'paged'=>1,
        'orderby'=>'modified',
        'order'=>'DESC',
        'ignore_sticky_posts'=>true,
        'meta_query'=>bsktv_active_status_meta_query(),
      ));
      while($latest->have_posts()):$latest->the_post();get_template_part('template-parts/store-card');endwhile;
      wp_reset_postdata();
      ?>
    </div>
    <div class="infinite-status" data-home-latest-status aria-live="polite"></div>
  </div>
</section>

<section class="section">
  <div class="container cta">
    <div><span class="eyebrow">BSKTV GUIDE</span><h2>找一家適合的店家</h2><p>從城市、類型或店家名稱開始。</p></div>
    <a class="btn btn-primary" href="<?php echo esc_url(get_post_type_archive_link('post')?:home_url('/')); ?>">開始找店家</a>
  </div>
</section>
</main>
<?php get_footer(); ?>