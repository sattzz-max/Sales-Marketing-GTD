<section class="sec alt" id="team"><div class="wrap"><div class="center reveal"><h2>Meet Our Sales &amp; Marketing Team</h2>
  <p class="lead dark">The people behind our partnerships, customer relationships, and business opportunities.</p></div>
  <div class="team reveal"><?php foreach ($team as $m): ?>
    <article class="member"><div class="card-img portrait"><?= photo($m,'photo',$m['name'],'FOTO') ?></div>
    <h3><?= e($m['name']) ?></h3><p class="role"><?= e($m['position']) ?></p>
    <div class="contact-row"><?= btn('WhatsApp', wa_link($m['whatsapp'],'Halo '.$m['name'].', saya ingin bertanya tentang Taman Dayu.'), 'btn btn-wa', 'wa_team') ?>
    <?= btn('Email', mail_link($m['email']), 'btn btn-outline', 'email_team', false) ?></div></article><?php endforeach; ?></div></div></section>
