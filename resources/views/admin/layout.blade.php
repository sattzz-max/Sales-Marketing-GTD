<!doctype html><html lang="id"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex"><title>@yield('title') - Admin</title>
<link rel="stylesheet" href="{{ url('assets/css/admin.css') }}">
@auth<header class="ah"><b>Admin Sales &amp; Marketing</b><nav><a href="{{ route('admin.inquiries') }}">Inquiry</a><a href="{{ route('admin.crud','team') }}">Tim</a><a href="{{ route('admin.crud','events') }}">Event</a><a href="{{ route('admin.crud','gallery') }}">Galeri</a><a href="{{ route('admin.settings') }}">Pengaturan</a>
<form method="post" action="{{ route('admin.logout') }}">@csrf<button>Keluar</button></form></nav></header>@endauth
<main class="am @yield('cls')"><h1>@yield('title')</h1>@if(session('err'))<p class="err">{{ session('err') }}</p>@endif @if(session('ok'))<p class="ok">{{ session('ok') }}</p>@endif
@yield('body')</main>
