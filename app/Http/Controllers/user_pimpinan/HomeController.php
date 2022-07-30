<?php

namespace App\Http\Controllers\user_pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\AdminOpd;
use App\Models\Employee;
use App\Models\KategoriPermohonan;
use App\Models\PermohonanModel;
use App\Models\User;
use App\Models\UserPimpinan;
use App\Models\UserTeknisi;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
        $this->admin = new Administrator();
        $this->opd = new AdminOpd();
        $this->employee = new Employee();
        $this->permohonan = new PermohonanModel();
        $this->pimpinan = new UserPimpinan();
        $this->teknisi = new UserTeknisi();
    }

    public function index()
    {
        $i = 1;
        foreach (KategoriPermohonan::all()->toArray() as $data) {
            $grafik[$i] = $this->permohonan->getDataGrafik($i);
            $i++;
        }

        $grafikAllPermohonan = $this->permohonan->getAllGrafik();

        $data = [
            'permohonans2' => $this->permohonan->countPermohonanByStatus(2),
            'permohonans3' => $this->permohonan->countPermohonanByStatus(3),
            'permohonans4' => $this->permohonan->countPermohonanByStatus(4),
            'permohonans5' => $this->permohonan->countPermohonanByStatus(5),
            'permohonans6' => $this->permohonan->countPermohonanByStatus(6),
            'admin' => $this->admin->countAdmin(),
            'opd' => $this->opd->countAdminOPD(),
            'employee' => $this->employee->countEmployee(),
            'permohonan' => $this->permohonan->countPermohonan(),
            'pimpinan' => $this->pimpinan->countPimpinan(),
            'teknisi' => $this->teknisi->countTeknisi(),
            'axisAllPermohonan' => collect($grafikAllPermohonan)->keys()->all(),
            'jumlahAllPermohonan' => $this->countData($grafikAllPermohonan),
            'axis1' => collect($grafik[1])->keys()->all(),
            'jumlah1' => $this->countData($grafik[1]),
            'axis2' => collect($grafik[2])->keys()->all(),
            'jumlah2' => $this->countData($grafik[2]),
            'axis3' => collect($grafik[3])->keys()->all(),
            'jumlah3' => $this->countData($grafik[3]),
            'axis4' => collect($grafik[4])->keys()->all(),
            'jumlah4' => $this->countData($grafik[4]),
            'axis5' => collect($grafik[5])->keys()->all(),
            'jumlah5' => $this->countData($grafik[5]),
        ];
        return view('user_pimpinan.dashboard', $data);
    }

    public function countData($grafik)
    {
        $i = 0;
        if (!$grafik->isEmpty()) {
            foreach ($grafik as $key => $value) {
                $jumlah[$i] = $value->count();
                // $jumlah1[$key] = $value->count();
                $i++;
            }
        } else {
            $jumlah = [];
        }
        return $jumlah;
    }
}