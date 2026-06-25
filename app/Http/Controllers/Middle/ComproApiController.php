<?php

namespace App\Http\Controllers\Middle;

use App\Http\Controllers\Controller;
use App\Models\Admin\Dokter;
use App\Models\Admin\Postingan;
use Illuminate\Http\Request;

class ComproApiController extends Controller
{
    public function getDokter()
    {
        $data = Dokter::all();
        return response()->json($data);
    }

    public function getJadwal()
    {
        $data = Dokter::getAllWithJadwal();
        return response()->json($data);
    }

    public function getJadwalFilter($hari)
    {
        $data = Dokter::getFilterWithJadwal($hari);
        return response()->json($data);
    }

    public function getPostingan() 
    {
        $data = Postingan::all();
        return response()->json($data);
    }
}
