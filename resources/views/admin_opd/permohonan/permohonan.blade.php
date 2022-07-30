@extends('layouts.app')

@section('title', 'Permohonan')

@section('header')
    <div class="col-sm-4">
        <h1>Data Permohonan</h1>
    </div>
    <div class="col-sm-4">
        <form action="{{ route('adminOpd.permohonan') }}" method="get">
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
            <li class="breadcrumb-item"><a href="{{ route('adminOpd') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Permohonan</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Data Permohonan</b></h3>
        </div>
        <div class="card-body">
            <a href="/adminOpd/permohonan/add" class="btn btn-dark btn-sm mb-3">Add</a>
            <a class="btn btn-primary btn-sm mb-3 float-right" href="{{ route('permohonan.export') }}">Export to Excel</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
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
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td><span class="badge badge-{{ $colors[($item->id_status - 1) % count($colors)] }}">{{ $item->status }}</span></td>
                            <td>
                                @if (substr($item->berkas, -3) == 'pdf')
                                    <a href="{{ route('adminOpd.permohonan.view', $item->id) }}" target="__blank" style="color: #d0261f;">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                @else
                                    <img style="width: 150px;" src="{{ url('storage/' . $item->berkas) }}" alt="" title="">
                                @endif
                            </td>
                            <td>
                                <a href="/adminOpd/permohonan/detail/{{ $item->id }}" class="btn btn-sm btn-primary">Detail</a>
                                <a href="/adminOpd/permohonan/edit/{{ $item->id }}" class="btn btn-sm btn-warning {{ $item->id_status == '1' ? '' : 'disabled' }}">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger {{ $item->id_status == '1' ? '' : 'disabled' }}" data-toggle="modal" data-target="{{ $item->id_status == '1' ? '#delete' . $item->id : '' }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    @foreach ($permohonans as $data)
        <div class="modal fade" id="delete{{ $data->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Permohonan | {{ $data->instansi }}"</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                        <a href="/adminOpd/permohonan/delete/{{ $data->id }}" class="btn btn-sm btn-danger">Hapus</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection
