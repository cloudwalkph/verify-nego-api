<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Verify Negotiator') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte/css/AdminLTE.css') }}">
    <link href="{{ asset('css/adminlte/css/skins/skin-black.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body class="hold-transition skin-black sidebar-mini" style="position: relative;">
    @include('components.admin.nav')
    @include('components.admin.sidebar')
    @yield('content')
    @include('components.admin.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('css/adminlte/js/app.min.js') }}"></script>
    <script>
        $(function() {
            $('.clickable').on('click', function() {
                location.href = $(this).data('uri');
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
