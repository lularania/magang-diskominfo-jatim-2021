@extends('layouts.app')

@section('title', 'Profile')

@section('header')
    <div class="col-sm-6">
        <h1>Profile</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Profile</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update', Auth::user()->id) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ Auth::user()->nama }}" readonly>
                            <div class="invalid-feedback">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="id_employee" value="{{ Auth::user()->id_employee }}" />
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" readonly>
                            <div class="invalid-feedback">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ Auth::user()->password }}">
                            <div class="invalid-feedback">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <a href="/" class="btn btn-dark btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-dark btn-sm">Update Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
