@extends('admin.layout')
@section('title',$title)
@section('body')
<form method="post" action="{{ route('admin.save',$res) }}" enctype="multipart/form-data" class="f">@csrf<input type="hidden" name="id" value="{{ $edit->id ?? 0 }}"><h2>{{ $edit ? 'Edit data' : 'Tambah baru' }}</h2>
@foreach($f as $c=>$m)@php $val = $edit->$c ?? ($m[1]==='check' ? 1 : ''); @endphp
<label>{{ $m[0] }}
@if($m[1]==='textarea')<textarea name="{{ $c }}" rows="3">{{ $val }}</textarea>
@elseif($m[1]==='check')<input type="checkbox" name="{{ $c }}" @checked($val)>
@else<input type="{{ in_array($m[1],['number','date','email']) ? $m[1] : 'text' }}" name="{{ $c }}" value="{{ $val }}">@endif</label>@endforeach
@if($photo)<label>Foto (JPG/PNG/WebP, maks 5 MB, otomatis jadi WebP){{ ($edit && $edit->$photo) ? ' - sekarang: '.basename($edit->$photo) : '' }}<input type="file" name="{{ $photo }}" accept="image/jpeg,image/png,image/webp"></label>@endif
<button>Simpan</button>@if($edit) <a href="{{ route('admin.crud',$res) }}">Batal</a>@endif</form>
<table><tr><th>Data</th><th>Urutan</th><th></th></tr>
@foreach($rows as $r)<tr><td>{{ $r->{array_key_first($f)} }}</td><td>{{ $r->sort_order }}</td><td><a href="{{ route('admin.crud',$res) }}?edit={{ $r->id }}">Edit</a>
<form method="post" action="{{ route('admin.delete',$res) }}" class="inl" onsubmit="return confirm('Hapus data ini?')">@csrf<input type="hidden" name="id" value="{{ $r->id }}"><button>Hapus</button></form></td></tr>@endforeach</table>@endsection
