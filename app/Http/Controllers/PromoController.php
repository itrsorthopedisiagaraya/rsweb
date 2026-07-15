<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function promotion($slug)
    {
        $data = Promo::where("slug", $slug)->first();
        $all_promotions = Promo::whereDate('deadline', '>=', now())->get();
        return view('compro.post.promotion', [
            'data'=> $data, 
            'all_promo' => $all_promotions
        ]);
    }
    public function list()
    {
        $promo = Promo::all();
        return view("admin.promotion.index", [
            'data' => $promo,
        ]);
    }

    public function create()
    {
        return view('admin.promotion.form_promo_create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'promo_'.time().'.'.$extension;
            $file->move(upload_path('files/gambar_promo/'), $file_name);
        } else {
            $file_name = null;
        }

        $promo = new Promo();
        $promo->judul = $request->promo;
        $promo->slug = $request->slug;
        $promo->gambar = $file_name;
        $promo->konten = $request->konten;
        $promo->deadline = $request->deadline;

        $store = $promo->save();

        if ($store) {
            return redirect()->route('listPromo')
                ->with([
                    'success' => true, 
                    'message' => 'Data berhasil ditambahkan'
                ]);
        } else {
            return redirect()->route('listPromo')
                ->with([
                    'success' => false,
                    'message' => 'Data gagal ditambahkan'
                ]);
        }
    }

    public function edit($id)
    {
        $data = Promo::find($id);
        return view('admin.promotion.form_promo_edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = Promo::find($id);
    
        $file_name = $data->gambar;
    
        if ($request->hasFile('gambar')) {
    
            $file = $request->file('gambar'); // FIX: samakan dengan store
            $extension = $file->getClientOriginalExtension();
            $file_name = 'promo_' . time() . '.' . $extension;
    
            $uploadPath = upload_path('files/gambar_promo/');
    
            // hapus file lama (SAFE CHECK)
            if ($data->gambar) {
                $oldPath = $uploadPath . $data->gambar;
    
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
    
            // upload baru
            $file->move($uploadPath, $file_name);
        }
    
        $data->judul = $request->promo;
        $data->slug = $request->slug;
        $data->gambar = $file_name;
        $data->konten = $request->konten;
        $data->deadline = $request->deadline;
        $data->save();
    
        return redirect()->route('listPromo')->with([
            'message' => 'Data berhasil diubah!',
        ]);
    }

    public function destroy($id)
    {
        $promo = Promo::find($id);
    
        if ($promo) {
    
            $filePath = upload_path('files/gambar_promo/') . $promo->gambar;
    
            // hapus file jika ada
            if ($promo->gambar && file_exists($filePath) && is_file($filePath)) {
                @unlink($filePath);
            }
    
            // hapus data DB
            $promo->delete();
        }
    
        return redirect()->back()->with([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
