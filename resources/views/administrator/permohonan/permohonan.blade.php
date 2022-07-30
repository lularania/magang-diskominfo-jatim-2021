@extends('layouts.app')

@section('title', 'Permohonan')

@section('header')
    <div class="col-sm-4">
        <h1>Data Permohonan</h1>
    </div>
    <div class="col-sm-4">
        <form action="/admin/permohonan" method="get">
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
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active">Data Permohonan</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> <b>Akumulasi Data Permohonan</b></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $permohonans2 }}</h3>
                                    <p>Permohonan Diajukan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="" class="small-box-footer"></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $permohonans3 }}</h3>
                                    <p>Permohonan Disetujui</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="" class="small-box-footer"></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $permohonans4 }}</h3>
                                    <p>Permohonan Dikerjakan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="" class="small-box-footer"></a>
                            </div>
                        </div>
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $permohonans5 }}</h3>
                                    <p>Permohonan Selesai</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="" class="small-box-footer"></a>
                            </div>
                        </div>
                        <div class="col-lg col">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $permohonans6 }}</h3>
                                    <p>Permohonan Ditolak</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="" class="small-box-footer"></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> <b>Data Permohonan</b></h3>
        </div>
        <div class="card-body">
            <a href="/admin/permohonan/add" class="btn btn-dark btn-sm mb-3">Add</a>
            <a class="btn btn-primary btn-sm mb-3 float-right" href="{{ route('permohonan.export') }}">Export to Excel</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 175px;">Instansi</th>
                        <th style="width: 175px;">Judul</th>
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
                            <td>{{ $item->instansi }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>
                                <input type="hidden" class="permohonan_id" name="permohonan_id" value="{{ $item->id }}" id="data{{ $item->id }}" />
                                @if ($item->id_status == 6)
                                    <select class="form-control form-control-sm black select-status" name="id_status" id="id_status{{ $item->id }}" style="width: fit-content;">
                                        @foreach ($opsi_status as $status)
                                            <option value="{{ $status->id }}" {{ $item->id_status == $status->id ? 'selected' : '' }}>{{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control form-control-sm black select-status" name="id_status" id="id_status{{ $item->id }}" style="width: fit-content;">
                                        @foreach ($opsi_status as $status)
                                            @if ($status->id != 6)
                                                <option value="{{ $status->id }}" {{ $item->id_status == $status->id ? 'selected' : '' }}>{{ $status->status }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </td>
                            <td>
                                @if (substr($item->berkas, -3) == 'pdf')
                                    <a href="/admin/permohonan/view/{{ $item->id }}" target="__blank" style="color: #d0261f;">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                @else
                                    <img style="width: 150px;" src="{{ url('storage/' . $item->berkas) }}" alt="" title="">
                                @endif
                            </td>
                            <td>
                                <a href="/admin/permohonan/detail/{{ $item->id }}" class="btn btn-sm btn-primary">Detail</a>
                                <a href="/admin/permohonan/edit/{{ $item->id }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $item->id }}">Delete</button>
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
                        <h4 class="modal-title">Hapus Permohonan "{{ $data->instansi }}"</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                        <a href="/admin/permohonan/delete/{{ $data->id }}" class="btn btn-sm btn-danger">Hapus</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-status").change(function() {
                $.ajax({
                    type: 'GET',
                    url: "/admin/permohonan/status",
                    data: {
                        'id_permohonan': $(this).siblings('input.permohonan_id').val(),
                        'id_status': $(this).val()
                    },
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire('Sukses', response.message, "success");
                        }
                    },
                });
            })
        });
    </script>
@endsection
