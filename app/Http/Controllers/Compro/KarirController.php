<?php

namespace App\Http\Controllers\Compro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kategori;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    public function index()
    {
        $kategori = Kategori::getAll('karir');

        $data = [
            'kategori' => $kategori
        ];
        return view('compro.karir', $data);
    }
}
