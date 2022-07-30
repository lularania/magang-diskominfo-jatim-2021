<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KategoriPermohonan extends Model
{
    use HasFactory;

    protected $table = 'kategori_permohonans';
    protected $primaryKey = 'id';
    protected $fillable = ['kategori'];

    public function allData()
    {
        return DB::table('kategori_permohonans')->get();
    }

    public function detailData($id)
    {
        return $this->allData()
            ->where('id', $id)
            ->first();
    }

    public function addData($data)
    {
        return DB::table('kategori_permohonans')->insert($data);
    }

    public function updateData($id, $data)
    {
        return DB::table('kategori_permohonans')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        return DB::table('kategori_permohonans')
            ->where('id', $id)
            ->delete();
    }

    public function countKategori()
    {
        $data = DB::table('kategori_permohonans')->count();
        return $data;
    }

    public function countKategori2($kategori_id)
    {
        return PermohonanModel::where('id_kategori', [$kategori_id])->whereNotIn('id_status', [1])->count();
    }
}