@include('layouts.header')
<main>@if(($page ?? 'home') !== 'home')<h1 class="sr-only">{{ $pageTitle }}</h1>@endif
@yield('content')
</main>
@include('layouts.footer')
