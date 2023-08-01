@extends('templates.main')

    <link href="{{ asset('layouts/vertical-dark-menu/css/light/plugins.css" rel="stylesheet" type="text/css') }}" />
    <link href="{{ asset('src/assets/css/light/pages/error/style-maintanence.css" rel="stylesheet" type="text/css') }}" />

    <link href="{{ asset('layouts/vertical-dark-menu/css/dark/plugins.css" rel="stylesheet" type="text/css') }}" />
    <link href="{{ asset('src/assets/css/dark/pages/error/style-maintanence.css" rel="stylesheet" type="text/css') }}" />

    <style>
        body.dark .theme-logo.dark-element {
            display: inline-block;
        }
        .theme-logo.dark-element {
            display: none;
        }
        body.dark .theme-logo.light-element {
            display: none;
        }
        .theme-logo.light-element {
            display: inline-block;
        }
    </style>

    <body class="maintanence text-center">

        <!-- BEGIN LOADER -->
        <div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
        <!--  END LOADER -->
        
        <div class="container-fluid maintanence-content">
            <div class="">
                <div class="maintanence-hero-img mb-4">
                    <a href="./index.html">
                        <img alt="logo" src="../src/assets/img/logo.svg" class="dark-element theme-logo">
                        <img alt="logo" src="../src/assets/img/logo2.svg" class="light-element theme-logo">
                        <br>
                        <img alt="logo" src="../src/assets/img/logo.png" width="100">
                    </a>
                </div>
                <h1 class="error-title">Under Maintenance</h1>
                <p class="text">We are currently working on making some improvements <br/> to give you better user experience. Please visit us again shortly.</p>
                <p class="text-muted mt-4">Code by Semangkamedia</p>
                <a href="/" class="btn btn-dark mt-4">Home</a>
            </div>
        </div>
    </body>
        
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->