@extends('layouts.app')

@section('body')
    @push('css')
        @stack('addon-css')
    @endpush
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar @if (auth()->user()->role != 'ADMIN') layout-without-menu @endif">
        <div class="layout-container">
            <!-- Menu -->

            @include('partials.sidebar')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('partials.navbar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    @include('partials.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    @push('js')
        <!-- Vendors JS -->
        <script src="{{ asset('./themes/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('./themes/assets/js/dashboards-analytics.js') }}"></script>

        @stack('addon-js')
        @if (session()->has('notif-success'))
            <script>
                toastr.success("{{ session('notif-success') }}");
            </script>
        @endif
        @if (session()->has('notif-failed'))
            <script>
                toastr.error("{{ session('notif-failed') }}");
            </script>
        @endif
    @endpush
@endsection
