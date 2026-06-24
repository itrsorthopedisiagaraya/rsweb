<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kategori;
use App\Models\Admin\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostinganController extends Controller
{
    public function index()
    {
        $data = Postingan::getAll();
        return view('admin.postingan.index', [
            'data' => $data
        ]);
    }

    public function getDataBerita()
    {
        $data = Postingan::all();
        return DataTables::of($data)->make(true);
    }

    // create
    public function create()
    {
        $kategori = Kategori::where('terkait', 'berita')->get();
        return view('admin.postingan.form_postingan_create', [
            'kategori' => $kategori
        ]);
    }

    // upload
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            $filename = 'post_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

            // store in storage/app/public/files/gambar_postingan
            $path = $file->storeAs('files/gambar_postingan', $filename, 'public');

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
        if ($request->hasFile('gambar_postingan')) {
            $file = $request->file('gambar_postingan');
            $file_name = 'post_banner_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

            // save to storage/app/public/files/gambar_postingan/banner
            $file->storeAs('files/gambar_postingan/banner', $file_name, 'public');
        } else {
            $file_name = null;
        }

        $data = new Postingan();
        $data->kategori_id = $request->kategori;
        $data->judul = $request->judul;
        $data->slug = $request->slug;
        $data->konten = $request->konten;
        $data->gambar = $file_name;
        $data->status = 'Draft';
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        return redirect()->route('postingan')->with('success', 'Data berhasil ditambahkan');
    }

    // edit
    public function edit($id)
    {
        $data = Postingan::find($id);
        return view('admin.postingan.form_postingan_edit', [
            'data' => $data
        ]);
    }

    // update
    public function update(Request $request)
    {
        $id = $request->id;
        // get data by id
        $data = Postingan::getById($id);
        // get gambar
        if ($request->hasFile('gambar_postingan')) {
            // delete old file if exists
            if ($data->gambar && Storage::disk('public')->exists('files/gambar_postingan/banner/' . $data->gambar)) {
                Storage::disk('public')->delete('files/gambar_postingan/banner/' . $data->gambar);
            }

            $file = $request->file('gambar_postingan');
            $file_name = 'post_banner_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('files/gambar_postingan/banner', $file_name, 'public');
        } else {
            $file_name = $data->gambar;
        }

        $data->judul = $request->judul;
        $data->slug = $request->slug;
        $data->konten = $request->konten;
        $data->gambar = $file_name;
        $data->status = 'Draft';
        $data->updated_by = Auth::user()->id;
        $data->save();

        return redirect()->route('postingan')->with('success', 'Data berhasil diubah');
    }

    // delete
    public function delete(Request $request)
    {
        $id = $request->id;
        $data = Postingan::find($id);
        if ($data->gambar && Storage::disk('public')->exists('files/gambar_postingan/banner/' . $data->gambar)) {
            Storage::disk('public')->delete('files/gambar_postingan/banner/' . $data->gambar);
        }
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus!'
        ]);
    }
}
