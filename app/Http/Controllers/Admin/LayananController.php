<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananMedis;
use App\Models\LayananUnggulan;
use Illuminate\Http\Request;
use DataTables;

class LayananController extends Controller
{
    public function index()
    {
        return view('admin.layanan.index');
    }

    public function create()
    {
        return view('admin.layanan.form-add-layanan');
    }

    public function store(Request $request)
    {
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'layanan_'.time().'.'.$extension;
            $file->move(upload_path('files/gambar_layanan/'), $file_name);
        } else {
            $file_name = null;
        }

        $layanan = new LayananUnggulan();
        $layanan->layanan = $request->layanan;
        $layanan->gambar = $file_name;
        $layanan->konten = $request->konten;
        $layanan->save();

        return redirect('layanan')->with([
            'success' => true,
            'message' => 'Data layanan berhasil ditambahkan!'
        ]);
    }

    public function edit($id)
    {
        $layanan = LayananUnggulan::find($id);
        return view('admin.layanan.form-edit-layanan', [
            'layanan' => $layanan
        ]);
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananUnggulan::find($id);

        if($request->hasFile('gambar')) {
            // hapus file lama jika ada
            if (!empty($layanan->gambar)) {
                $uploadPath = upload_path('files/gambar_layanan/');
                $file = $uploadPath . $layanan->gambar;

                if (file_exists($file) && is_file($file)) {
                    @unlink($file);
                }
            }

            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'layanan_'.time().'.'.$extension;
            $file->move(upload_path('files/gambar_layanan/'), $file_name);
        } else {
            $file_name = $layanan->gambar;
        }

        LayananUnggulan::where('id', $id)
            ->update([
                'layanan' => $request->layanan,
                'gambar' => $file_name,
                'konten' => $request->konten
            ]);

        return redirect('layanan')->with([
            'success' => true,
            'message' => 'Data layanan berhasil diubah!'
        ]);
    }

    public function delete(Request $request)
    {
        $layanan = LayananUnggulan::find($request->id);

        if ($layanan) {
            $uploadPath = upload_path('files/gambar_layanan/');

            if (!empty($layanan->gambar)) {
                $file = $uploadPath . $layanan->gambar;

                if (file_exists($file) && is_file($file)) {
                    @unlink($file);
                }
            }

            $layanan->delete();
        }

        return redirect('layanan')->with([
            'success' => true,
            'message' => 'Data layanan berhasil dihapus!'
        ]);
    }

    public function getLayanan()
    {
        $layanan = LayananUnggulan::all();
        $count = LayananUnggulan::count();
        print json_encode([
            "data" => $layanan,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
        ]);
    }

    public function listLayananMedis()
    {
        $data = LayananMedis::all();
        return view('admin.layanan-medis.index', [
            'data' => $data
        ]);
    }

    public function createLayananMedis()
    {
        return view('admin.layanan-medis.form-create-layanan-medis');
    }

    public function storeLayananMedis(Request $request)
    {
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'layanan_medis_'.time().'.'.$extension;
            $file->move(upload_path('files/gambar_layanan_medis/'), $file_name);
        } else {
            $file_name = null;
        }

        $slug = str_replace(' ', '-', strtolower($request->judul));
        
        $data = new LayananMedis();
        // $data->slug = $slug;
        $data->judul = $request->judul;
        $data->image = $file_name;
        $data->konten = $request->konten;
        $data->save();

        return redirect()->route('listLayananMedis')->with([
            'success' => true,
            'message' => 'Data layanan medis berhasil ditambahkan!'
        ]);
    }

    public function getDataLayananMedis()
    {
        $data = LayananMedis::all();
        return DataTables::of($data)->make(true);
    }

    public function deleteLayananMedis(Request $request)
    {
        $data = LayananMedis::find($request->id);

        if ($data) {

            $uploadPath = upload_path('files/gambar_layanan_medis/');

            if (!empty($data->image)) {
                $file = $uploadPath . $data->image;

                if (file_exists($file) && is_file($file)) {
                    @unlink($file);
                }
            }

            $data->delete();
        }

        return redirect()->route('listLayananMedis')->with([
            'success' => true,
            'message' => 'Data layanan medis berhasil dihapus!'
        ]);
    }

    public function editLayananMedis($id)
    {
        $data = LayananMedis::find($id);
        return view('admin.layanan-medis.form-edit-layanan-medis', [
            'data' => $data
        ]);
    }

    public function updateLayananMedis(Request $request, $id)
    {
        $data = LayananMedis::find($id);

        if($request->hasFile('gambar')) {
            // hapus file lama jika ada
            if (!empty($data->image)) {
                $uploadPath = upload_path('files/gambar_layanan_medis/');
                $file = $uploadPath . $data->image;

                if (file_exists($file) && is_file($file)) {
                    @unlink($file);
                }
            }

            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'layanan_medis_'.time().'.'.$extension;
            $file->move(upload_path('files/gambar_layanan_medis/'), $file_name);
        } else {
            $file_name = $data->image;
        }

        $slug = str_replace(' ', '-', strtolower($request->judul));

        LayananMedis::where('id', $id)
            ->update([
                // 'slug' => $slug,
                'judul' => $request->judul,
                'image' => $file_name,
                'konten' => $request->konten
            ]);

        return redirect()->route('listLayananMedis')->with([
            'success' => true,
            'message' => 'Data layanan medis berhasil diubah!'
        ]);
    }

    public function layananMedis($slug)
    {
        $data = LayananMedis::where('id', $slug)->first();
        $all_layanan = LayananMedis::all();
        return view('compro.layanan-medis', [
            'data' => $data,
            'all_layanan' => $all_layanan
        ]);
    }
}
