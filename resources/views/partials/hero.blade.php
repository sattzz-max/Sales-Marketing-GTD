<section class="hero" id="home"><div class="hero-in wrap">
  <p class="eyebrow">Sales &amp; Marketing Department</p>
  <h1><?= e($heroTitle) ?></h1>
  <p class="lead"><?= e($heroDesc) ?></p>
  <div class="actions"><?= btn('Hubungi Tim Sales', $main, 'btn btn-gold', 'cta_hero_contact') ?><a class="btn btn-ghost" href="#services">Jelajahi Layanan Kami</a><?php if ($video): ?><button type="button" class="btn btn-play" data-video-type="<?= e($video['type']) ?>" data-video-src="<?= e($video['src']) ?>" data-track="video_play">&#9658; Tonton Video</button><?php endif; ?></div>
</div><a class="scroll-ind" href="#about" aria-label="Gulir ke bawah"></a></section>
