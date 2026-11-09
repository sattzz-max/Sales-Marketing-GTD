<?php 
$c = cfg(); 
$ct = $c['contact']; 
$t = $t ?? config('content.en');
$lang = $lang ?? 'en';
$isHome = ($page ?? 'home') === 'home';
?>
<footer class="site-footer"><div class="wrap fgrid">
  <div>
    <?= logo_html(true) ?>
    <p class="fname"><?= e($c['site_name']) ?></p>
    <p class="muted"><?= e($t['footer']['dept']) ?></p>
  </div>
  <div>
    <h3><?= e($t['footer']['nav_title']) ?></h3>
    <a href="<?= e($isHome ? '#home' : url('/?lang='.$lang.'#home')) ?>"><?= e($t['nav']['home']) ?></a>
    <a href="<?= e($isHome ? '#about' : url('/?lang='.$lang.'#about')) ?>"><?= e($t['nav']['about']) ?></a>
    <a href="<?= e($isHome ? '#services' : url('/?lang='.$lang.'#services')) ?>"><?= e($t['nav']['services']) ?></a>
    <a href="<?= e($isHome ? '#team' : url('/?lang='.$lang.'#team')) ?>"><?= e($t['nav']['team']) ?></a>
    <a href="<?= e($isHome ? '#events' : url('/?lang='.$lang.'#events')) ?>"><?= e($t['nav']['events']) ?></a>
    <a href="<?= e($isHome ? '#contact' : url('/?lang='.$lang.'#contact')) ?>"><?= e($t['nav']['contact']) ?></a>
  </div>
  <div>
    <h3><?= e($t['footer']['cont_title']) ?></h3>
    <p><?= e($ct['address'] ?: 'Jl. Raya Surabaya - Malang KM 48, Pandaan, Pasuruan, Jawa Timur 67156') ?></p>
    <p><?= ($m = mail_link($ct['email'])) ? '<a href="'.e($m).'" data-track="email_footer">'.e($ct['email']).'</a>' : 'sales@tamandayu.com' ?></p>
    <p><?= ($w = wa_link($ct['whatsapp'])) ? '<a href="'.e($w).'" target="_blank" rel="noopener noreferrer" data-track="wa_footer">WhatsApp: '.e($ct['whatsapp']).'</a>' : '' ?></p>
  </div>
  <div>
    <h3><?= e($t['footer']['chan_title']) ?></h3>
    <?php $any=false; foreach ($c['links'] as $k=>$u) if ($u = ext_url($u)) { $any=true; echo '<a href="'.e($u).'" target="_blank" rel="noopener noreferrer" data-track="social_'.e($k).'">'.e(ucfirst($k)).'</a>'; } if(!$any) echo '<a href="https://linktr.ee/tamandayugolf" target="_blank" rel="noopener noreferrer">Linktree</a>'; ?>
  </div>
</div>
<div class="wrap copy">
  <span>&copy; <?= e($c['copyright_year']) ?> <?= e($c['site_name']) ?>. <?= e($t['footer']['copy']) ?></span>
  <span>Sales &amp; Marketing Department</span>
</div>
</footer>

<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Galeri foto" hidden>
  <button class="lb-close" aria-label="Tutup">&times;</button><button class="lb-nav prev" aria-label="Foto sebelumnya">&#8249;</button>
  <figure><div class="lb-media"></div><figcaption></figcaption></figure><button class="lb-nav next" aria-label="Foto berikutnya">&#8250;</button>
</div>

<div class="lightbox vmodal" id="vmodal" role="dialog" aria-modal="true" aria-label="Video" hidden>
  <button class="lb-close vclose" aria-label="Tutup video">&times;</button>
  <div class="vbox"></div>
</div>

<script src="<?= e(url('assets/js/main.js')) ?>" defer></script>
</body></html>
