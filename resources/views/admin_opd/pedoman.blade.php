@extends('layouts.app')

@section('title', 'Pedoman Penggunaan')

@section('header')
    <div class="col-sm-6">
        <h1>Pedoman Penggunaan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/adminOpd">Home</a></li>
            <li class="breadcrumb-item active">Pedoman Penggunaan</li>
        </ol>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title m-0"><b>Alur Cara Mengajukan Permohonan</b></h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
        <div class="card-body">
            <div class="image">
                    <img src="{{ asset('assets/img/alur-1.png') }}" width="515px" alt="alur-1.png">
                    <img src="{{ asset('assets/img/alur-2.png') }}" width="515px" alt="alur-2.png">
            </div>
        </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title m-0"><b>Alur Cara Melihat Permohonan</b></h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
        <div class="card-body">
            <div class="image">
                    <img src="{{ asset('assets/img/alur1.png') }}" width="515px" alt="alur1.png">
                    <img src="{{ asset('assets/img/alur2.png') }}" width="515px" alt="alur2.png">
            </div>
        </div>
</div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title m-0"><b>Skema Proses Pengajuan Permohonan</b></h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="image">
                <img src="{{ asset('assets/img/skema.png') }}" width="1050px" alt="skema.png">
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title m-0"><b>Informasi Penting</b></h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="image">
                <img src="{{ asset('assets/img/informasi.png') }}" width="1050px" alt="informasi.png">
            </div>
        </div>
    </div>
@endsection
