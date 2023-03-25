@extends('layouts.dash')

@section('content')
    @include('partials.cards', [
        'admin' => $counts['admin'],
        'operator' => $counts['operator'],
        'class' => $counts['class'],
    ])
    <div class="row">
        <div class="card">
            <div class="card-header header-elements p-3 my-n1">
                <h5 class="card-title mb-0 pl-0 pl-sm-2 p-2">Transaction SPP Statistics</h5>
                <div class="card-action-element ms-auto py-0">
                    <div class="dropdown">
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
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                                    Days
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30
                                    Days
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current
                                    Month
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                    Last Month
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="horizontalBarChart"></div>
            </div>
        </div>
    </div>
    @push('addon-js')
        <script
            src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/sortablejs/sortable.js">
        </script>
        <script>
            const cardEl = document.getElementById('sortable-cards');
            Sortable.create(cardEl);
        </script>
        <script>
            let cardColor, headingColor, axisColor, shadeColor, borderColor, labelColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            labelColor = config.colors.labelColor;
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
                        data: [700, 350, 480, 600, 210, 550, 150]
                    }],
                    xaxis: {
                        categories: ['MON, 11', 'THU, 14', 'FRI, 15', 'MON, 18', 'WED, 20', 'FRI, 21', 'MON, 23'],
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
