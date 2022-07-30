<?php

namespace App\Http\Controllers\admin_opd;

use App\Http\Controllers\Controller;
use App\Models\KategoriPermohonan;
use App\Models\PermohonanModel;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->permohonan = new PermohonanModel();
    }

    public function index()
    {
        $i = 1;
        foreach (KategoriPermohonan::all()->toArray() as $data) {
            $grafik[$i] = $this->permohonan->getDataGrafikOPD($i);
            $i++;
        }

        $grafikAllPermohonan = $this->permohonan->getAllGrafikOPD();

        $data = [
            'permohonan1' => $this->permohonan->countPermohonanAdminOpd(1),
            'permohonan2' => $this->permohonan->countPermohonanAdminOpd(2),
            'permohonan3' => $this->permohonan->countPermohonanAdminOpd(3),
            'permohonan4' => $this->permohonan->countPermohonanAdminOpd(4),
            'permohonan5' => $this->permohonan->countPermohonanAdminOpd(5),
            'permohonan6' => $this->permohonan->countPermohonanAdminOpd(6),
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

        return view('admin_opd.dashboard', $data);
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

    public function pedoman() {
        return view('admin_opd.pedoman');
    }
}