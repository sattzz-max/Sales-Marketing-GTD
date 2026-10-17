<section class="sec" id="events"><div class="wrap"><div class="center reveal"><h2>Our Events &amp; Memorable Moments</h2>
  <p class="lead dark">A collection of experiences, collaborations, and memorable occasions at Taman Dayu.</p></div>
  <div class="carousel reveal" id="carousel" aria-roledescription="carousel" aria-label="Riwayat event">
    <div class="viewport"><div class="track"><?php foreach ($events as $ev): ?>
      <article class="slide"><div class="card-img"><?= photo($ev,'cover',$ev['title'],'FOTO_EVENT') ?></div>
      <p class="meta"><?= e($ev['category']) ?> &middot; <?= e($ev['event_date']) ?></p><h3><?= e($ev['title']) ?></h3><p><?= e($ev['description']) ?></p>
      <?php if (!empty($ev['upcoming'])): ?><span class="tag up">Mendatang</span><?php endif; ?>
      <?php if (!empty($ev['placeholder'])): ?><span class="tag">Placeholder Event</span><?php elseif ($u = ext_url($ev['link'] ?? '')): ?><a class="textlink" href="<?= e($u) ?>" target="_blank" rel="noopener noreferrer" data-track="event_detail">Lihat detail</a><?php endif; ?></article><?php endforeach; ?></div></div>
    <div class="ctrl"><button class="arrow prev" aria-label="Event sebelumnya">&#8592;</button><div class="dots" role="tablist" aria-label="Halaman carousel"></div><button class="arrow next" aria-label="Event berikutnya">&#8594;</button></div></div></div></section>
