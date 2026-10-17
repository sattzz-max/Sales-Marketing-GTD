@extends('admin.layout')
@section('title','Pengaturan Website')
@section('body')
<form method="post" action="{{ route('admin.settings.save') }}" enctype="multipart/form-data" class="f">@csrf<p>Kosongkan kolom untuk memakai nilai default (.env / config/tamandayu.php). Kolom kontak/URL yang kosong membuat tombolnya nonaktif.</p>
@foreach($f as $k=>$m)<label>{{ $m[0] }}@if($m[1]==='a')<textarea name="{{ $k }}" rows="3">{{ $cur[$k] ?? '' }}</textarea>@else<input name="{{ $k }}" value="{{ $cur[$k] ?? '' }}">@endif</label>@endforeach
<label>Logo (JPG/PNG/WebP)<input type="file" name="logo" accept="image/jpeg,image/png,image/webp"></label>
<label>Foto hero golf course (disarankan 2400px)<input type="file" name="hero_image" accept="image/jpeg,image/png,image/webp"></label><button>Simpan pengaturan</button></form>@endsection
