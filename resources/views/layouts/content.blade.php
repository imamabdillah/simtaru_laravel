@if (isset($isi))
    @if (isset($data))
        @include($isi, $data)
    @else
        @include($isi)
    @endif
@else
    @include('layouts.default')
@endif