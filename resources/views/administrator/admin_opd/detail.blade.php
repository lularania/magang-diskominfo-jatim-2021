@extends('layouts.app')

@section('title', 'Detail User Admin OPD')

@section('header')
    <div class="col-sm-6">
        <h1>Detail User Admin OPD</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/user/adminopd">User Admin OPD</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Detail User Admin OPD</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table">
                        <tr>
                            <th width="150px" style="border: none">ID Admin OPD</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $adminOpd->id }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="border: none">Nama</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $adminOpd->nama }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="border: none">Instansi</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $adminOpd->instansi }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="border: none">Email</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $adminOpd->user->email }}</th>
                        </tr>
                    </table>
                </div>
                <table class="table">
                    <tr>
                        <th style="border: none">
                            <a href="/admin/user/adminopd" class="btn btn-dark">Kembali</a>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
