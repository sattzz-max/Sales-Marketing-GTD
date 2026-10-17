<section class="sec alt" id="gallery"><div class="wrap"><h2 class="center reveal">Explore Our Experiences</h2>
  <div class="gallery reveal"><?php foreach ($gallery as $g): ?>
    <button class="g-item" type="button" data-caption="<?= e($g['caption']) ?>" data-track="gallery_open"><?= photo($g,'photo',$g['caption'],'FOTO_GALERI') ?></button><?php endforeach; ?></div>
  <div class="center links reveal"><?= btn('Official Links & Documentation', $lt, 'btn btn-dark', 'linktree') ?></div></div></section>
