<?php 
$c = cfg(); 
$t = $t ?? config('content.en');
$lang = $lang ?? 'en';
$hero = img(settings()['hero_image'] ?? null) ?: img('assets/images/hero/hero-golf.jpg'); 
$waMsg = $lang === 'id' 
  ? 'Halo Tim Sales Taman Dayu, saya ingin bertanya tentang layanan Anda.' 
  : 'Hello Taman Dayu Sales Team, I would like to inquire about your services.';
$main = wa_link($c['contact']['whatsapp'], $waMsg) ?: mail_link($c['contact']['email']) ?: url('contact'); 
?>
<!doctype html><html lang="<?= e($lang) ?>"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= !empty($pageTitle) && $pageTitle !== 'Home' && $pageTitle !== 'Beranda' ? e($pageTitle).' | ' : '' ?>Sales &amp; Marketing | <?= e($c['site_name']) ?></title>
<meta name="description" content="Official Sales &amp; Marketing Department Taman Dayu Golf Club &amp; Resort.">
<meta property="og:title" content="<?= e($c['site_name']) ?> — Sales &amp; Marketing"><meta property="og:type" content="website">
<?php if ($c['domain']): ?><link rel="canonical" href="<?= e(rtrim($c['domain'],'/')) ?>/"><?php endif; ?>
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' fill='%23183D30'/%3E%3Ccircle cx='16' cy='16' r='5' fill='%23B69A64'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= e(url('assets/css/style.css')) ?>">
</head><body>
<header class="site-header" id="top"><div class="wrap bar">
  <a class="logo" href="<?= e(url('/?lang='.$lang)) ?>" aria-label="Taman Dayu"><?= logo_html() ?></a>
  <button class="burger" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="nav">
    <span></span><span></span><span></span>
  </button>
  <nav id="nav" aria-label="Navigasi utama">
    <?php 
    $isHome = ($page ?? 'home') === 'home';
    $navLinks = [
      'home'    => [$isHome ? '#home' : url('/#home'), $t['nav']['home']],
      'about'   => [$isHome ? '#about' : url('/#about'), $t['nav']['about']],
      'services'=> [$isHome ? '#services' : url('/#services'), $t['nav']['services']],
      'team'    => [$isHome ? '#team' : url('/#team'), $t['nav']['team']],
      'events'  => [$isHome ? '#events' : url('/#events'), $t['nav']['events']],
      'contact' => [$isHome ? '#contact' : url('/#contact'), $t['nav']['contact']],
    ];
    foreach ($navLinks as $k=>[$href, $l]) {
      echo '<a href="'.e($href).'"'.(($page ?? 'home')===$k ? ' class="active"' : '').'>'.e($l).'</a>';
    }
    ?>
    <a class="lang" href="?lang=<?= $lang==='id' ? 'en' : 'id' ?>" hreflang="<?= $lang==='id' ? 'en' : 'id' ?>"><?= $lang==='id' ? 'EN' : 'ID' ?></a>
    <?= btn($t['nav']['cta'], $main, 'btn btn-dark nav-cta', 'cta_header') ?>
  </nav>
</div></header>
