<section class="sec cta" id="contact"><div class="wrap narrow center reveal">
  <h2>Let's Create the Next Opportunity Together.</h2>
  <p class="lead">Whether you're planning a golf experience, exploring a business collaboration, or seeking information, our team is ready to help.</p>
  <?= btn('Talk to Our Team', $main, 'btn btn-gold', 'cta_final') ?>
  <form id="inquiry" class="inquiry" action="<?= e(route('inquiry.submit')) ?>" method="post" novalidate>
    <input type="hidden" name="_token" value="<?= e(csrf_token()) ?>"><input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
    <label>Nama<input name="name" required maxlength="120" autocomplete="name"></label>
    <label>Perusahaan (opsional)<input name="company" maxlength="120" autocomplete="organization"></label>
    <label>WhatsApp / Email<input name="contact" required maxlength="160"></label>
    <label>Kebutuhan<select name="topic"><?php foreach ($c['services'] as $s) echo '<option>'.e($s['title']).'</option>'; ?><option>Lainnya</option></select></label>
    <label class="full">Pesan<textarea name="message" rows="4" required maxlength="2000"></textarea></label>
    <button class="btn btn-gold" type="submit">Kirim Inquiry</button><p class="status" role="status" aria-live="polite"></p></form></div></section>
