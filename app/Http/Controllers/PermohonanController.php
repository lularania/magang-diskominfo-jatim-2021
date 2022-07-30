<?php

namespace App\Http\Controllers;

use App\Exports\PermohonanExport;
use Maatwebsite\Excel\Facades\Excel;

class PermohonanController extends Controller
{
    public function export(PermohonanExport $export)
    {
        return Excel::download($export, 'permohonan.xlsx');
    }
}