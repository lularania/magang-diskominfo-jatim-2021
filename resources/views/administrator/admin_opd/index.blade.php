@extends('layouts.app')

@section('title', 'User Admin OPD')

@section('header')
    <div class="col-sm-6">
        <h1>User Admin OPD</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active">User Admin OPD</li>
        </ol>
    </div>
@endsection

@section('content')
    {{-- {{ dd($adminOpd) }} --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Data User Admin OPD</b></h3>
        </div>
        <div class="card-body">
            <a href="/admin/user/adminopd/add" class="btn btn-dark btn-sm mb-3">Add</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($adminOpd as $data)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->instansi }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                <a href="/admin/user/adminopd/detail/{{ $data->id }}" class="btn btn-sm btn-primary">Detail</a>
                                <a href="/admin/user/adminopd/edit/{{ $data->id }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    @foreach ($adminOpd as $data)
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
                        <a href="/admin/user/adminopd/delete/{{ $data->id }}" class="btn btn-sm btn-danger">Hapus</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection
