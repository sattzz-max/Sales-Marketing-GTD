<?php $c = cfg(); $ct = $c['contact']; ?>
<footer class="site-footer"><div class="wrap fgrid">
  <div><?= logo_html(true) ?><p class="fname"><?= e($c['site_name']) ?></p><p class="muted">Sales &amp; Marketing Department</p></div>
  <div><h3>Navigasi</h3><a href="<?= e(url('/')) ?>">Home</a><a href="<?= e(url('about')) ?>">About Us</a><a href="<?= e(url('team')) ?>">Our Team</a><a href="<?= e(url('events')) ?>">Events &amp; Gallery</a><a href="<?= e(url('contact')) ?>">Contact</a></div>
  <div><h3>Kontak</h3>
    <p><?= e($ct['address'] ?: '[ALAMAT_RESMI]') ?></p>
    <p><?= ($m = mail_link($ct['email'])) ? '<a href="'.e($m).'" data-track="email_footer">'.e($ct['email']).'</a>' : '[EMAIL_RESMI_DEPARTEMEN]' ?></p>
    <p><?= ($w = wa_link($ct['whatsapp'])) ? '<a href="'.e($w).'" target="_blank" rel="noopener noreferrer" data-track="wa_footer">WhatsApp</a>' : '[WHATSAPP_UTAMA]' ?></p></div>
  <div><h3>Kanal Resmi</h3><?php $any=false; foreach ($c['links'] as $k=>$u) if ($u = ext_url($u)) { $any=true; echo '<a href="'.e($u).'" target="_blank" rel="noopener noreferrer" data-track="social_'.e($k).'">'.e(ucfirst($k)).'</a>'; } if(!$any) echo '<p class="muted">[LINKTREE_URL]</p>'; ?></div>
</div><div class="wrap copy">&copy; <?= e($c['copyright_year']) ?> <?= e($c['site_name']) ?>. All rights reserved.</div></footer>
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Galeri foto" hidden>
  <button class="lb-close" aria-label="Tutup">&times;</button><button class="lb-nav prev" aria-label="Foto sebelumnya">&#8249;</button>
  <figure><div class="lb-media"></div><figcaption></figcaption></figure><button class="lb-nav next" aria-label="Foto berikutnya">&#8250;</button></div>
<div class="lightbox vmodal" id="vmodal" role="dialog" aria-modal="true" aria-label="Video" hidden><button class="lb-close vclose" aria-label="Tutup video">&times;</button><div class="vbox"></div></div>
<script src="<?= e(url('assets/js/main.js')) ?>" defer></script></body></html>
