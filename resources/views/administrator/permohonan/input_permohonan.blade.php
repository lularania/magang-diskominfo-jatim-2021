@extends('layouts.app')

@section('title', 'Tambah Permohonan')

@section('header')
    <div class="col-sm-6">
        <h1>Tambah Permohonan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/permohonan">Data Permohonan</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Tambah Permohonan</b></h3>
        </div>
        <div class="card-body">
            <form action="/admin/permohonan/insert" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama Instansi</label>
                            <select class="form-control" name="instansi">
                                <option>Nama Instansi</option>
                                @foreach ($instansi as $item)
                                    <option value="{{ $item->instansi }}">{{ $item->instansi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori Permohonan</label>
                            <select class="form-control" name="id_kategori">
                                <option>Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul Permohonan</label>
                            <input name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Masukkan Judul">
                            <div class="invalid-feedback">
                                @error('judul')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Pengajuan Permohonan</label>
                            <select class="form-control" name="id_status">
                                <option>Pilih Status Pengajuan</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->id }}">{{ $item->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Opsional" value="{{ old('deskripsi') }}"></textarea>
                            <div class="invalid-feedback">
                                @error('deskripsi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label>Berkas Permohonan</label> <br>
                            <input type="file" name="berkas" class="form-control @error('berkas') is-invalid @enderror">
                            <div class="invalid-feedback">
                                @error('berkas')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <a href="/admin/permohonan" class="btn btn-dark btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
