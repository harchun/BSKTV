<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#090909">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if (function_exists('wp_body_open')) wp_body_open(); ?>
<header class="site-header">
  <div class="container header-inner">
    <a class="site-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="BSKTV 首頁">
      <?php
      $logo_id = get_theme_mod('custom_logo');
      if ($logo_id) {
          echo wp_get_attachment_image($logo_id, 'full', false, array('class' => 'site-brand-logo', 'loading' => 'eager', 'decoding' => 'async'));
      } else {
          echo '<span class="site-brand-text">BS<span>KTV</span></span>';
      }
      ?>
    </a>
    <nav id="primary-nav" class="main-nav" data-mobile-nav aria-label="主要選單">
      <?php
      wp_nav_menu(array(
          'theme_location' => 'primary',
          'container' => false,
          'fallback_cb' => function () {
              $directory = get_post_type_archive_link('post') ?: home_url('/');
              echo '<ul><li><a href="' . esc_url(home_url('/')) . '">首頁</a></li><li><a href="' . esc_url($directory) . '">找店家</a></li></ul>';
          },
      ));
      ?>
    </nav>
    <div class="header-actions">
      <a class="header-search-link" href="<?php echo esc_url(get_post_type_archive_link('post') ?: home_url('/')); ?>" aria-label="找店家">
        找店家
      </a>
      <button class="menu-toggle" data-menu-toggle aria-expanded="false" aria-controls="primary-nav" type="button">
        <span></span><span></span><span></span>
        <b class="screen-reader-text">開啟選單</b>
      </button>
    </div>
  </div>
</header>