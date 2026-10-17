<?php
// Konfigurasi terpusat. Isi nilai resmi di sini (atau lewat environment variable). Kosong = tombol otomatis nonaktif.
return [
  'domain'   => env('APP_DOMAIN') ?: '',                       // [DOMAIN_RESMI] untuk canonical
  'site_name'=> 'Taman Dayu Golf Club & Resort',
  'contact'  => ['whatsapp'=>env('MAIN_WHATSAPP') ?: '', 'email'=>env('MAIN_EMAIL') ?: '', 'address'=>''],
  'links'    => ['linktree'=>'', 'instagram'=>'', 'tiktok'=>'', 'facebook'=>'', 'youtube'=>'', 'documentation'=>''],
  'copyright_year' => date('Y'),
  'services' => [
    ['title'=>'Golf Booking & Group Experience','desc'=>'Atur pengalaman bermain untuk grup, komunitas, atau tamu Anda.','cta'=>'Contact Our Sales Team','wa'=>'','msg'=>'Halo Tim Sales Taman Dayu, saya ingin bertanya tentang golf booking / group experience.'],
    ['title'=>'Corporate Gathering & Golf Events','desc'=>'Diskusikan kebutuhan gathering atau golf day perusahaan Anda.','cta'=>'Discuss Your Event','wa'=>'','msg'=>'Halo Tim Sales Taman Dayu, saya ingin mendiskusikan corporate gathering / golf event.'],
    ['title'=>'Tournament & Sponsorship Inquiry','desc'=>'Informasi turnamen dan peluang sponsorship bersama Taman Dayu.','cta'=>'Request More Information','wa'=>'','msg'=>'Halo Tim Sales Taman Dayu, saya ingin meminta informasi turnamen / sponsorship.'],
    ['title'=>'Partnership & Business Collaboration','desc'=>'Jajaki kolaborasi bisnis jangka panjang dengan kami.','cta'=>'Explore Partnership Opportunities','wa'=>'','msg'=>'Halo Tim Sales Taman Dayu, saya tertarik menjajaki kerja sama bisnis.'],
  ],
];
