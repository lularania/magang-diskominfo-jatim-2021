@extends('layouts.app')

@section('title', 'Detail User Pimpinan')

@section('header')
    <div class="col-sm-6">
        <h1>Detail User Pimpinan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active"><a href="/admin/user/pimpinan">User Pimpinan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Detail User Pimpinan</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table">
                        <tr>
                            <th width="150px" style="border: none">ID Pimpinan</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $pimpinan->id }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="border: none">ID Pegawai</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $pimpinan->id_employee }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="border: none">Nama</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $pimpinan->employee->nama }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="border: none">Jabatan</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $pimpinan->employee->jabatan }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="border: none">Email</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $pimpinan->employee->user->email }}</th>
                        </tr>
                    </table>
                </div>
                <table class="table">
                    <tr>
                        <th style="border: none">
                            <a href="{{ route('admin.user.pimpinan') }}" class="btn btn-dark">Kembali</a>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
