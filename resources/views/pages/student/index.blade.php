@extends('layouts.dash')

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.css') }}">
    @endpush

    <div class="card">
        <h5 class="card-header d-flex justify-content-between">
            History Pembayaran
        </h5>
        <div class="card-body">
            <x-table :headers="$headers" :data="$data" :canDelete="false" :canEdit="false" />
        </div>
    </div>

    @push('addon-js')
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.min.js') }}"></script>
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>
        <script>
            $('#myTable').DataTable();
        </script>
    @endpush
@endsection
