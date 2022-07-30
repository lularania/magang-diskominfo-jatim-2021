<?php

namespace App\Http\Controllers\admin_opd;

use App\Http\Controllers\Controller;
use App\Models\PermohonanModel;
use App\Models\KategoriPermohonan;
use App\Models\AdminOPD;
use App\Models\Employee;
use App\Models\History;
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
        $this->adminopd = new AdminOPD();
        $this->histories = new History();
    }

    public function index(Request $request)
    {
        $colors = [
            'primary', 'danger', 'info', 'warning', 'success', 'danger'
        ];

        if ($request->has('search')) {
            $permohonan = $this->permohonans
                ->allData()
                ->where('judul', 'LIKE', '%' . $request->search . '%')
                ->get()
                ->where(
                    'instansi',
                    AdminOPD::where('id_user', Auth::user()->id)->first()->instansi
                );
        } else {
            $permohonan = $this->permohonans
                ->allData()
                ->get()
                ->where(
                    'instansi',
                    AdminOPD::where('id_user', Auth::user()->id)->first()->instansi
                );
        }

        $data = [
            'permohonans' => $permohonan,
            'colors' => $colors
        ];

        return view('/admin_opd/permohonan/permohonan', $data);
    }

    public function add()
    {
        $instansi = DB::table('permohonans')
            ->select('instansi')
            ->distinct()
            ->get();

        $data = [
            'kategori' => $this->kategori->allData(),
            'instansi' => $instansi,
        ];

        return view('/admin_opd/permohonan/input_permohonan', $data);
    }

    public function insert(Request $request)
    {
        $request->validate(
            [
                'id_kategori' => 'required',
                'judul' => 'required',
                'berkas' => 'required|file|max:2048|mimes:jpeg,jpg,png,pdf',                            // ! TODO : PDF
                'deskripsi' => 'max:1000',
            ],
            [
                'id_kategori.required' => 'Wajib terisi',
                'judul.required' => 'Wajib terisi',
                'berkas.required' => 'Mohon unggah berkas permohonan.',
                'berkas.max' => 'Ukuran maksimal 2 Mb.',
                'berkas.mimes' => 'Unggah file dalam format JPEG, JPG, PNG, dan PDF.',
                'deskripsi.max' => 'Anda telah mencapai kata-kata maksimum.',
            ]
        );

        $instansi = AdminOPD::where('id_user', Auth::user()->id)->first()->instansi;
        $berkas = $request->berkas->store('files', 'public');

        $permohonan = PermohonanModel::create([
            'id_adminOPD' => AdminOPD::where('id_user', Auth::user()->id)->first()->id,
            'id_kategori' => Request()->id_kategori,
            'id_status' => 1,
            'judul' => Request()->judul,
            'deskripsi' => Request()->deskripsi,
            'instansi' => $instansi,
            'berkas' => $berkas,
        ]);

        if ($permohonan) {
            Alert::success('Sukses!', 'Data Berhasil ditambahkan!');
        }

        return redirect('/adminOpd/permohonan');
    }

    public function detail($id)
    {
        if (!$this->permohonans->detailData($id)) {
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

        return view('/admin_opd/permohonan/detail_permohonan', $data);
    }

    public function edit($id)
    {
        $permohonan = $this->permohonans->detailData($id);
        if ((!$permohonan) || ($permohonan->id_status != 1)) {
            abort(404);
        }

        $instansi = DB::table('permohonans')
            ->select('instansi')
            ->distinct()
            ->get();

        $permohonan = PermohonanModel::find($id);
        $opsi_kategori = DB::table('kategori_permohonans')
            ->whereNotIn('id', [$permohonan->id_kategori])
            ->get();

        $data = [
            'permohonan' => $permohonan,
            'kategori' => DB::table('kategori_permohonans')->where('id', $permohonan->id_kategori)->first(),
            'opsi_kategori' => $opsi_kategori->all(),
            'instansi' => $instansi->all(),
        ];

        return view('/admin_opd.permohonan.edit_permohonan', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate(
            [
                'id_kategori' => 'required',
                'judul' => 'required',
                'berkas' => 'file|max:2048|mimes:jpeg,jpg,png,pdf',                                      // ! TODO : PDF
                'deskripsi' => 'max:1000',
            ],
            [
                'id_kategori.required' => 'wajib terisi',
                'judul.required' => 'wajib terisi',
                'berkas.max' => 'Ukuran maksimal 2 Mb.',
                'berkas.mimes' => 'Unggah file dalam format JPEG, JPG, PNG, dan PDF.',                   // ! TODO : PDF
                'deskripsi.max' => 'Anda telah mencapai kata-kata maksimum.',
            ]
        );

        $file = PermohonanModel::where('id', $id)->first()->berkas;

        if ($request->hasFile('berkas')) {
            if ($file != null) {
                $oldfilepath = storage_path('app/public' . '/' . $file);
                unlink($oldfilepath);
            }
            $berkas = $request->berkas->store('files', 'public');
        } else {
            $berkas = $file;
        }

        $data = [
            'id_adminOPD' => AdminOPD::where('id_user', Auth::user()->id)->first()->id,
            'id_kategori' => Request()->id_kategori,
            'id_status' => 1,
            'judul' => Request()->judul,
            'deskripsi' => Request()->deskripsi,
            'berkas' => $berkas,
        ];

        $permohonan = PermohonanModel::where('id', $id)->update($data);

        if ($permohonan) {
            Alert::success('Sukses!', 'Data Berhasil diubah!');
        }

        return redirect('/adminOpd/permohonan');
    }

    public function destroy($id)
    {
        if ((!PermohonanModel::where('id', $id)->first()) || (PermohonanModel::where('id', $id)->first()->id_status != 1)) {
            abort(404);
        }

        $history = DB::table('histories')
            ->where('id_permohonan', $id)
            ->delete();

        $filename = PermohonanModel::where('id', $id)->first()->berkas;

        if ($filename) {
            $file = storage_path('app/public' . '/' . $filename);
            unlink($file);
        }

        $permohonan = $this->permohonans->deleteData($id);

        if ($permohonan) {
            Alert::success('Sukses!', 'Data Berhasil dihapus!');
        }
        return redirect('adminOpd/permohonan');
    }

    public function apply($id)
    {
        $data = [
            'id_status' => 2,
            'created_at' => Carbon::now(),
        ];

        $permohonan = PermohonanModel::where('id', $id);
        if ($permohonan->first()->id_status == 1) {
            $update = $permohonan->update($data);
        } else {
            abort(404);
        }

        if ($update) {
            Alert::success('Sukses!', 'Permohonan Berhasil diajukan!');
        }

        return redirect()->back();
    }

    public function viewFile($id)
    {
        $permohonan = $this->permohonans->detailData($id);
        return response()->file(storage_path('app/public' . '/' . $permohonan->berkas));
    }

    public function generateFile($id)
    {
        $permohonan = $this->permohonans->detailData($id);
        return response()->download(storage_path('app/public' . '/' . $permohonan->berkas));
    }
}