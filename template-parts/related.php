<?php
$id = get_the_ID();
$terms = wp_get_post_terms($id, 'bsktv_city', array('fields' => 'ids'));
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'post__not_in' => array($id),
    'orderby' => 'modified',
    'order' => 'DESC',
    'ignore_sticky_posts' => true,
    'meta_query' => bsktv_active_status_meta_query(),
);
if ($terms && !is_wp_error($terms)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'bsktv_city',
            'field' => 'term_id',
            'terms' => $terms,
        ),
    );
}
$q = new WP_Query($args);
if ($q->have_posts()):
?>
<section class="section related">
  <div class="section-head">
    <div>
      <span class="eyebrow">EXPLORE MORE</span>
      <h2>同城市店家</h2>
      <p class="section-subtitle">看看同城市其他店家資訊。</p>
    </div>
  </div>
  <div class="store-grid">
    <?php while ($q->have_posts()): $q->the_post(); get_template_part('template-parts/store-card'); endwhile; ?>
  </div>
</section>
<?php endif; wp_reset_postdata(); ?>