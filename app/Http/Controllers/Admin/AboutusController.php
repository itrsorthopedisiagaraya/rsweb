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
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            $filename = 'post_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

            // store in storage/app/public/files/gambar_aboutus
            $path = $file->storeAs('files/gambar_aboutus', $filename, 'public');

            $url = asset('storage/' . $path);

            return response()->json([
                'filename' => $filename,
                'uploaded' => 1,
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'No file uploaded']
        ], 400);
    }

    public function store(Request $request)
    {
        // get gambar
        if ($request->hasFile('gambar_aboutus')) {
            $file = $request->file('gambar_aboutus');
            $file_name = 'post_banner_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

            // save to storage/app/public/files/gambar_aboutus/banner
            $file->storeAs('files/gambar_aboutus/banner', $file_name, 'public');
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
        // get data by id
        $data = Aboutus::getById($id);
        // get gambar
        if ($request->hasFile('gambar_aboutus')) {
            // delete old file if exists
            if ($data->gambar && Storage::disk('public')->exists('files/gambar_aboutus/banner/' . $data->gambar)) {
                Storage::disk('public')->delete('files/gambar_aboutus/banner/' . $data->gambar);
            }

            $file = $request->file('gambar_aboutus');
            $file_name = 'post_banner_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('files/gambar_aboutus/banner', $file_name, 'public');
        } else {
            $file_name = $data->gambar;
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
        $id = $request->id;
        $data = Aboutus::find($id);
        if ($data->gambar && Storage::disk('public')->exists('files/gambar_aboutus/banner/' . $data->gambar)) {
            Storage::disk('public')->delete('files/gambar_aboutus/banner/' . $data->gambar);
        }
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'About Us berhasil dihapus!'
        ]);
    }
}
