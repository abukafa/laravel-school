<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ session('school.logo') ? asset('storage/logo.png') : '/src/assets/img/logo.png' }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('layouts/vertical-dark-menu/css/light/loader.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('layouts/vertical-dark-menu/css/dark/loader.css') }}" />
    <script src="/layouts/vertical-dark-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito:400,600,700">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('layouts/vertical-dark-menu/css/light/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('layouts/vertical-dark-menu/css/dark/plugins.css') }}" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="{{ asset('src/plugins/src/font-icons/fontawesome/css/regular.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/src/font-icons/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/components/font-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/components/font-icons.css') }}">
    <style>
        /* ----- CHANGE THE SCROLL BAR DESIGN ----- */
        ::-webkit-scrollbar{
            width: 10px;
            border-radius: 25px;
        }
        ::-webkit-scrollbar-track{
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb{
            background: #ccc;
            border-radius: 30px;
        }
        ::-webkit-scrollbar-thumb:hover{
            background: #bbb;
        }
    </style>

</head>
<body class="layout-boxed">


    @yield('body')


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('layouts/vertical-dark-menu/app.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

</body>
</html>
