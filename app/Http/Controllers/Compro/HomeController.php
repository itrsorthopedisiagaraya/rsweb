<?php

namespace App\Http\Controllers\Compro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Dokter;
use App\Models\Admin\Kategori;
use App\Models\Admin\Postingan;
use App\Models\LayananMedis;
use App\Models\LayananUnggulan;
use App\Models\Promo;
use App\Models\TempDaftarBerobat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index (){
        // dokter with relation
        $spesialis = Dokter::select("spesialis")->distinct()->get();
        $promo = Promo::all();
        $berita = Postingan::with("kategori")->get();
        $layanan = LayananUnggulan::all();
        // dd($spesialis);
        $dokter = Dokter::getAllWithJadwal();
        return view ('compro.index', [
            'dokter' => $dokter,
            'spesialis' => $spesialis,
            'promo' => $promo,
            'berita' => $berita,
            'layanan' => $layanan
        ]);
    }

    public function about (){
        $layananMedis = LayananMedis::all();
        return view ('compro.about', [
            'layananMedis' => $layananMedis
        ]);
    }

    // public function doctors (){
    //     $data = Dokter::paginate(6);
    //     return view ('compro.doctors', [
    //         'data'=> $data
    //     ]);
    // }

    public function blog (){
        $kategori = DB::table('m_kategori')
                        ->select('kategori', DB::raw('COUNT(kategori) as jml'))
                        ->where('terkait', 'berita')
                        ->groupBy('kategori')
                        ->get();
        $data = Postingan::with('kategori')->get();
        $recent = Postingan::with('kategori')->limit(3)->get();
        return view ('compro.blog', [
            'data' => $data,
            'recent' => $recent,
            'kategori' => $kategori
        ]);
    }

    public function blogDetails ($slug){
        $kategori = DB::table('m_kategori')
                        ->select('kategori', DB::raw('COUNT(kategori) as jml'))
                        ->where('terkait', 'berita')
                        ->groupBy('kategori')
                        ->get();

        $data = Postingan::with('kategori')->where('slug', $slug)->get();
        $recent = Postingan::with('kategori')->limit(3)->get();
        // dd($recent);
        return view ('compro.blog-details', [
            'data'=> $data,
            'kategori' => $kategori,
            'recent' => $recent
        ]);
    }

    public function contact (){
        return view ('compro.contact');
    }

    public function daftarBerobat(Request $request)
    {
        $daftarBerobat = new TempDaftarBerobat();
        $daftarBerobat->user_id = auth()->user()->id;
        $daftarBerobat->dokter_id = $request->dokter;
        $daftarBerobat->metode_pembayaran = $request->pembayaran;
        $daftarBerobat->tanggal_periksa = $request->tgl_periksa;
        $daftarBerobat->save();

        return response()->json(['success' => true]);
    }

    public function layananDetail($id)
    {
        $layanan = LayananUnggulan::find($id);
        return view('compro.layanan', [
            'layanan' => $layanan
        ]);
    }

    public function promo()
    {
        $promo = Promo::all();
        return view('compro.promo', [
            'promo' => $promo
        ]);
    }

    public function sambutan()
    {
        return view('compro.sambutan');
    }
}
