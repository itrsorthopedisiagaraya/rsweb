<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KritikSaran;

class KritikSaranController extends Controller
{
    public function index()
    {
        $kritikSaran = KritikSaran::all();
        return view('admin.kritik-saran.index', compact('kritikSaran'));
    }

    public function delete($id)
    {
        $kritikSaran = KritikSaran::findOrFail($id);
        // dd($kritikSaran->gambar);

        if (!empty($kritikSaran->gambar)) {
            $uploadPath = upload_path('files/gambar_kritiksaran/');

            foreach ($kritikSaran->gambar as $file) {
                $filegambar = $uploadPath . $file;

                if (file_exists($filegambar) && is_file($filegambar)) {
                    @unlink($filegambar);
                }
            }
        }

        $kritikSaran->delete();

        return redirect()
            ->route('kritik-saran.index')
            ->with('success', 'Kritik dan saran berhasil dihapus.');
    }
}
