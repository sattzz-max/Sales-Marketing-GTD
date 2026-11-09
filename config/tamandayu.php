<?php
// Konfigurasi terpusat Taman Dayu Golf Club & Resort.
return [
  'domain'         => env('APP_DOMAIN') ?: '',
  'site_name'      => 'Taman Dayu Golf Club & Resort',
  'contact'        => [
    'whatsapp' => env('MAIN_WHATSAPP') ?: '08113338899',
    'email'    => env('MAIN_EMAIL') ?: 'sales@tamandayu.com',
    'address'  => 'Jl. Raya Surabaya - Malang KM 48, Pandaan, Pasuruan, Jawa Timur 67156',
  ],
  'links'          => [
    'linktree'      => 'https://linktr.ee/tamandayugolf',
    'instagram'     => 'https://instagram.com/tamandayu_golf',
    'tiktok'        => 'https://tiktok.com/@tamandayugolf',
    'facebook'      => 'https://facebook.com/tamandayugolfresort',
    'youtube'       => 'https://youtube.com',
    'documentation' => '',
  ],
  'copyright_year' => date('Y'),
  'services'       => [
    [
      'title' => 'Golf Booking & Group Experience',
      'desc'  => 'Atur pengalaman bermain untuk grup, komunitas, atau tamu korporat Anda dengan fasilitas kejuaraan 18 hole berstandar internasional.',
      'cta'   => 'Book Your Tee Time',
      'wa'    => '08113338899',
      'msg'   => 'Halo Tim Sales Taman Dayu, saya ingin reservasi tee time dan info paket group golf.',
    ],
    [
      'title' => 'Corporate Gathering & Golf Day',
      'desc'  => 'Diskusikan paket lengkap gathering perusahaan, outbond, dan golf day eksklusif dengan panorama pegunungan yang menyejukkan.',
      'cta'   => 'Plan Corporate Event',
      'wa'    => '08113338899',
      'msg'   => 'Halo Tim Sales Taman Dayu, saya ingin mendiskusikan corporate gathering / golf day.',
    ],
    [
      'title' => 'Tournament & Sponsorship Inquiry',
      'desc'  => 'Informasi penyelenggaraan turnamen resmi, branding lapangan, serta peluang kemitraan sponsorship bergengsi bersama Taman Dayu.',
      'cta'   => 'Explore Sponsorship',
      'wa'    => '08113338899',
      'msg'   => 'Halo Tim Sales Taman Dayu, saya ingin meminta info turnamen dan sponsorship.',
    ],
    [
      'title' => 'Partnership & Strategic Tie-Ups',
      'desc'  => 'Jajaki kolaborasi bisnis jangka panjang, loyalty program, dan penawaran kemitraan eksklusif bersama manajemen Taman Dayu.',
      'cta'   => 'Discuss Collaboration',
      'wa'    => '08113338899',
      'msg'   => 'Halo Tim Sales Taman Dayu, saya tertarik menjajaki kerja sama bisnis strategis.',
    ],
  ],
];
