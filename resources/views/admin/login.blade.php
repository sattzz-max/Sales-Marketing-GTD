@extends('admin.layout')
@section('title','Login Admin')@section('cls','login')
@section('body')<form method="post" class="f">@csrf<label>Email<input type="email" name="email" required autofocus></label><label>Password<input type="password" name="password" required></label><button>Masuk</button></form>@endsection
