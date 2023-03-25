@extends('layouts.dash')

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('./themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.css') }}">
    @endpush
    <div class="card">
        <h5 class="card-header d-flex justify-content-between">
            List Class
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasAddOperator" aria-controls="offcanvasEnd">
                <span>
                    <i class="bx bx-plus me-1"></i>
                    <span class="d-none d-lg-inline-block">
                        Add New Class
                    </span>
                </span>
            </button>
        </h5>
        <div class="card-body">
            <x-table :headers="$headers" :data="$data" :delete="'class.destroy'" :offcanvasId="'offcanvasAddClass'" />
        </div>
    </div>
    @push('addon-js')
        {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.min.js') }}"></script>
        <script src="{{ asset('themes/assets/vendor/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>
        {{-- <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> --}}
        <script>
            $('#myTable').DataTable();
            // $(function() {
            //     $("#myTable").DataTable({
            //         dom: '<"card-header"<"head-label text-center"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            //         displayLength: 7,
            //         lengthMenu: [7, 10, 25, 50, 75, 100],
            //         buttons: [{
            //                 extend: 'collection',
            //                 className: 'btn btn-label-primary dropdown-toggle me-2',
            //                 text: '<i class="bx bx-show me-1"></i>Export',
            //                 buttons: [{
            //                         extend: 'print',
            //                         text: '<i class="bx bx-printer me-1" ></i>Print',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     },
            //                     {
            //                         extend: 'csv',
            //                         text: '<i class="bx bx-file me-1" ></i>Csv',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     },
            //                     {
            //                         extend: 'excel',
            //                         text: 'Excel',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     },
            //                     {
            //                         extend: 'pdf',
            //                         text: '<i class="bx bxs-file-pdf me-1"></i>Pdf',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     },
            //                     {
            //                         extend: 'copy',
            //                         text: '<i class="bx bx-copy me-1" ></i>Copy',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     }
            //                 ]
            //             },
            //             {
            //                 text: '<i class="bx bx-plus me-1"></i> <span class="d-none d-lg-inline-block">Add New Record</span>',
            //                 className: 'create-new btn btn-primary'
            //             }
            //         ],
            //     });
            // });
        </script>
    @endpush
@endsection
