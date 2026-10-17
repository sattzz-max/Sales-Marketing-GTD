<section class="sec" id="services"><div class="wrap"><h2 class="center reveal">Discover Opportunities with Taman Dayu</h2>
  <div class="cards4 reveal"><?php foreach ($c['services'] as $i=>$s): $href = wa_link($s['wa'], $s['msg']) ?: url('contact'); $pending = !wa_link($s['wa']); ?>
    <article class="card"><div class="card-img"><?= photo(['photo'=>'assets/images/placeholders/service-'.($i+1).'.jpg'],'photo',$s['title'],'FOTO_LAYANAN_'.($i+1)) ?></div>
    <h3><?= e($s['title']) ?></h3><p><?= e($s['desc']) ?></p>
    <?= btn($s['cta'], $href, 'btn btn-outline', 'cta_service_'.($i+1), !$pending) ?></article><?php endforeach; ?></div></div></section>
