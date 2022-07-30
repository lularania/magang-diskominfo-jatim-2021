@extends('layouts.app')

@section('title', 'Tambah Permohonan')

@section('header')
    <div class="col-sm-6">
        <h1>Tambah Permohonan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href={{ route('adminOpd') }}>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminOpd.permohonan') }}">Permohonan</a></li>
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
            <form action="/adminOpd/permohonan/insert" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
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
                            <input name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                            <div class="invalid-feedback">
                                @error('berkas')
                                    {{ $message }}
                                @enderror
                            </div>
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
                            <a href="{{ route('adminOpd.permohonan') }}" class="btn btn-dark btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-dark btn-sm">Simpan Draft</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
