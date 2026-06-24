<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Karir;
use App\Models\Admin\Kategori;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    public function index()
    {
        $data = Karir::with('kategori')->get();
        return view('admin.karir.index', compact('data'));
    }

    public function create()
    {
        $kategori = Kategori::getAll('karir');
        return view('admin.karir.form_karir_create', $data = [
            'kategori' => $kategori
        ]);
    }

    public function edit($id) 
    {
        $karir = Karir::with(['kategori'])->where('id', $id)->get();
        $kategori = Kategori::getAll('karir');
        return view('admin.karir.form_karir_edit', $data = [
            'karir' => $karir,
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $karir = new Karir();
        $karir->posisi_kerja = $request->posisi;
        $karir->kategori_id = $request->kategori;
        $karir->pendidikan = $request->pendidikan;
        $karir->jurusan = $request->jurusan;
        $karir->pengalaman = $request->pengalaman;
        $karir->bidang_pengalaman = $request->bidang_pengalaman;
        $karir->kriteria = $request->kriteria;
        $karir->deadline = $request->deadline;
        $karir->informasi = $request->informasi;

        $store = $karir->save();

        if ($store) {
            return redirect()->route('karir.admin')
                ->with([
                    'success' => true, 
                    'message' => 'Data berhasil ditambahkan'
                ]);
        } else {
            return redirect()->route('karir.admin')
                ->with([
                    'success' => false,
                    'message' => 'Data gagal ditambahkan'
                ]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id_karir;
        $karir = Karir::find($id);
        $karir->posisi_kerja = $request->posisi;
        $karir->kategori_id = $request->kategori;
        $karir->pendidikan = $request->pendidikan;
        $karir->jurusan = $request->jurusan;
        $karir->pengalaman = $request->pengalaman;
        $karir->bidang_pengalaman = $request->bidang_pengalaman;
        $karir->kriteria = $request->kriteria;
        $karir->deadline = $request->deadline;
        $karir->informasi = $request->informasi;
        $karir->save();

        return redirect()->route('karir.admin')
                ->with([
                    'success' => true, 
                    'message' => 'Data berhasil diubah!'
                ]);
    }

    public function destroy($id)
    {
        $karir = Karir::find($id);
        $delete = $karir->delete();

        if ($delete) {
            return redirect()->route('karir.admin')
                ->with([
                    'success' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
        } else {
            return redirect()->route('karir.admin')
                ->with([
                    'success' => false,
                    'message' => 'Data gagal dihapus'
                ]);
        }
    }

    public function getAllData(Request $request)
    {
        $karir = Karir::with('kategori');
        // dd($karir);
        // check has request
        $pendidikanFilter = [];
        if ($request->pendidikan != null) {
            foreach ($request->pendidikan as $pendidikan) {
                $pendidikanFilter[] = $pendidikan;
            }
        }

        // dd($request->pendidikan);
        if ($request->kategori != null) {
            $karir = Karir::with('kategori')
                ->where('kategori_id', $request->kategori);
        }

        if ($request->pendidikan != null) {
            $karir->whereIn('pendidikan', $pendidikanFilter);
        }

        $karir = $karir->get();
        return response()->json($karir);
    }
}
