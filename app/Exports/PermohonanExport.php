<?php

namespace App\Exports;

use App\Models\AdminOpd;
use App\Models\PermohonanModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

// class PermohonanExport implements FromCollection
class PermohonanExport implements FromView
{
    public function __construct()
    {
        $this->permohonan = new PermohonanModel();
    }

    public function view(): View
    {
        $permohonan = $this->permohonan
            ->allData()
            ->whereNotIn('id_status', [1])
            ->get();

        if (Auth::user()->id == 4) {
            $permohonan = $this->permohonan
                ->allData()
                ->get()
                ->where(
                    'instansi',
                    AdminOpd::where('id_user', Auth::user()->id)->first()->instansi
                );
        }

        $data = [
            'permohonans' => $permohonan,
        ];

        return view('/administrator/permohonan/report', $data);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection(Request $request)
    public function collection()
    {
        return $this->permohonan
            ->allData()
            ->whereNotIn('id_status', [1])
            ->get();
    }
}