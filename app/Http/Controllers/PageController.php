<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PageController extends Controller {
  const TITLES = ['home'=>'Home','about'=>'About Us','team'=>'Our Team','events'=>'Events & Gallery','contact'=>'Contact'];
  public function show(Request $r, string $page = 'home') {
    $c = cfg(); $S = settings(); $lang = $r->query('lang') === 'id' ? 'id' : 'en';
    $D = ['en'=>['More Than Golf. A Destination for Meaningful Experiences.','Discover opportunities, create memorable experiences, and connect with the team behind Taman Dayu Golf Club & Resort.'],
          'id'=>['Menghubungkan Pengalaman, Membangun Relasi, Menciptakan Peluang.','Kenali layanan kami, temukan peluang kolaborasi, dan hubungi tim Sales & Marketing Taman Dayu Golf Club & Resort untuk kebutuhan Anda.']];
    return view("pages.$page", [
      'page'=>$page, 'pageTitle'=>self::TITLES[$page], 'c'=>$c, 'lang'=>$lang,
      'team'=>get_team(), 'events'=>get_events(), 'gallery'=>get_gallery(),
      'main'=>wa_link($c['contact']['whatsapp'], 'Halo Tim Sales Taman Dayu, saya ingin bertanya.') ?: mail_link($c['contact']['email']) ?: url('contact'),
      'lt'=>ext_url($c['links']['linktree']),
      'heroTitle'=>($S["hero_title_$lang"] ?? '') ?: $D[$lang][0], 'heroDesc'=>($S["hero_desc_$lang"] ?? '') ?: $D[$lang][1],
      'video'=>video_embed($S['video_url'] ?? '')]);
  }
}
