@include('Kasubag.layouts.sidebar')
@include('Kasubag.layouts.header')
{{-- @include('Kasubag.layouts_baru.content') --}}

<main>
    @yield('container') <!-- Ini adalah tempat untuk konten yang akan digantikan -->
</main>
@include('Kasubag.layouts.footer')
