@extends('layouts.app')

@section('title', 'Contoh')

@section('header')
    <div class="col-sm-6">
        <h1>Contoh Halaman Dashboard</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Contoh Dashboard</li>
        </ol>
    </div>
@endsection

@section('content')
    <div id="newHosting" style="border: 0.5px solid gray"></div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div id="newDomain"></div>
        </div>
        <div class="col-md-6">
            <div id="revDomain"></div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div id="addStorage"></div>
        </div>
        <div class="col-md-6">
            <div id="Security"></div>
        </div>
    </div>

@endsection

@section('chart')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    {{-- 1. Hosting Baru --}}
    <script>
        Highcharts.chart('newHosting', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Permohonan Hosting Baru'

            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                title: {
                    text: 'Jumlah Permohonan'
                },
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: '',
                marker: {
                    symbol: 'square'
                },
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]

            }]
        });
    </script>

    {{-- 2. Domain Baru --}}
    <script>
        Highcharts.chart('newDomain', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Permohonan Domain Baru'

            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                title: {
                    text: 'Jumlah Permohonan'
                },
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: '',
                marker: {
                    symbol: 'square'
                },
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]

            }]
        });
    </script>

    {{-- 3. Tambah Storage --}}
    <script>
        Highcharts.chart('addStorage', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Tambah Storage'

            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                title: {
                    text: 'Jumlah Permohonan'
                },
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: '',
                marker: {
                    symbol: 'square'
                },
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]

            }]
        });
    </script>

    {{-- 4. Revisi Nama Domain --}}
    <script>
        Highcharts.chart('revDomain', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Revisi Nama Domain'

            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                title: {
                    text: 'Jumlah Permohonan'
                },
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: '',
                marker: {
                    symbol: 'square'
                },
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]

            }]
        });
    </script>

    {{-- 5. Permintaan Insiden Keamanan --}}
    <script>
        Highcharts.chart('Security', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Aduan Insiden Keamanan'

            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                title: {
                    text: 'Jumlah Permohonan'
                },
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: '',
                marker: {
                    symbol: 'square'
                },
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]

            }]
        });
    </script>
@endsection
