<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class AdminOpd extends Model
{
    use HasFactory;

    public $table = 'admin_opds';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user',
        'nama',
        'instansi',
        'created_by',
        'updated_by',
    ];

    public function getData()
    {
        return DB::table('admin_opds')
            ->join('users', 'users.id', '=', 'admin_opds.id_user')
            ->join('roles', 'roles.id', '=', 'users.id_role')
            ->select('admin_opds.*', 'users.email', 'users.id_role', 'users.password', 'roles.name')
            ->get();
    }

    public function detailData($id)
    {
        return $this->getData()
            ->where('id', $id)
            ->first();
    }

    public function addData($data)
    {
        return DB::table('admin_opds')->insert($data);
    }

    public function allData()
    {
        return DB::table('admin_opds')->get();
    }

    public function countAdminOPD()
    {
        $data = DB::table('admin_opds')->count();
        return $data;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // public function adminOpd()
    // {
    //     return $this->belongsTo(PermohonanModel::class, 'id_adminOPD');
    // }
}