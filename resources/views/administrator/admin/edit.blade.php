@extends('layouts.app')

@section('title', 'Edit User Administrator')

@section('header')
    <div class="col-sm-6">
        <h1>Edit User Administrator</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/user/admin">User Administrator</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Edit User Administrator</b></h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.admin.update', $admin->id) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>ID Pegawai</label>
                            <input name="id_employee" class="form-control @error('id_employee') is-invalid @enderror" value="{{ $admin->id_employee }}" readonly>
                            <div class="invalid-feedback">
                                @error('id_employee')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $admin->employee->nama }}">
                            <div class="invalid-feedback">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="id_role" value="{{ $roles->id }}" />
                        <input type="hidden" name="role" value="{{ $roles->name }}" />
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ $admin->employee->jabatan }}">
                            <div class="invalid-feedback">
                                @error('jabatan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $admin->employee->user->email }}">
                            <div class="invalid-feedback">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ $admin->employee->user->password }}">
                            <div class="invalid-feedback">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <a href="{{ route('admin.user.admin') }}" class="btn btn-dark btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
