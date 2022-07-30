@extends('layouts.app')

@section('title', 'Admin')

@section('header')
    <div class="col-sm-6">
        <h1>Dashboard</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="/admin">Home</a></li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> <b>Akumulasi Data</b></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $employee }}</h3>
                                    <p>User Pegawai</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="/admin/employee" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $admin }}</h3>
                                    <p>User Admin</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="/admin/user/admin" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $opd }}</h3>
                                    <p>User Admin OPD</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/admin/user/adminopd" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $pimpinan }}</h3>
                                    <p>User Pimpinan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="/admin/user/pimpinan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $teknisi }}</h3>
                                    <p>User Teknisi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="/admin/user/teknisi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $permohonan }}</h3>
                                    <p>Permohonan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="/admin/permohonan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.card-body -->
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title m-0"><b>Grafik Bulanan {{ Carbon\Carbon::now()->year }}</b></h5>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="permohonan"></div>
            </div>
            <div class="col-md-6">
                <div id="newHosting"></div>
            </div>
        </div>
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
                <div id="security"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var axisAll = @json($axisAllPermohonan);
            var jumlahAll = @json($jumlahAllPermohonan);
            var axis1 = @json($axis1);
            var jumlah1 = @json($jumlah1);
            var axis2 = @json($axis2);
            var jumlah2 = @json($jumlah2);
            var axis3 = @json($axis3);
            var jumlah3 = @json($jumlah3);
            var axis4 = @json($axis4);
            var jumlah4 = @json($jumlah4);
            var axis5 = @json($axis5);
            var jumlah5 = @json($jumlah5);

            const chart0 = Highcharts.chart('permohonan', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Permohonan Per Bulan'
                },
                xAxis: {
                    categories: axisAll
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
                    name: 'Permohonan',
                    marker: {
                        symbol: 'square'
                    },
                    data: jumlahAll
                }]
            });

            const chart1 = Highcharts.chart('newHosting', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Permohonan Hosting Baru'
                },
                xAxis: {
                    categories: axis1
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
                    name: 'Hosting Baru',
                    marker: {
                        symbol: 'square'
                    },
                    data: jumlah1
                }]
            });

            const chart2 = Highcharts.chart('newDomain', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Permohonan Domain Baru'
                },
                xAxis: {
                    categories: axis2
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
                    name: 'Domain Baru',
                    marker: {
                        symbol: 'square'
                    },
                    data: jumlah2
                }]
            });

            const chart3 = Highcharts.chart('revDomain', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Revisi Nama Domain'
                },
                xAxis: {
                    categories: axis3
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
                    name: 'Revisi Nama Domain',
                    marker: {
                        symbol: 'square'
                    },
                    data: jumlah3
                }]
            });

            const chart4 = Highcharts.chart('addStorage', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Tambah Storage'
                },
                xAxis: {
                    categories: axis4
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
                    name: 'Tambah Storage',
                    marker: {
                        symbol: 'square'
                    },
                    data: jumlah4
                }]
            });

            const chart5 = Highcharts.chart('security', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Aduan Insiden Keamanan'
                },
                xAxis: {
                    categories: axis5
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
                    name: 'Aduan Insiden Keamanan',
                    marker: {
                        symbol: 'square'
                    },
                    data: jumlah5
                }]
            });
        });
    </script>
@endsection
