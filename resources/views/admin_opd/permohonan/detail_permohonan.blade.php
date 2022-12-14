@extends('layouts.app')

@section('title', 'Detail Permohonan')

@section('header')
    <div class="col-sm-6">
        <h1>Detail Permohonan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('adminOpd') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminOpd.permohonan') }}">Permohonan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Detail Permohonan</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table table-alasan">
                        <tr>
                            <th width="200px" style="border: none">Nama Instansi</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $permohonans->instansi }}</th>
                        </tr>
                        <tr>
                            <th width="200px" style="border: none">Judul Permohonan</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $permohonans->judul }}</th>
                        </tr>
                        <tr>
                            <th width="200px" style="border: none">Kategori Permohonan</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $permohonans->kategori }}</th>
                        </tr>
                        <tr>
                            <th width="200px" style="border: none">Status Permohonan</th>
                            <th width="30px" style="border: none">:</th>
                            <th style="border: none">{{ $permohonans->status }}</th>
                        </tr>
                        @if ($permohonans->id_status == 6 && $tolak != null)
                            <tr>
                                <th width="200px" style="border: none" class="alasan-label">Alasan Penolakan</th>
                                <th width="30px" style="border: none" class="alasan-label">:</th>
                            </tr>
                        @endif
                    </table>
                    @if ($permohonans->id_status == 6 && $tolak != null)
                        <table>
                            <tr>
                                <th class="alasan">
                                    <textarea class="form-control input-disabled" rows="5" cols="0" placeholder="{{ $tolak->alasan }}" value="{{ $tolak->alasan }}" disabled=""></textarea>
                                </th>
                            </tr>
                        </table>
                    @endif
                </div>
                <div class="col-6">
                    <table>
                        @if ($permohonans->berkas)
                            <tr>
                                <th width="150px" style="border: none; padding-bottom: 10px;">File Permohonan</th>
                                <th width="15px" style="border: none; padding-bottom: 10px;">:</th>
                            </tr>
                            <tr style="display: flex;">
                                <th style="border: none; width: 10vw;">
                                    <a href="{{ route('adminOpd.permohonan.view', $permohonans->id) }}" target="__blank" class="btn btn-block btn-info btn-sm btn-icon">
                                        <span>Lihat File</span>
                                        <i class="far fa-eye"></i>
                                    </a>
                                </th>
                                <th style="border: none; width: 10vw;">
                                    <a href="{{ route('adminOpd.permohonan.download', $permohonans->id) }}" class="btn btn-block btn-info btn-sm btn-icon">
                                        <span>Unduh File</span>
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                </th>
                                @if (substr($permohonans->berkas, -3) == 'pdf')
                                    <th style="border: none; width: 10vw;">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-block btn-info btn-sm show-modal-permohonan btn-icon" data-toggle="modal" data-target="#previewPermohonanModal">
                                            <span>Preview PDF</span>
                                        </button>
                                        <!-- /.Button trigger modal -->
                                    </th>
                                @endif
                            </tr>
                        @endif
                        <tr>
                            <th width="200px" style="border: none; padding-top: 30px;">Deskripsi Permohonan</th>
                            <th width="15px" style="border: none; padding-top: 30px;">:</th>
                        </tr>
                    </table>
                    <textarea class="form-control input-disabled" rows="5" cols="0" placeholder="{{ $permohonans->deskripsi }}" value="{{ $permohonans->deskripsi }}" disabled=""></textarea>
                </div>
                <table class="table">
                    <tr>
                        <th style="border: none">
                            <a href="{{ route('adminOpd.permohonan') }}" class="btn btn-dark">Kembali</a>
                            <a href="/adminOpd/permohonan/edit/{{ $permohonans->id }}" class="btn btn-warning {{ $permohonans->id_status == '1' ? '' : 'disabled' }}">Edit</a>
                            <a href="{{ route('adminOpd.permohonan.send', $permohonans->id) }}" class="btn btn-outline-success {{ $permohonans->id_status == '1' ? '' : 'disabled' }}">Ajukan Permohonan</a>
                        </th>
                    </tr>
                </table>
            </div>

            @if ($permohonans->id_status != 1)
                <div class="row">
                    <div class="col-8">
                        <div class="container-fluid timeline-container card">
                            <div class="timeline-header card-header">
                                <strong>
                                    <h2 class="timeline-title card-title"><b>Tracking Status</b></h2>
                                </strong>
                            </div>
                            <!-- Timelime example  -->
                            <div class="timeline-row row">
                                <div class="col-md-12">
                                    <!-- The time line -->
                                    <div class="timeline">
                                        <div class="time-label">
                                            <span class="bg-warning">{{ Carbon\Carbon::parse($permohonans->created_at)->format('d F Y') }}</span>
                                        </div>

                                        <div>
                                            <i class="fas fa-user bg-red"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock mr-1"></i>{{ Carbon\Carbon::parse($permohonans->created_at)->format('h:i:s') }}</span>
                                                <h3 class="timeline-header no-border"><a class="mr-2">{{ $profile->instansi }}</a>Permohonan Diajukan</h3>
                                            </div>
                                        </div>

                                        @foreach ($histories as $key => $data)
                                            @if ($key == Carbon\Carbon::parse($permohonans->created_at)->format('d-F-Y'))
                                                @foreach ($data as $item)
                                                    <div>
                                                        <i class="fas fa-user bg-purple"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock mr-1"></i>{{ Carbon\Carbon::parse($item->updated_at)->format('h:i:s') }}</span>
                                                            <h3 class="timeline-header no-border"><a class="mr-2">{{ $item->instansi }}</a>Permohonan {{ $item->status }}</h3>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="time-label">
                                                    <span class="bg-green">{{ Carbon\Carbon::parse($data[0]->updated_at)->format('d F Y') }}</span>
                                                </div>
                                                @foreach ($data as $item)
                                                    <div>
                                                        <i class="fa fa-user bg-purple"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock mr-1"></i>{{ Carbon\Carbon::parse($item->updated_at)->format('h:i:s') }}</span>
                                                            <h3 class="timeline-header no-border"><a class="mr-2">{{ $item->instansi }}</a>Permohonan {{ $item->status }}</h3>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <div>
                                            <i class="fas fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
            @endif
        </div>
        <!-- /.card-body -->
    </div>

    <!-- Modal PDF -->
    <div class="modal fade" id="previewPermohonanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="height: 92vh;">
                <div class="modal-header modal-view-permohonan">
                    <h5 class="modal-title">{{ $permohonans->judul }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <!-- Preview PDF Container -->
                <div class="modal-body" id="view-permohonan"></div>
            </div>
        </div>
    </div>
    <!-- /.Modal PDF -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.show-modal-permohonan').on('click', function() {
                var path = '{{ $berkas }}';
                var a = PDFObject.embed(path, "#view-permohonan");
            });
        });
    </script>
@endsection
