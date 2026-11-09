<section class="sec alt" id="team">
  <div class="wrap">
    <div class="center reveal">
      <p class="eyebrow"><?= e($t['team']['eyebrow']) ?></p>
      <h2><?= e($t['team']['title']) ?></h2>
      <p class="lead dark"><?= e($t['team']['lead']) ?></p>
    </div>
    <div class="team reveal">
      <?php 
      $members = $team ?? $t['team']['members'];
      foreach ($members as $m): 
        $waMsg = ($lang ?? 'en') === 'id' 
          ? 'Halo '.$m['name'].', saya ingin bertanya tentang layanan Taman Dayu.' 
          : 'Hello '.$m['name'].', I would like to inquire about Taman Dayu services.';
      ?>
      <article class="member">
        <div class="card-img portrait">
          <?= photo($m, 'photo', $m['name'], 'FOTO') ?>
        </div>
        <h3><?= e($m['name']) ?></h3>
        <p class="role"><?= e($m['position']) ?></p>
        <div class="contact-row">
          <?= btn($t['team']['wa_btn'] ?? 'WhatsApp', wa_link($m['whatsapp'], $waMsg), 'btn btn-wa', 'wa_team') ?>
          <?= btn($t['team']['em_btn'] ?? 'Email', mail_link($m['email']), 'btn btn-outline', 'email_team', false) ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
