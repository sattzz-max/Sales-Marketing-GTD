<section class="sec" id="events">
  <div class="wrap">
    <div class="center reveal">
      <p class="eyebrow"><?= e($t['events']['eyebrow']) ?></p>
      <h2><?= e($t['events']['title']) ?></h2>
      <p class="lead dark"><?= e($t['events']['lead']) ?></p>
    </div>

    <div class="carousel reveal" id="carousel" aria-roledescription="carousel" aria-label="Riwayat event">
      <div class="viewport">
        <div class="track">
          <?php 
          $items = $events ?? $t['events']['items'];
          foreach ($items as $ev): 
          ?>
          <article class="slide">
            <div class="slide-card">
              <div class="card-img">
                <?= photo($ev, 'cover', $ev['title'], 'FOTO_EVENT') ?>
              </div>
              <p class="meta"><?= e($ev['category']) ?> &middot; <?= e($ev['event_date']) ?></p>
              <h3><?= e($ev['title']) ?></h3>
              <p><?= e($ev['description']) ?></p>
              <div style="margin-top:auto;display:flex;align-items:center;justify-content:space-between;padding-top:.6rem;">
                <?php if (!empty($ev['upcoming'])): ?>
                  <span class="tag up"><?= e($t['events']['upcoming']) ?></span>
                <?php else: ?>
                  <span class="tag"><?= e($t['events']['finished']) ?></span>
                <?php endif; ?>
                <?php if ($u = ext_url($ev['link'] ?? '')): ?>
                  <a class="textlink" href="<?= e($u) ?>" target="_blank" rel="noopener noreferrer" data-track="event_detail"><?= e($t['events']['details']) ?></a>
                <?php endif; ?>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="ctrl">
        <button class="arrow prev" aria-label="Event sebelumnya">&#8592;</button>
        <div class="dots" role="tablist" aria-label="Halaman carousel"></div>
        <button class="arrow next" aria-label="Event berikutnya">&#8594;</button>
      </div>
    </div>
  </div>
</section>
