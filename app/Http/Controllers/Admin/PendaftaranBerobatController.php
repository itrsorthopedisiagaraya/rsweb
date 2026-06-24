<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempDaftarBerobat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Mpdf\Mpdf as PDF;

class PendaftaranBerobatController extends Controller
{
    public function index()
    {
        $data = TempDaftarBerobat::with(['dokter', 'user.userDetail'])->get();
        return view('admin.pendaftaran-berobat.index', [
            'data' => $data
        ]);
    }

    public function pasienDetail($pasien_id)
    {
        $data = TempDaftarBerobat::with(['dokter', 'user.userDetail'])
                ->where('id', $pasien_id)
                ->get();
        // dd($data);
        
        // Setup a filename 
        $documentFileName = "fun.pdf";
 
        // Create the mPDF document
        $document = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
            'debug' => true
        ]);     
 
        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];

        $logo_name = public_path('assets/images/logos/logo-name.png');
        $logo = public_path('assets/images/logos/favicon.png');
        // dd($path);
        // Write some simple Content
        foreach($data as $dt) :
        $jk = $dt->user->userDetail->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan";
        $html = '
            <table>
                <tr>
                    <td><img src="'. $logo .'" alt="image" style="width: 100px"/></td>
                    <td style="width: 400px;">
                        <img src="'. $logo_name .'" alt="image" style="width: 300px; margin-top: 30px;"/><br>
                        <small style="margin-top: 10px; color: #777;">Jl. Siaga Raya No.4-8, RT.14/RW.3, Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510</small>
                    </td>
                </tr>
            </table>
            <h3 style="text-align: center; margin-top: 30px; color: #555;">Data Pendaftaran Pasien</h3>
            <h4 style="text-align: center; margin-top: -30px; color: #555;"><i>Registrasion Form<i></h4>
            <table style="width: 100%; border-collapse: collapse; width: 100%; color: #555;">
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa; height: 30px;">
                    <td style="width: 5%; text-align: center; height: 30px;">1</td>
                    <td style="width: 40%">Nama Lengkap Pasien</td>
                    <td>'. $dt->user->name .'</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">2</td>
                    <td>Nama Ayah / Suami</td>
                    <td>'. $dt->user->userDetail->nama_ayah .'</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">3</td>
                    <td>Jenis Kelamin</td>
                    <td>'. $jk .'</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">4</td>
                    <td>Status Perkawinan</td>
                    <td>'. $dt->user->userDetail->status .'</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">5</td>
                    <td>Tempat / Tanggal lahir</td>
                    <td>'. $dt->user->userDetail->tgl_lahir .'</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">6</td>
                    <td>Agama</td>
                    <td>'. $dt->user->userDetail->agama .'</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">7</td>
                    <td>Kewarganegaraan</td>
                    <td>'. strtoupper($dt->user->userDetail->warga_negara) .'</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">8</td>
                    <td>Pendidikan</td>
                    <td>SMK/SMA</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">9</td>
                    <td>Pekerjaan</td>
                    <td>IT Programmer</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">10</td>
                    <td>Alamat Lengkap</td>
                    <td>Jl.Parungbanteng RT.001/RW.001 Kelurahan Katulampa Kecamatan Bogor Timur Kota Bogor</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">11</td>
                    <td>Nomor Telp/HP</td>
                    <td>0895612206017</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">12</td>
                    <td>Email</td>
                    <td>andri.yana349@gmail.com</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">13</td>
                    <td>Klinik yang dituju</td>
                    <td>Umum</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">13</td>
                    <td>Jenis Pembayaran</td>
                    <td>Umum / Tunai / Cash</td>
                </tr>
                <tr style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
                    <td style="width: 5%; text-align: center; height: 30px;">14</td>
                    <td>Nama Lengkap Ibu</td>
                    <td>Susi suianti</td>
                </tr>
            </table>';
        endforeach;

        $document->WriteHTML($html);
         
        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
         
        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header); //
    }
}
