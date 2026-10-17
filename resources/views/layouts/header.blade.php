<?php $c = cfg(); $hero = img(settings()['hero_image'] ?? null) ?: img('assets/images/hero/hero-golf.jpg'); $main = wa_link($c['contact']['whatsapp'], 'Halo Tim Sales Taman Dayu, saya ingin bertanya.') ?: mail_link($c['contact']['email']) ?: url('contact'); ?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= !empty($pageTitle) && $pageTitle !== 'Home' ? e($pageTitle).' | ' : '' ?>Sales & Marketing | <?= e($c['site_name']) ?></title>
<meta name="description" content="Official Sales & Marketing Department Taman Dayu Golf Club & Resort. Kenali layanan kami dan hubungi tim untuk kebutuhan Anda.">
<meta property="og:title" content="<?= e($c['site_name']) ?> — Sales & Marketing"><meta property="og:type" content="website">
<?php if ($c['domain']): ?><link rel="canonical" href="<?= e(rtrim($c['domain'],'/')) ?>/"><?php endif; ?>
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' fill='%23183D30'/%3E%3Ccircle cx='16' cy='16' r='5' fill='%23B69A64'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= e(url('assets/css/style.css')) ?>">
<style>.hero{<?= $hero ? "background-image:linear-gradient(180deg,rgba(10,25,18,.45),rgba(10,25,18,.2) 45%,rgba(10,25,18,.65)),url('".e($hero)."')" : '' ?>}</style>
</head><body>
<header class="site-header" id="top"><div class="wrap bar">
  <a class="logo" href="<?= e(url('/')) ?>" aria-label="Taman Dayu"><?= logo_html() ?></a>
  <button class="burger" aria-label="Buka menu" aria-expanded="false" aria-controls="nav"><span></span><span></span><span></span></button>
  <nav id="nav" aria-label="Navigasi utama"><?php foreach (['home'=>['','Home'],'about'=>['about','About Us'],'team'=>['team','Our Team'],'events'=>['events','Events &amp; Gallery'],'contact'=>['contact','Contact']] as $k=>[$f,$l]) echo '<a href="'.e(url($f)).'"'.(($page ?? 'home')===$k ? ' class="active" aria-current="page"' : '').'>'.$l.'</a>'; ?>
    <a class="lang" href="?lang=<?= ($lang ?? 'en')==='id' ? 'en' : 'id' ?>" hreflang="<?= ($lang ?? 'en')==='id' ? 'en' : 'id' ?>"><?= ($lang ?? 'en')==='id' ? 'EN' : 'ID' ?></a>
    <?= btn('Contact Our Team', $main, 'btn btn-dark nav-cta', 'cta_header') ?></nav>
</div></header>
