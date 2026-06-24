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
        $all_promotions = Promo::all();
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
        // get data by id
        $data = Promo::find($id);
        // get gambar
        if($request->hasFile('gambar')) {
            // delete gambar lama 
            $old_pict = $data->gambar;
            if(file_exists(upload_path('files/gambar_promo/banner/'.$old_pict))) {
                unlink(upload_path('files/gambar_promo/banner/'.$old_pict));
            }

            // upload gambar baru
            $file = $request->file('gambar_promo');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'post_banner_'.time().'.'.$extension;
            $file->move(upload_path('files/gambar_promo/banner'), $file_name);
        } else {
            $file_name = $data->gambar;
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
        Promo::find($id)->delete();
        return redirect()->back()->with([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
