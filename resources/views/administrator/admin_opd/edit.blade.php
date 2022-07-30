@extends('layouts.app')

@section('title', 'Edit User Admin OPD')

@section('header')
    <div class="col-sm-6">
        <h1>Edit User Admin OPD</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/user/adminopd">User Admin OPD</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Edit User Admin OPD</b></h3>
        </div>
        <div class="card-body">
            <form action="/admin/user/adminopd/update/{{ $adminOpd->id }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $adminOpd->nama }}">
                            <div class="invalid-feedback">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input name="instansi" class="form-control @error('instansi') is-invalid @enderror" value="{{ $adminOpd->instansi }}">
                            <div class="invalid-feedback">
                                @error('instansi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="id_role" value="{{ $roles->id }}" />
                        <input type="hidden" name="id_user" value="{{ $adminOpd->id_user }}" />
                        <input type="hidden" name="role" value="{{ $roles->name }}" />
                        <div class="form-group">
                            <label>Role</label>
                            <input name="admin_opd" class="form-control @error('admin_opd') is-invalid @enderror" value="Admin OPD" readonly>
                            <div class="invalid-feedback">
                                @error('admin_opd')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $adminOpd->user->email }}">
                            <div class="invalid-feedback">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ $adminOpd->user->password }}">
                            <div class="invalid-feedback">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <a href="/admin/user/adminopd" class="btn btn-dark btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
