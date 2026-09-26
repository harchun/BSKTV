<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <strong>BS<span>KTV</span></strong>
      <p>商務 KTV／酒店店家資訊平台</p>
    </div>
    <div class="footer-nav">
      <?php if (has_nav_menu('footer')) wp_nav_menu(array('theme_location' => 'footer', 'container' => false)); ?>
    </div>
    <div>© <?php echo esc_html(wp_date('Y')); ?> BSKTV. All rights reserved.</div>
  </div>
</footer>
<button class="back-to-top" type="button" aria-label="回到頂部" hidden>↑ <span>頂部</span></button>
<?php wp_footer(); ?>
<script>
(function(){
  const b=document.querySelector('.back-to-top');
  if(!b)return;
  const sync=()=>{b.hidden=window.scrollY<500;};
  window.addEventListener('scroll',sync,{passive:true});
  sync();
  b.addEventListener('click',()=>window.scrollTo({top:0,behavior:'smooth'}));
})();
</script>
</body>
</html>