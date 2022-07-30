<?php

namespace App\Http\Controllers\user_pimpinan;

use App\Http\Controllers\Controller;
use App\Models\AdminOpd;
use App\Models\Employee;
use App\Models\History;
use App\Models\KategoriPermohonan;
use App\Models\PermohonanModel;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $this->adminopd = new AdminOpd();
        $this->histories = new History();
    }

    public function index(Request $request)
    {
        $colors = [
            'primary', 'warning', 'success', 'warning', 'success', 'danger',
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
            'permohonans' => $permohonans,
            'colors' => $colors,
            'opsi_status' => Status::all(),
        ];

        return view('/user_pimpinan/permohonan/permohonan', $data);
    }

    public function add()
    {
        $data = [
            'kategori' => $this->kategori->allData(),
            'instansi' => DB::table('instansis')->get(),
            'status' => Status::all()->whereNotIn('id', [1, 6]),
        ];

        return view('/user_pimpinan/permohonan/input_permohonan', $data);
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

        return redirect('/pimpinan/permohonan');
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
            'berkas' => Storage::url('public/' . $this->permohonans->detailData($id)->berkas),
            'tolak' => History::where('id_permohonan', $id)->whereNotNull('alasan')->orderBy('id', 'desc')->first(),
            'histories' => $histories,
            'dateHistories' => array_keys($histories->all()),
            'profile' => $profile,
        ];

        return view('/user_pimpinan/permohonan/detail', $data);
    }

    public function approve($id)
    {
        $permohonan = PermohonanModel::findOrFail($id);

        if ($permohonan->id_status == 2) {
            $data = [
                'id_status' => 3,
                'updated_by' => Employee::where('id_user', Auth::user()->id)->first()->id,
            ];

            $update = $permohonan->update($data);
            $history = History::create([
                'id_permohonan' => $permohonan->id,
                'id_employee' => Employee::where('id_user', Auth::user()->id)->first()->id,
                'id_status' => 3,
            ]);
        } else {
            abort(404);
        }

        if ($history && $update) {
            Alert::success('Sukses!', 'Permohonan Berhasil disetujui!');
        }

        return redirect()->back();
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