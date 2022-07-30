<?php

namespace App\Http\Controllers\administrator;

use App\Exports\PermohonanExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermohonanModel;
use App\Models\KategoriPermohonan;
use App\Models\AdminOPD;
use App\Models\Employee;
use App\Models\History;
use App\Models\Status;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PermohonanController extends Controller
{
    public function __construct()
    {
        $this->permohonans = new PermohonanModel();
        $this->kategori = new KategoriPermohonan();
        $this->adminopd = new AdminOPD();
        $this->histories = new History();
    }

    public function index(Request $request)
    {
        $colors = [
            'primary', 'danger', 'info', 'warning', 'success', 'danger',
        ];

        if ($request->has('search')) {
            $permohonans = $this->permohonans
                ->allData()
                ->where('judul', 'LIKE', '%' . $request->search . '%')
                ->whereNotIn('id_status', [1])
                ->get();
        } else {
            $permohonans = $this->permohonans
                ->allData()
                ->whereNotIn('id_status', [1])
                ->get();
        }

        $data = [
            'permohonans2' => $this->permohonans->countPermohonanByStatus(2),
            'permohonans3' => $this->permohonans->countPermohonanByStatus(3),
            'permohonans4' => $this->permohonans->countPermohonanByStatus(4),
            'permohonans5' => $this->permohonans->countPermohonanByStatus(5),
            'permohonans6' => $this->permohonans->countPermohonanByStatus(6),
            'permohonans' => $permohonans,
            'colors' => $colors,
            'opsi_status' => Status::all()->whereNotIn('id', [1]),
        ];

        return view('/administrator/permohonan/permohonan', $data);
    }

    public function add()
    {
        $data = [
            'kategori' => $this->kategori->allData(),
            'instansi' => DB::table('instansis')->get(),
            'status' => Status::all()->whereNotIn('id', [1, 6]),
        ];

        return view('/administrator/permohonan/input_permohonan', $data);
    }

    public function insert(Request $request)
    {
        $request->validate(
            [
                'instansi' => 'required',
                'id_kategori' => 'required',
                'judul' => 'required',
                'deskripsi' => 'max:1000',
                'berkas' => 'required|file|max:2048|mimes:jpeg,jpg,png,pdf',
            ],
            [
                'instansi.required' => 'Wajib terisi',
                'id_kategori.required' => 'Wajib terisi',
                'judul.required' => 'Wajib terisi',
                'deskripsi.max' => 'Anda telah mencapai kata-kata maksimum.',
                'berkas.required' => 'Mohon unggah berkas permohonan.',
                'berkas.max' => 'Ukuran maksimal 2 Mb.',
                'berkas.mimes' => 'Unggah file dalam format JPEG, JPG, PNG, dan PDF.',
            ]
        );

        $berkas = $request->berkas->store('files', 'public');

        $permohonan = PermohonanModel::create([
            'instansi' => Request()->instansi,
            'id_kategori' => Request()->id_kategori,
            'id_status' => Request()->id_status,
            'judul' => Request()->judul,
            'deskripsi' => Request()->deskripsi,
            'berkas' => $berkas,
            'created_by' => Employee::where('id_user', Auth::user()->id)->first()->id,
        ]);

        if ($permohonan) {
            Alert::success('Sukses!', 'Data Berhasil ditambahkan!');
        }

        return redirect('/admin/permohonan');
    }

    public function viewFile($id)
    {
        $permohonan = PermohonanModel::findOrFail($id);
        return response()->file(storage_path('app/public' . '/' . $permohonan->berkas));
    }

    public function generateFile($id)
    {
        $permohonan = PermohonanModel::findOrFail($id);
        return response()->download(storage_path('app/public' . '/' . $permohonan->berkas));
    }

    public function detail($id)
    {
        if ((!$this->permohonans->detailData($id)) || ($this->permohonans->detailData($id)->id_status == 1)) {
            abort(404);
        }

        $histories = $this->histories->getData($id)
            ->groupBy(function ($date) {
                return Carbon::parse($date->updated_at)
                    ->format('d-F-Y');
            });

        $permohonan = $this->permohonans->detailData($id);
        $profile = AdminOPD::where('id', $permohonan->id_adminOPD)->first();

        if (is_null($permohonan->id_adminOPD)) {
            $profile = Employee::where('id', $permohonan->created_by)->first();
        }

        $data = [
            'permohonans' => $this->permohonans->detailData($id),
            'histories' => $histories,
            'dateHistories' => array_keys($histories->all()),
            'profile' => $profile,
            'berkas' => Storage::url('public/' . $this->permohonans->detailData($id)->berkas),
            'tolak' => History::where('id_permohonan', $id)->whereNotNull('alasan')->orderBy('id', 'desc')->first()
        ];

        return view('/administrator/permohonan/detail_permohonan', $data);
    }

    public function edit($id)
    {
        if (!$this->permohonans->detailData($id)) {
            abort(404);
        }

        $permohonan = PermohonanModel::find($id);
        $opsi_kategori = DB::table('kategori_permohonans')
            ->whereNotIn('id', [$permohonan->id_kategori])
            ->get();
        $currentStatus = Status::where('id', $permohonan->id_status)->first();
        $opsi_status = DB::table('statuses')
            ->whereNotIn('id', [$permohonan->id_status, 1, 6])
            ->get();

        $data = [
            'permohonan' => $permohonan,
            'kategori' => DB::table('kategori_permohonans')->where('id', $permohonan->id_kategori)->first(),
            'opsi_kategori' => $opsi_kategori->all(),
            'opsi_instansi' => DB::table('instansis')->whereNotIn('instansi', [$permohonan->instansi])->get(),
            'status' => $currentStatus,
            'opsi_status' => $opsi_status,
        ];

        return view('/administrator.permohonan.edit_permohonan', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate(
            [
                'instansi' => 'required',
                'id_kategori' => 'required',
                'judul' => 'required',
                'deskripsi' => 'max:1000',
                'berkas' => 'file|max:2048|mimes:jpeg,jpg,png,pdf',                                      // ! TODO : PDF
            ],
            [
                'instansi.required' => 'wajib terisi',
                'id_kategori.required' => 'wajib terisi',
                'judul.required' => 'wajib terisi',
                'berkas.max' => 'Ukuran maksimal 2 Mb.',
                'berkas.mimes' => 'Unggah file dalam format JPEG, JPG, PNG, dan PDF.',
                'deskripsi.max' => 'Anda telah mencapai kata-kata maksimum.',
            ]
        );

        $permohonan = PermohonanModel::find($id);
        $file = PermohonanModel::where('id', $id)->first()->berkas;

        if ($request->hasFile('berkas')) {
            if ($permohonan->berkas != null) {
                $oldfilepath = storage_path('app/public' . '/' . $file);
                unlink($oldfilepath);
            }
            $berkas = $request->berkas->store('files', 'public');
        } else {
            $berkas = $file;
        }

        if ($permohonan->id_status != ((int)$request->id_status)) {
            $history = History::create([
                'id_permohonan' => $id,
                'id_employee' => Employee::where('id_user', Auth::user()->id)->first()->id,
                'id_status' => $request->id_status,
            ]);
        }

        $data = [
            'instansi' => Request()->instansi,
            'id_kategori' => Request()->id_kategori,
            'id_status' => $request->id_status,
            'judul' => Request()->judul,
            'deskripsi' => Request()->deskripsi,
            'berkas' => $berkas,
            'updated_by' => Employee::where('id_user', Auth::user()->id)->first()->id,
        ];

        $permohonan = PermohonanModel::where('id', $id)->update($data);

        if ($permohonan) {
            Alert::success('Sukses!', 'Data Berhasil diubah!');
        }

        return redirect('/admin/permohonan');
    }

    public function destroy($id)
    {
        $permohonan = PermohonanModel::findOrFail($id);

        $history = DB::table('histories')
            ->where('id_permohonan', $id)
            ->delete();

        $filename = $permohonan->berkas;

        if ($filename) {
            $file = storage_path('app/public' . '/' . $filename);
            unlink($file);
        }

        $permohonan = $this->permohonans->deleteData($id);

        if ($history && $permohonan) {
            Alert::success('Sukses!', 'Data Berhasil dihapus!');
        }
        return redirect('/admin/permohonan');
    }

    public function updateStatus(Request $request)
    {
        $permohonan = PermohonanModel::findOrFail($request->id_permohonan);

        if ($permohonan->id_status != ((int)$request->id_status)) {
            $permohonan->id_status = $request->id_status;
            $permohonan->updated_by = Employee::where('id_user', Auth::user()->id)->first()->id;
            $alasan = null;
            if ($request->has('alasan')) {
                $request->validate(
                    [
                        'alasan' => 'required',
                    ],
                    [
                        'alasan.required' => 'Mohon isi alasan penolakan.',
                    ]
                );
                $alasan = $request->alasan;
            }
            $history = History::create([
                'id_permohonan' => $request->id_permohonan,
                'id_employee' => Employee::where('id_user', Auth::user()->id)->first()->id,
                'id_status' => $request->id_status,
                'alasan' => $alasan,
            ]);
        }

        if ($history && $permohonan->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Status permohonan berhasil diubah!',
            ]);
        }
    }
}