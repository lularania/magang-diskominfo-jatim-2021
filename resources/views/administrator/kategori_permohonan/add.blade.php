@extends('layouts.app')

@section('title', 'Tambah Kategori Permohonan')

@section('header')
    <div class="col-sm-6">
        <h1>Tambah Kategori Permohonan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/permohonan/kategori">Kategori Permohonan</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Tambah Kategori Permohonan</b></h3>
        </div>
        <div class="card-body">
            <form action="/admin/permohonan/kategori/insert" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori') }}">
                            <div class="invalid-feedback">
                                @error('kategori')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <a href="/admin/permohonan/kategori" class="btn btn-dark btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
