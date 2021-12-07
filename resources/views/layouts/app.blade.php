<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('layouts.stylesheet')
    @if ($message = Session::get('success'))
    <script>
        $(document).onload(function() {
        toastr.success('{{ $message }}')
        });
    </script>
    @endif
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/AdminLTE/dist/img/AdminLTELogo.png') }}"
        alt="AdminLTELogo" height="150" width="150">
    </div>

    @include('layouts.navbar')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        @include('layouts.header')
        @yield('content')
    </div>

    @include('layouts.javascript')
</body>

</html>
