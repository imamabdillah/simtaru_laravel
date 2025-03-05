@include('layouts.header')
{{-- @if(session('role') == "1")
    @include('layouts.menu')
@elseif(session('role') == "2")
    @include('layouts.menu_opd')
@else
    @include('layouts.menu_pemohon')
@endif --}}
@include('layouts.menu')
@include('layouts.header2')
@yield('contents')
@include('layouts.footer')
