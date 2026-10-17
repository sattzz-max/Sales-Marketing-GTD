@extends('admin.layout')
@section('title','Inquiry Masuk')
@section('body')<table><tr><th>Waktu</th><th>Nama</th><th>Kontak</th><th>Kebutuhan &amp; pesan</th><th>Status</th></tr>
@foreach($rows as $r)<tr><td>{{ $r->created_at }}</td><td>{{ $r->name }}<br><small>{{ $r->company }}</small></td><td>{{ $r->contact }}</td><td><b>{{ $r->topic }}</b><br>{!! nl2br(e($r->message)) !!}</td>
<td><form method="post" action="{{ route('admin.status') }}">@csrf<input type="hidden" name="id" value="{{ $r->id }}"><select name="status" onchange="this.form.submit()">
@foreach(['new'=>'Baru','contacted'=>'Sudah dihubungi','closed'=>'Selesai'] as $k=>$l)<option value="{{ $k }}" @selected($r->status===$k)>{{ $l }}</option>@endforeach</select></form></td></tr>@endforeach</table>@endsection
