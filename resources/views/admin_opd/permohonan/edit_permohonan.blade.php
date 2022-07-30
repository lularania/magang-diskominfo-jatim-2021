@extends('layouts.app')

@section('title', 'Edit Permohonan')

@section('header')
    <div class="col-sm-6">
        <h1>Edit Permohonan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('adminOpd') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminOpd.permohonan') }}">Permohonan</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Edit Permohonan</b></h3>
        </div>
        <div class="card-body">
            <form action="/adminOpd/permohonan/update/{{ $permohonan->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama Instansi</label>
                            <input name="instansi" class="form-control @error('instansi') is-invalid @enderror" value="{{ $permohonan->instansi }}" readonly>
                            <div class="invalid-feedback">
                                @error('instansi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Judul Permohonan</label>
                            <input name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ $permohonan->judul }}">
                            <div class="invalid-feedback">
                                @error('judul')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Opsional">{{ $permohonan->deskripsi }}</textarea>
                            <div class="invalid-feedback">
                                @error('deskripsi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kategori Permohonan</label>
                            <select class="form-control" name="id_kategori">
                                <option value="{{ $permohonan->id_kategori }}">{{ $kategori->kategori }}</option>
                                @foreach ($opsi_kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File Permohonan</label>
                            <div class="input-image" style="display: flex">
                                <img style="width: 200px; margin-right: 15px" src="{{ url('storage/' . $permohonan->berkas) }}" alt="" title="">
                                <input type="file" name="berkas" class="form-control @error('berkas') is-invalid @enderror" value="{{ old('berkas') }}">
                                <div class="invalid-feedback">
                                    @error('berkas')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <a href="{{ route('adminOpd.permohonan') }}" class="btn btn-dark btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
