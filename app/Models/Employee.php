<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    public $table = 'employees';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user',
        'nama',
        'jabatan',
        'instansi',
    ];

    public function addData($data)
    {
        return DB::table('employees')->insert($data);
    }

    public function allData()
    {
        return DB::table('employees')->get();
    }

    public function detailData($id)
    {
        return $this->allData()
            ->where('id', $id)
            ->first();
    }

    public function updateData($id, $data)
    {
        DB::table('employees')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('employees')
            ->where('id', $id)
            ->delete();
    }

    public function countEmployee()
    {
        $data = DB::table('employees')->count();
        return $data;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pimpinan()
    {
        return $this->hasOne(UserPimpinan::class, 'id_employee');
    }

    public function teknisi()
    {
        return $this->hasOne(UserTeknisi::class, 'id_employee');
    }

    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'id_employee');
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'id_permohonan');
    }

    public function countRole($id)
    {
        return User::where('id_role', [$id])->count();
    }
}