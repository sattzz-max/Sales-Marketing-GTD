<section class="sec alt" id="gallery">
  <div class="wrap">
    <div class="center reveal">
      <p class="eyebrow"><?= e($t['gallery']['eyebrow']) ?></p>
      <h2><?= e($t['gallery']['title']) ?></h2>
      <p class="lead dark"><?= e($t['gallery']['lead']) ?></p>
    </div>
    <div class="gallery reveal">
      <?php 
      $items = $gallery ?? $t['gallery']['items'];
      foreach ($items as $g): 
      ?>
      <button class="g-item" type="button" data-caption="<?= e($g['caption']) ?>" data-track="gallery_open">
        <?= photo($g, 'photo', $g['caption'], 'FOTO_GALERI') ?>
      </button>
      <?php endforeach; ?>
    </div>
    <div class="center links reveal">
      <?= btn($t['gallery']['btn_link'], $lt, 'btn btn-dark', 'linktree') ?>
    </div>
  </div>
</section>
