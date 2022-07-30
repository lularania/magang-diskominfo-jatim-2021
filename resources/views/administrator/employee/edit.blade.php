@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('header')
    <div class="col-sm-6">
        <h1>Edit Pegawai</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/employee">Pegawai</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> <b>Edit Pegawai</b></h3>
        </div>
        <div class="card-body">
            <form action="/admin/employee/update/{{ $employee->id }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $employee->nama }}">
                            <div class="invalid-feedback">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ $employee->jabatan }}">
                            <div class="invalid-feedback">
                                @error('jabatan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="id_role">
                                <option value="{{ $employee->user->role->id }}">{{ Str::of($employee->user->role->name)->title() }}</option>
                                @foreach ($opsi_role as $item)
                                    <option value="{{ $item->id }}">{{ Str::of($item->name)->title() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <a href="/admin/employee" class="btn btn-dark btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
