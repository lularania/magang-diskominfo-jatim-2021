<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserTeknisi extends Model
{
    use HasFactory;

    public $table = 'user_teknisis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 'id_employee', 'created_by', 'updated_by',
    ];

    public function addData($data)
    {
        return DB::table('user_teknisis')->insert($data);
    }

    public function getData()
    {
        return DB::table('user_teknisis')
            ->leftJoin('employees', 'user_teknisis.id_employee', '=', 'employees.id')
            ->leftJoin('users', 'employees.id_user', '=', 'users.id')
            ->select('user_teknisis.*', 'employees.nama', 'employees.jabatan', 'users.email', 'users.password', 'users.id_role')
            ->get();
    }

    public function detailData($id)
    {
        return $this->getData()
            ->where('id', $id)
            ->first();
    }

    public function updateData($id, $data)
    {
        DB::table('user_teknisis')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('user_teknisis')
            ->where('id', $id)
            ->delete();
    }

    public function countTeknisi()
    {
        $data = DB::table('user_teknisis')->count();
        return $data;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }
}