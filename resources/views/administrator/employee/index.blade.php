@extends('layouts.app')

@section('title', 'Pegawai')

@section('header')
    <div class="col-sm-4">
        <h1>Data Pegawai</h1>
    </div>
    <div class="col-sm-4">
        <form action="/admin/employee" method="get">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Nama Pegawai">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active">Data Pegawai</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> <b>Akumulasi Data Pegawai</b></h3>

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
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $role1 }}</h3>
                                    <p>Total Pimpinan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="" class="small-box-footer"></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $role2 }}</h3>
                                    <p>Total Teknisi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="" class="small-box-footer"></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $role3 }}</h3>
                                    <p>Total Admin</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="" class="small-box-footer"></a>
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
            <h3 class="card-title"><b>Data Pegawai</b></h3>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.employee.add') }}" class="btn btn-dark btn-sm mb-3">Add</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($employee as $key => $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ Str::of($item->user->role->name)->title() }}</td>
                            <td>
                                <a href="{{ route('admin.employee.detail', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                <a href="{{ route('admin.employee.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $item->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    @foreach ($employee as $data)
        <div class="modal fade" id="delete{{ $data->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Data "{{ $data->nama }}"</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                        <a href="{{ route('admin.employee.delete', $data->id) }}" class="btn btn-sm btn-danger">Hapus</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection
