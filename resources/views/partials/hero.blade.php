<section class="hero" id="home">

  {{-- Full-bleed background slides (behind everything) --}}
  <div class="hero-slides" aria-hidden="true">
    <div class="hero-slide active" data-index="0">
      <img src="{{ asset('assets/images/hero/hero-1-golf-course.jpg') }}" alt="Championship Golf Course" loading="eager" fetchpriority="high">
    </div>
    <div class="hero-slide" data-index="1">
      <img src="{{ asset('assets/images/hero/hero-2-golf-green.jpg') }}" alt="Jack Nicklaus Golf Green" loading="lazy">
    </div>
    <div class="hero-slide" data-index="2">
      <img src="{{ asset('assets/images/hero/hero-3-resort-pool.jpg') }}" alt="Resort Clubhouse &amp; Fairway" loading="lazy">
    </div>
    <div class="hero-slide" data-index="3">
      <img src="{{ asset('assets/images/hero/hero-4-resort-garden.jpg') }}" alt="Luxury Villa &amp; Resort Grounds" loading="lazy">
    </div>
    <div class="hero-slide" data-index="4">
      <img src="{{ asset('assets/images/hero/hero-5-golf-sunrise.jpg') }}" alt="Golf Course Sunrise" loading="lazy">
    </div>
  </div>

  {{-- Ultra-smooth seamless gradient overlay --}}
  <div class="hero-overlay" aria-hidden="true"></div>

  {{-- Content (sits above the overlay) --}}
  <div class="hero-content">
    <div class="hero-badge">
      <span class="badge-dot"></span>
      <span><?= e($t['hero']['badge']) ?></span>
    </div>

    <h1><?= e($heroTitle) ?></h1>
    <p class="lead"><?= e($heroDesc) ?></p>

    <div class="actions">
      <?= btn($t['hero']['btn_contact'], $main, 'btn btn-gold hero-cta', 'cta_hero_contact') ?>
      <a class="btn btn-ghost" href="#services"><?= e($t['hero']['btn_explore']) ?></a>
      <?php if ($video): ?>
      <button type="button" class="btn btn-play"
        data-video-type="<?= e($video['type']) ?>"
        data-video-src="<?= e($video['src']) ?>"
        data-track="video_play">&#9658; <?= e($t['hero']['btn_video']) ?></button>
      <?php endif; ?>
    </div>

    {{-- Highlight pills --}}
    <div class="hero-highlights">
      <div class="hl-item">
        <span class="hl-title"><?= e($t['hero']['stat_1_val']) ?></span>
        <span class="hl-desc"><?= e($t['hero']['stat_1_lbl']) ?></span>
      </div>
      <div class="hl-sep"></div>
      <div class="hl-item">
        <span class="hl-title"><?= e($t['hero']['stat_2_val']) ?></span>
        <span class="hl-desc"><?= e($t['hero']['stat_2_lbl']) ?></span>
      </div>
      <div class="hl-sep"></div>
      <div class="hl-item">
        <span class="hl-title"><?= e($t['hero']['stat_3_val']) ?></span>
        <span class="hl-desc"><?= e($t['hero']['stat_3_lbl']) ?></span>
      </div>
    </div>

    {{-- Slide indicators & Counter --}}
    <div class="hero-nav-row">
      <div class="hero-dots" role="tablist" aria-label="Slide foto latar">
        <button class="hero-dot active" role="tab" aria-selected="true"  data-slide="0" aria-label="Foto 1"></button>
        <button class="hero-dot"        role="tab" aria-selected="false" data-slide="1" aria-label="Foto 2"></button>
        <button class="hero-dot"        role="tab" aria-selected="false" data-slide="2" aria-label="Foto 3"></button>
        <button class="hero-dot"        role="tab" aria-selected="false" data-slide="3" aria-label="Foto 4"></button>
        <button class="hero-dot"        role="tab" aria-selected="false" data-slide="4" aria-label="Foto 5"></button>
      </div>
      <div class="hero-counter" aria-hidden="true">
        <span class="counter-curr">01</span><span class="counter-slash">/</span><span class="counter-total">05</span>
      </div>
    </div>
  </div>

  {{-- Ultra-smooth bottom transition blend (melts dark hero scenery into section background) --}}
  <div class="hero-bottom-blend" aria-hidden="true"></div>

  <a class="scroll-ind" href="#about" aria-label="<?= e($t['hero']['scroll']) ?>"></a>
</section>
