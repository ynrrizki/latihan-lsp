@extends('layouts.dash')

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/select2/select2.css') }}">
    @endpush



    <div class="card">
        <h5 class="card-header d-flex justify-content-between">
            History Pembayaran
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasAddPayment" aria-controls="offcanvasEnd">
                <span>
                    <i class="bx bx-plus me-1"></i>
                    <span class="d-none d-lg-inline-block">
                        Tambah Pembayaran Baru
                    </span>
                </span>
            </button>
        </h5>
        <div class="card-body">
            <x-table :headers="$headers" :data="$data" :delete="'payment.destroy'" :offcanvasId="'offcanvasAddPayment'" />
        </div>
    </div>

    <x-offcanvas :title="'Tambah Pembayaran'" :id="'offcanvasAddPayment'">
        <form action="{{ route('payment.store') }}" class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework"
            id="paymentForm" method="POST">
            @csrf
            @field([
                'label' => 'NISN',
                'name' => 'nisn',
                'type' => 'select',
                'options' => $students->map(function ($student) {
                        return "<option value='$student->nisn'>" . $student->nisn . ' - ' . $student->user->name . ' - ' . $student->stdClass->major->name . '</option>';
                    })->join(''),
            ])

            @field([
                'label' => 'Tanggal Bayar',
                'name' => 'pay_on',
                'placeholder' => 'Tanggal Bayar',
                'type' => 'date',
            ])

            @field([
                'label' => 'Tahun SPP',
                'name' => 'spp_id',
                'type' => 'select',
                'options' => $spps->map(function ($spp) {
                        return "<option value='$spp->id'>" . $spp->year . '</option>';
                    })->join(''),
            ])

            @field([
                'label' => 'Total Bayar',
                'name' => 'total',
                'placeholder' => 'Total',
                'type' => 'number',
            ])

            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </x-offcanvas>

    {{-- @if (session('notif')) --}}
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
        <div class="toast-header">
            <strong class="mr-auto">Sukses</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{-- {{ session('notif') }} --}}
        </div>
    </div>
    {{-- @endif --}}

    @push('addon-js')
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.min.js') }}"></script>
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('./themes/assets/vendor/libs/select2/select2.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
                $('#nisn').select2({
                    dropdownParent: $('#offcanvasAddPayment')
                });
                $('#spp_id').select2({
                    dropdownParent: $('#offcanvasAddPayment')
                });
                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');
                    let edit = "{{ route('payment.edit', ':id') }}";
                    edit = edit.replace(':id', id);
                    let update = "{{ route('payment.update', ':id') }}";
                    update = update.replace(':id', id);
                    // console.log(edit);
                    $.ajax({
                        url: edit,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            $('#paymentForm').append('@method('PUT')');
                            $('#year').val(data.year);
                            $('#amount').val(data.amount);
                            $('#paymentForm').attr('action', update);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                $('#offcanvasAddPayment').on('hidden.bs.offcanvas', function() {
                    let store = "{{ route('payment.store') }}";
                    if (!$(this).hasClass('show')) {
                        $('#paymentForm')[0].reset();
                        $('#paymentForm').attr('action', store);
                        $('#paymentForm > input[name="_method"]').remove();
                    }
                });
            });
        </script>
    @endpush
@endsection
