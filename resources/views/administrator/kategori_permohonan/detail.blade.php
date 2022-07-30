@extends('layouts.app')

@section('title', 'Detail Kategori Permohonan')

@section('header')
    <div class="col-sm-6">
        <h1>Detail Kategori Permohonan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/permohonan/kategori">Kategori Permohonan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Detail Kategori Permohonan</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table">
                        <tr>
                            <th width="150px" style="border: none">ID Kategori</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $kategori->id }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="border: none">Kategori</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $kategori->kategori }}</th>
                        </tr>
                    </table>
                </div>
                <table class="table">
                    <tr>
                        <th style="border: none">
                            <a href="/admin/permohonan/kategori" class="btn btn-dark">Kembali</a>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
