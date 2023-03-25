@extends('layouts.dash')

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet"
            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/select2/select2.css">
    @endpush
    <div class="card">
        <h5 class="card-header d-flex justify-content-between">
            List Student
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasAddStudent" aria-controls="offcanvasEnd">
                <span>
                    <i class="bx bx-plus me-1"></i>
                    <span class="d-none d-lg-inline-block">
                        Add New Student
                    </span>
                </span>
            </button>
        </h5>
        <div class="card-body">
            <x-table :headers="$headers" :data="$data" :delete="'student.destroy'" :offcanvasId="'offcanvasAddStudent'" />
        </div>
    </div>

    <x-offcanvas :title="'Add Student'" :id="'offcanvasAddStudent'">
        <form action="{{ route('student.store') }}" class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework"
            id="studentForm" method="POST">
            @csrf
            <div class="divider text-start">
                <div class="divider-text">Account</div>
            </div>
            <input type="hidden" name="id">
            @field([
                'label' => 'Full Name',
                'name' => 'name',
                'placeholder' => 'John Doe',
                'type' => 'text',
            ])
            @field([
                'label' => 'Email',
                'name' => 'email',
                'placeholder' => 'john.doe@example.com',
                'type' => 'text',
            ])
            @field([
                'label' => 'Username',
                'name' => 'username',
                'placeholder' => 'john123',
                'type' => 'text',
            ])
            @field([
                'label' => 'Password',
                'name' => 'password',
                'placeholder' => 'password',
                'type' => 'password',
            ])
            <div class="divider text-start">
                <div class="divider-text">Student Data</div>
            </div>
            @field([
                'label' => 'NISN',
                'name' => 'nisn',
                'placeholder' => '0012456783',
                'type' => 'text',
            ])
            @field([
                'label' => 'NIS',
                'name' => 'nis',
                'placeholder' => '0067831245',
                'type' => 'text',
            ])
            @field([
                'label' => 'Class',
                'name' => 'std_class_id',
                'type' => 'select',
                'options' => $classes->map(function ($class) {
                        return "<option value='{$class->id}'>{$class->name} {$class->major->name}</option>";
                    })->join(''),
            ])
            {{-- <div class="mb-3 fv-plugins-icon-container"> --}}
            {{-- <label class="form-label" for="std_class">Class</label> --}}
            {{-- <select name="std_class" id="std_class" class="form-select"> --}}
            {{-- <option value="">Choose Class Student</option> --}}
            {{-- @foreach ($classes as $class) --}}
            {{-- <option value="{{ $class->id }}">{{ $class->name . ' ' . $class->major->name }}</option> --}}
            {{-- @endforeach --}}
            {{-- </select> --}}
            {{-- <div class="fv-plugins-message-container invalid-feedback"></div> --}}
            {{-- </div> --}}

            @field([
                'label' => 'Address',
                'name' => 'address',
                'placeholder' => 'address...',
                'type' => 'textarea',
            ])
            @field([
                'label' => 'Phone',
                'name' => 'phone',
                'placeholder' => '08568563',
                'type' => 'text',
            ])
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </x-offcanvas>
    @push('addon-js')
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.min.js') }}"></script>
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>
        <script
            src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/select2/select2.js">
        </script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
                $("#std_class").select2({
                    dropdownParent: $('#offcanvasAddStudent')
                });
                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');
                    let edit = "{{ route('student.edit', ':id') }}";
                    let update = "{{ route('student.update', ':id') }}";
                    edit = edit.replace(':id', id);
                    update = update.replace(':id', id);

                    $.ajax({
                        url: edit,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            console.log(data);
                            $('#id').val(data.id);
                            $('#name').val(data.name);
                            $('#email').val(data.email);
                            $('#username').val(data.username);
                            $('#nisn').val(data.student.nisn);
                            $('#nis').val(data.student.nis);
                            $('#std_class_id').val(data.student.std_class_id);
                            $('#address').val(data.student.address);
                            $('#phone').val(data.student.phone);
                            $('#studentForm').attr('action', update);
                            $('#studentForm').append('@method('PUT')');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                $('#offcanvasAddStudent').on('hidden.bs.offcanvas', function() {
                    let store = "{{ route('student.store') }}";
                    if (!$(this).hasClass('show')) {
                        $(this).find('form')[0].reset();
                        $('#studentForm').attr('action', store);
                        $('#studentForm').remove('@method('PUT')');

                    }
                });
            });
        </script>
    @endpush
@endsection
