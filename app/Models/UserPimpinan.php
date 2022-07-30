<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserPimpinan extends Model
{
    use HasFactory;

    public $table = 'user_pimpinans';
    protected $primaryKey = 'id';
    protected $fillable = ['id_user', 'id_employee', 'created_by', 'updated_by'];

    public function getData()
    {
        return DB::table('user_pimpinans')
            ->leftJoin('employees', 'user_pimpinans.id_employee', '=', 'employees.id')
            ->leftJoin('users', 'employees.id_user', '=', 'users.id')
            ->select('user_pimpinans.*', 'employees.nama', 'employees.jabatan', 'users.email', 'users.password', 'users.id_role')
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
        DB::table('user_pimpinans')->insert($data);
    }

    public function updateData($id, $data)
    {
        DB::table('user_pimpinans')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('user_pimpinans')
            ->where('id', $id)
            ->delete();
    }

    public function countPimpinan()
    {
        $data = DB::table('user_pimpinans')->count();
        return $data;
    }

    public function totalPermohonan()
    { 
        $data = DB::table('permohonans')->count();
        return $data;
    } 

    public function totalDiajukan()
    {
        $data = DB::table('permohonans')
        ->leftJoin('statuses', 'statuses.id', '=', 'permohonans.id_status')
        ->where('permohonans.id_status', 1)->count();
        return $data;
    }

    public function totalDikerjakan()
    {
        $data = DB::table('permohonans')
        ->leftJoin('statuses', 'statuses.id', '=', 'permohonans.id_status')
        ->where('permohonans.id_status', 3)->count();
        return $data;
    }

    public function dataBulanan(){
        $data = DB::table('permohonans')
        ->whereMonth('created_at', Carbon::now()->month)
        ->count();

        return $data;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }
}