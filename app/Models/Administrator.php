<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Administrator extends Model
{
    use HasFactory;

    public $table = 'administrators';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_employee',
        'created_by',
        'updated_by',
    ];

    public function getData()
    {
        return DB::table('administrators')
            ->leftJoin('employees', 'administrators.id_employee', '=', 'employees.id')
            ->leftJoin('users', 'employees.id_user', '=', 'users.id')
            ->select('administrators.*', 'employees.nama', 'employees.jabatan', 'users.email', 'users.password', 'users.id_role')
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
        return DB::table('administrators')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('administrators')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('administrators')
            ->where('id', $id)
            ->delete();
    }

    public function countAdmin()
    {
        $data = DB::table('administrators')->count();
        return $data;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }
}