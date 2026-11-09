<section class="sec alt" id="about">
  <div class="wrap narrow center reveal">
    <p class="eyebrow"><?= e($t['about']['eyebrow']) ?></p>
    <h2><?= e($t['about']['title']) ?></h2>
    <p class="lead dark"><?= e($t['about']['lead']) ?></p>
  </div>
  <div class="wrap pillars reveal">
    <?php foreach ($t['about']['pillars'] as $p): ?>
    <div>
      <h3><?= e($p['title']) ?></h3>
      <p><?= e($p['desc']) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</section>
