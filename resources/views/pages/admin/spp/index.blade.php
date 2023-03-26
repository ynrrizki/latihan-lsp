@extends('layouts.dash')

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/select2/select2.css') }}">
    @endpush



    <div class="card">
        <h5 class="card-header d-flex justify-content-between">
            Daftar SPP
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasAddSpp" aria-controls="offcanvasEnd">
                <span>
                    <i class="bx bx-plus me-1"></i>
                    <span class="d-none d-lg-inline-block">
                        Tambah SPP Baru
                    </span>
                </span>
            </button>
        </h5>
        <div class="card-body">
            <x-table :headers="$headers" :data="$data" :delete="'spp.destroy'" :offcanvasId="'offcanvasAddSpp'" />
        </div>
    </div>

    <x-offcanvas :title="'Tambah SPP'" :id="'offcanvasAddSpp'">
        <form action="{{ route('spp.store') }}" class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework"
            id="sppForm" method="POST">
            @csrf
            @field([
                'label' => 'Tahun Ajaran',
                'name' => 'year',
                'placeholder' => 'tahun',
                'type' => 'year',
            ])
            @field([
                'label' => 'Nominal',
                'name' => 'amount',
                'placeholder' => 'Nominal SPP',
                'type' => 'number',
            ])

            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </x-offcanvas>


    @push('addon-js')
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.min.js') }}"></script>
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('./themes/assets/vendor/libs/select2/select2.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');
                    let edit = "{{ route('spp.edit', ':id') }}";
                    edit = edit.replace(':id', id);
                    let update = "{{ route('spp.update', ':id') }}";
                    update = update.replace(':id', id);
                    // console.log(edit);
                    $.ajax({
                        url: edit,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            $('#sppForm').append('@method('PUT')');
                            $('#year').val(data.year);
                            $('#amount').val(data.amount);
                            $('#sppForm').attr('action', update);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                $('#offcanvasAddSpp').on('hidden.bs.offcanvas', function() {
                    let store = "{{ route('spp.store') }}";
                    if (!$(this).hasClass('show')) {
                        $('#sppForm')[0].reset();
                        $('#sppForm').attr('action', store);
                        $('#sppForm > input[name="_method"]').remove();
                    }
                });
            });
        </script>
    @endpush
@endsection
