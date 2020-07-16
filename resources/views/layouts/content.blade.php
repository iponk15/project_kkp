@extends(!Request::ajax() ? 'layouts.layout' : 'layouts.layoutajax')

@section('fullcontent')
    @yield('content')
@endsection