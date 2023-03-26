@extends('layouts.dash')

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/select2/select2.css') }}">
    @endpush
    <div class="card">
        <h5 class="card-header d-flex justify-content-between">
            Daftar Kelas
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasAddClass" aria-controls="offcanvasEnd">
                <span>
                    <i class="bx bx-plus me-1"></i>
                    <span class="d-none d-lg-inline-block">
                        Tambah Kelas Baru
                    </span>
                </span>
            </button>
        </h5>
        <div class="card-body">
            <x-table :headers="$headers" :data="$data" :delete="'class.destroy'" :offcanvasId="'offcanvasAddClass'" />
        </div>
    </div>

    <x-offcanvas :title="'Add Class'" :id="'offcanvasAddClass'">
        <form action="{{ route('class.store') }}" class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework"
            id="classForm" method="POST">
            @csrf
            @field([
                'label' => 'Kelas',
                'name' => 'name',
                'placeholder' => 'XII',
                'type' => 'text',
            ])
            @field([
                'label' => 'Jurusan',
                'name' => 'major_id',
                'type' => 'select',
                'options' => $majors->map(function ($major) {
                        return "<option value='$major->id'>$major->name</option>";
                    })->join(''),
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
                $('#major_id').select2({
                    dropdownParent: $('#offcanvasAddClass')
                });

                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');
                    let edit = "{{ route('class.edit', ':id') }}";
                    edit = edit.replace(':id', id);
                    let update = "{{ route('class.update', ':id') }}";
                    update = update.replace(':id', id);
                    // console.log(edit);
                    $.ajax({
                        url: edit,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            $('#classForm').append('@method('PUT')');
                            $('#name').val(data.name);
                            $('#major_id').val(data.major_id);
                            $('#classForm').attr('action', update);
                            $('#major_id').trigger('change');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                $('#offcanvasAddClass').on('hidden.bs.offcanvas', function() {
                    let store = "{{ route('class.store') }}";
                    if (!$(this).hasClass('show')) {
                        $('#classForm')[0].reset();
                        $('#classForm').attr('action', store);
                        $('#classForm > input[name="_method"]').remove();
                        $('#major_id').trigger('change');
                    }
                });
            });
        </script>
    @endpush
@endsection
