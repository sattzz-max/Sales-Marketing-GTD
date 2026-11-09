<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller {
  const TITLES = [
    'en' => ['home'=>'Home','about'=>'About Us','team'=>'Our Team','events'=>'Events & Gallery','contact'=>'Contact'],
    'id' => ['home'=>'Beranda','about'=>'Tentang Kami','team'=>'Tim Kami','events'=>'Acara & Galeri','contact'=>'Kontak'],
  ];

  public function show(Request $r, string $page = 'home') {
    $c = cfg();
    $S = settings();
    
    // Resolve language from query string or session, default to English
    $qLang = $r->query('lang');
    if ($qLang && in_array($qLang, ['en', 'id'])) {
      $lang = $qLang;
      try { $r->session()->put('lang', $lang); } catch (\Throwable $e) {}
    } else {
      $lang = 'en';
      try { $lang = $r->session()->get('lang', 'en'); } catch (\Throwable $e) {}
    }
    if (!in_array($lang, ['en', 'id'])) {
      $lang = 'en';
    }

    $t = config("content.$lang", config('content.en'));

    // Resolve hero title and description with language priority
    $heroTitle = ($S["hero_title_$lang"] ?? '') ?: $t['hero']['title'];
    $heroDesc  = ($S["hero_desc_$lang"] ?? '') ?: $t['hero']['desc'];

    // Services list from translation
    $services = $t['services']['items'];

    // WhatsApp CTA message based on language
    $waMsg = $lang === 'id' 
      ? 'Halo Tim Sales Taman Dayu, saya ingin bertanya tentang layanan Anda.' 
      : 'Hello Taman Dayu Sales Team, I would like to inquire about your services.';

    // Team members: use content dictionary with fallback override from config/tim.php
    $team = $t['team']['members'];
    $cfgTim = config('tim', []);
    foreach ($team as $idx => &$tm) {
      if (!empty($cfgTim[$idx]['nama']))     $tm['name']     = $cfgTim[$idx]['nama'];
      if (!empty($cfgTim[$idx]['whatsapp'])) $tm['whatsapp'] = $cfgTim[$idx]['whatsapp'];
      if (!empty($cfgTim[$idx]['email']))    $tm['email']    = $cfgTim[$idx]['email'];
      if (!empty($cfgTim[$idx]['foto']))     $tm['photo']    = $cfgTim[$idx]['foto'];
    }
    unset($tm);

    return view("pages.$page", [
      'page'      => $page,
      'pageTitle' => self::TITLES[$lang][$page] ?? self::TITLES['en'][$page] ?? 'Home',
      'c'         => $c,
      'lang'      => $lang,
      't'         => $t,
      'services'  => $services,
      'team'      => $team,
      'events'    => $t['events']['items'],
      'gallery'   => $t['gallery']['items'],
      'main'      => wa_link($c['contact']['whatsapp'], $waMsg) ?: mail_link($c['contact']['email']) ?: url('contact'),
      'lt'        => ext_url($c['links']['linktree']),
      'heroTitle' => $heroTitle,
      'heroDesc'  => $heroDesc,
      'video'     => video_embed($S['video_url'] ?? ''),
    ]);
  }
}
