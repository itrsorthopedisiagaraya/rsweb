<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function index()
    {
        $pesan = Pesan::all();
        return view('admin.pesan.index', compact('pesan'));
    }

    public function delete($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('pesan.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
