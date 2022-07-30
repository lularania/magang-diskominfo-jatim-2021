<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermohonanModel extends Model
{
    use HasFactory;

    public $table = 'permohonans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_adminOPD',
        'id_kategori',
        'id_status',
        'instansi',
        'judul',
        'deskripsi',
        'berkas',
        'created_by',
        'updated_by',
    ];

    public function allData()
    {
        return DB::table('permohonans')
            ->leftJoin('admin_opds', 'admin_opds.id', '=', 'permohonans.id_adminOPD')
            ->leftJoin('kategori_permohonans', 'kategori_permohonans.id', '=', 'permohonans.id_kategori')
            ->leftJoin('statuses', 'statuses.id', '=', 'permohonans.id_status')
            ->select(
                'permohonans.*',
                'admin_opds.id_user',
                'admin_opds.nama',
                'kategori_permohonans.kategori',
                'statuses.status'
            );
    }

    public function detailData($id)
    {
        return DB::table('permohonans')
            ->leftJoin('admin_opds', 'admin_opds.id', '=', 'permohonans.id_adminOPD')
            ->leftJoin('kategori_permohonans', 'kategori_permohonans.id', '=', 'permohonans.id_kategori')
            ->leftJoin('statuses', 'statuses.id', '=', 'permohonans.id_status')
            ->select('permohonans.*', 'kategori_permohonans.kategori', 'statuses.status')
            ->where('permohonans.id', $id)->first();
    }

    public function addData($data)
    {
        return DB::table('permohonans')->insert($data);
    }

    public function editData($id, $data)
    {
        return DB::table('permohonans')
            ->where('permohonans.id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        return DB::table('permohonans')
            ->where('id', $id)
            ->delete();
    }

    public function countPermohonan()
    {
        return PermohonanModel::whereNotIn('id_status', [1])->count();
    }

    public function countPermohonanByStatus($status_id)
    {
        return PermohonanModel::where('id_status', [$status_id])->count();
    }

    public function countPermohonanAdminOpd($status_id)
    {
        return $this->allData()->get()
            ->where('instansi', AdminOPD::where('id_user', Auth::user()->id)->first()->instansi)
            ->where('id_status', $status_id)
            ->count();
    }

    public function getAllGrafik()
    {
        return
            PermohonanModel::whereYear('created_at', Carbon::now()->year)
            ->whereNotIn('id_status', [1])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(
                function ($date) {
                    return Carbon::parse($date->created_at)
                        ->format('M');
                }
            );
    }

    public function getAllGrafikOPD()
    {
        return
            PermohonanModel::whereYear('created_at', Carbon::now()->year)
            ->whereNotIn('id_status', [1])
            ->where('instansi', AdminOPD::where('id_user', Auth::user()->id)->first()->instansi)
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(
                function ($date) {
                    return Carbon::parse($date->created_at)
                        ->format('M');
                }
            );
    }

    public function getDataGrafik($kategori_id)
    {
        return
            PermohonanModel::whereYear('created_at', Carbon::now()->year)
            ->whereNotIn('id_status', [1])
            ->where('id_kategori', $kategori_id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(
                function ($date) {
                    return Carbon::parse($date->created_at)
                        ->format('M');
                }
            );
    }

    public function getDataGrafikOPD($kategori_id)
    {
        return
            PermohonanModel::whereYear('created_at', Carbon::now()->year)
            ->whereNotIn('id_status', [1])
            ->where('id_kategori', $kategori_id)
            ->where('instansi', AdminOPD::where('id_user', Auth::user()->id)->first()->instansi)
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(
                function ($date) {
                    return Carbon::parse($date->created_at)
                        ->format('M');
                }
            );
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'id_permohonan');
    }
}