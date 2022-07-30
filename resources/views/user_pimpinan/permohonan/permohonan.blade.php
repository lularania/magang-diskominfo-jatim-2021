@extends('layouts.app')

@section('title', 'Permohonan')

@section('header')
    <div class="col-sm-4">
        <h1>Data Permohonan</h1>
    </div>
    <div class="col-sm-4">
        <form action="/pimpinan/permohonan" method="get">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Judul Permohonan">
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
            <li class="breadcrumb-item"><a href="{{ route('pimpinan') }}">Home</a></li>
            <li class="breadcrumb-item active">Permohonan</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Data Permohonan</b></h3>
        </div>
        <div class="card-body">
            <a href="{{ route('pimpinan.permohonan.add') }}" class="btn btn-dark btn-sm mb-3">Add</a>
            <a class="btn btn-primary btn-sm mb-3 float-right" href="{{ route('permohonan.export') }}">Export to Excel</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 175px;">Instansi</th>
                        <th style="width: 175px;">Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($permohonans as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->instansi }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td><span class="badge badge-{{ $colors[($item->id_status - 1) % count($colors)] }}">{{ $item->status }}</span></td>
                            <td>
                                @if (substr($item->berkas, -3) == 'pdf')
                                    <a href="{{ route('pimpinan.permohonan.view', $item->id) }}" target="__blank" style="color: #d0261f;">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                @else
                                    <img style="width: 150px;" src="{{ url('storage/' . $item->berkas) }}" alt="" title="">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pimpinan.permohonan.detail', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
