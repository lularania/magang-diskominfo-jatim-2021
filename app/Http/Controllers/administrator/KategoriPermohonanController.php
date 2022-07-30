<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\KategoriPermohonan;
use App\Models\PermohonanModel;

class KategoriPermohonanController extends Controller
{
    public function __construct()
    {
        $this->kategori = new KategoriPermohonan();
    }

    public function index()
    {
        $data = [
            'kategori' => $this->kategori->allData(),
            'kategoriall' => $this->kategori->countKategori(),
            'kategori1' => $this->kategori->countKategori2(1),
            'kategori2' => $this->kategori->countKategori2(2),
            'kategori3' => $this->kategori->countKategori2(3),
            'kategori4' => $this->kategori->countKategori2(4),
            'kategori5' => $this->kategori->countKategori2(5),
        ];
        return view('administrator.kategori_permohonan.index', $data);
    }

    public function add()
    {
        return view('administrator.kategori_permohonan.add');
    }

    public function show($id)
    {
        if (!$this->kategori->detailData($id)) {
            abort(404);
        }

        $data = [
            'kategori' => $this->kategori->detailData($id),
        ];

        return view('administrator.kategori_permohonan.detail', $data);
    }

    public function insert()
    {
        Request()->validate(
            [
                'kategori' => 'required'
            ],
            [
                'kategori.required' => 'wajib diisi!'
            ]
        );

        $data = [
            'kategori' => Request()->kategori
        ];
        if ($this->kategori->addData($data)) {
            Alert::success('Sukses!', 'Data berhasil ditambahkan!');
        }
        return redirect('/admin/permohonan/kategori');
    }

    public function edit($id)
    {
        $kategori = KategoriPermohonan::findOrFail($id);

        $data = [
            'kategori' => $kategori,
        ];
        return view('administrator.kategori_permohonan.edit', $data);
    }

    public function update($id)
    {
        Request()->validate(
            [
                'kategori' => 'required'
            ],
            [
                'kategori.required' => 'wajib diisi!'
            ]
        );

        $data = [
            'kategori' => Request()->kategori
        ];
        $kategori = $this->kategori->updateData($id, $data);
        if ($kategori) {
            Alert::success('Sukses!', 'Data berhasil diupdate!');
        }
        return redirect('/admin/permohonan/kategori');
    }

    public function destroy($id)
    {
        if ($this->kategori->deleteData($id)) {
            Alert::success('Sukses!', 'Data berhasil dihapus!');
        }
        return redirect('/admin/permohonan/kategori');
    }
}