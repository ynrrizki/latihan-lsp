<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('./themes/assets/') }}"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard | SppKu</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('./themes/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('./themes/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    @stack('css')

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('./themes/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('./themes/assets/js/config.js') }}"></script>
</head>

<body>


    @yield('body')

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('./themes/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('./themes/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('./themes/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('./themes/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('./themes/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('./themes/assets/js/main.js') }}"></script>
    @stack('js')
</body>

</html>
