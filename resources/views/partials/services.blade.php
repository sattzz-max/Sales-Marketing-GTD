<section class="sec" id="services">
  <div class="wrap">
    <div class="center reveal">
      <p class="eyebrow"><?= e($t['services']['eyebrow']) ?></p>
      <h2><?= e($t['services']['title']) ?></h2>
      <p class="lead dark"><?= e($t['services']['lead']) ?></p>
    </div>
    <div class="cards4 reveal">
      <?php 
      $items = $services ?? $t['services']['items'];
      foreach ($items as $i => $s): 
        $href = wa_link($c['contact']['whatsapp'] ?? '', $s['msg'] ?? '') ?: url('contact'); 
      ?>
      <article class="card">
        <div class="card-img">
          <?= photo(['photo'=>'assets/images/placeholders/service-'.($i+1).'.jpg'], 'photo', $s['title'], 'FOTO_LAYANAN_'.($i+1)) ?>
        </div>
        <h3><?= e($s['title']) ?></h3>
        <p><?= e($s['desc']) ?></p>
        <?= btn($s['cta'], $href, 'btn btn-outline', 'cta_service_'.($i+1)) ?>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
