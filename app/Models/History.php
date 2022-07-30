<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_permohonan',
        'id_employee',
        'id_status',
        'alasan',
    ];

    public function getData($id_permohonan)
    {
        return DB::table('histories')
            ->leftJoin('permohonans', 'histories.id_permohonan', '=', 'permohonans.id')
            ->leftJoin('employees', 'histories.id_employee', '=', 'employees.id')
            ->leftJoin('statuses', 'histories.id_status', '=', 'statuses.id')
            ->select('histories.*', 'statuses.status', 'employees.nama', 'employees.jabatan', 'employees.instansi')
            ->where('id_permohonan', $id_permohonan)
            ->get();
    }

    public function permohonan()
    {
        return $this->belongsTo(PermohonanModel::class, 'id_permohonan');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}