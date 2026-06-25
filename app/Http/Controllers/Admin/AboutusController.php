<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Aboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutusController extends Controller
{
    public function index()
    {
        $data = Aboutus::getAll();
        return view('admin.aboutus.index', [
            'data' => $data
        ]);
        // dd($data);
    }

    public function getDataAboutus()
    {
        $data = Aboutus::all();
        return DataTables::of($data)->make(true);
    }

    // create
    public function create()
    {
        return view('admin.aboutus.form_aboutus_create');
    }

    // upload
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filename = 'aboutus_'.time().'.'.$extension;

            $request->file('upload')->move(upload_path('files/gambar_aboutus'), $filename);
 
            $url = asset('files/gambar_aboutus/'.$filename);
            return response()->json(['filename' => $filename, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function store(Request $request)
    {
        // get gambar
         if($request->hasFile('gambar_aboutus')) {
            $file = $request->file('gambar_aboutus');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'aboutus_banner_'.time().'.'.$extension;
            $file->move(upload_path('files/gambar_aboutus'), $file_name);
        } else {
            $file_name = null;
        }

        $data = new Aboutus();
        $data->judul = $request->judul;
        $data->slug = $request->slug;
        $data->konten = $request->konten;
        $data->gambar = $file_name;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        return redirect()->route('aboutus')->with('success', 'Data berhasil ditambahkan');
    }

    // edit
    public function edit($id)
    {
        $data = Aboutus::find($id);
        return view('admin.aboutus.form_aboutus_edit', [
            'data' => $data
        ]);
    }

    // update
    public function update(Request $request)
    {
        $id = $request->id;
        $data = Aboutus::find($id); // FIXED

        $file_name = $data->gambar;

        $uploadPath = upload_path('files/gambar_aboutus/'); // ❌ no banner

        if ($request->hasFile('gambar_aboutus')) {

            // delete old image safely
            if (!empty($data->gambar)) {
                $oldFile = $uploadPath . $data->gambar;

                if (file_exists($oldFile) && is_file($oldFile)) {
                    @unlink($oldFile);
                }
            }

            // upload new image
            $file = $request->file('gambar_aboutus');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'aboutus_' . time() . '.' . $extension;

            $file->move($uploadPath, $file_name);
        }

        $data->judul = $request->judul;
        $data->slug = $request->slug;
        $data->konten = $request->konten;
        $data->gambar = $file_name;
        $data->updated_by = Auth::user()->id;
        $data->save();

        return redirect()->route('aboutus')->with('success', 'Data berhasil diubah');
    }

    // delete
    public function delete(Request $request)
    {
        $data = Aboutus::find($request->id);

        if ($data) {

            $uploadPath = upload_path('files/gambar_aboutus/'); // ❌ no banner

            if (!empty($data->gambar)) {
                $file = $uploadPath . $data->gambar;

                if (file_exists($file) && is_file($file)) {
                    @unlink($file);
                }
            }

            $data->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'About Us berhasil dihapus!'
        ]);
    }
}
