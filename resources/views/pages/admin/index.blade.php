@extends('layouts.dash')

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('themes/assets/vendor/libs/select2/select2.css') }}">
    @endpush
    @include('partials.cards', [
        'admin' => $counts['admin'],
        'operator' => $counts['operator'],
        'class' => $counts['class'],
    ])
    <div class="row">
        <div class="card">
            <div class="card-header header-elements p-3 my-n1">
                <h5 class="card-title mb-0 pl-0 pl-sm-2 p-2">Statistik Pembayaran SPP</h5>

                <div class="card-action-element ms-auto py-0">
                    <form action="{{ route('admin') }}" method="GET" class="d-flex justify-content-end">
                        @csrf
                        <div class="row g-2 mb-3">
                            <div class="col-md-8">
                                @field([
                                    'name' => 'filterByYear',
                                    'placeholder' => 'Tahun',
                                    'type' => 'year',
                                ])
                            </div>
                            <div class="col-md-1 text-lg-left text-sm-right">
                                <button type="submit" class="btn btn-primary">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="d-flex col-">
                        <form action="{{ route('admin') }}" method="GET">
                            @field([
                                'name' => 'filterByYear',
                                'placeholder' => 'Tahun Pembayaran',
                                'type' => 'year',
                            ])
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div> --}}
                    {{-- <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle p-0" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="bx bx-calendar"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                    Today
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                    Yesterday
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-item">
                                    @field([
                                        'label' => 'Tahun',
                                        'name' => 'filterByYear',
                                        'type' => 'select',
                                        'options' => '<option value="">Choose</option>',
                                    ])
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <div id="horizontalBarChart"></div>
            </div>
        </div>
    </div>
    @push('addon-js')
        {{-- <script
            src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/sortablejs/sortable.js">
        </script>
        <script>
            const cardEl = document.getElementById('sortable-cards');
            Sortable.create(cardEl);
        </script> --}}
        {{-- <script>
            // ambil data payments dari controller
            const payments = {!! json_encode($payments) !!};

            // konversi data payments menjadi array bulan dan array total
            const months = Object.keys(payments);
            const totals = Object.values(payments);

            // konfigurasi chart
            const horizontalBarChartEl = document.querySelector('#horizontalBarChart');
            horizontalBarChartEl = {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Total Pembayaran SPP',
                        data: totals,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // inisialisasi chart
            const paymentChart = new Chart(document.getElementById('paymentChart'), chartConfig);
        </script> --}}
        <script>
            let cardColor, headingColor, axisColor, shadeColor, borderColor, labelColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            labelColor = config.colors.labelColor;

            // ambil data payments dari controller
            const payments = {!! json_encode($payments) !!};

            // konversi data payments menjadi array bulan dan array total
            const months = Object.keys(payments);
            const totals = Object.values(payments);

            const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
                horizontalBarChartConfig = {
                    chart: {
                        height: 400,
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            barHeight: '30%',
                            startingShape: 'rounded',
                            borderRadius: 8
                        }
                    },
                    grid: {
                        borderColor: borderColor,
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        padding: {
                            top: -20,
                            bottom: -12
                        }
                    },
                    colors: config.colors.primary,
                    dataLabels: {
                        enabled: false
                    },
                    series: [{
                        data: totals
                    }],
                    xaxis: {
                        categories: months,
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '13px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '13px'
                            }
                        }
                    }
                };
            if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
                const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
                horizontalBarChart.render();
            }
        </script>
    @endpush
@endsection
