<?php

namespace App\Http\Controllers;

use App\Models\PartnerAsuransi;
use Illuminate\Http\Request;

class PartnerAsuransiController extends Controller
{
    public function index()
    {
        $data = PartnerAsuransi::all();
        return view('admin.partner-asuransi.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('admin.partner-asuransi.form-create-partner');
    }

    public function edit($id)
    {
        $data = PartnerAsuransi::find($id);
        return view('admin.partner-asuransi.form-edit-partner', [
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'logo' => 'required',
        ]);

        // check if file is uploaded
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'partner-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/logo-partner', $filename);
        }

        $partner = new PartnerAsuransi();
        $partner->nama_partner = $request->nama;
        $partner->logo_partner = $filename;
        $partner->link_partner = $request->link;
        $partner->deskripsi_partner = $request->desc;
        $partner->save();

        return redirect()->route('partnerAsuransi')->with('success', 'Partner berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $partner = PartnerAsuransi::find($id);
        $partner->nama_partner = $request->nama;
        $partner->link_partner = $request->link;
        $partner->deskripsi_partner = $request->desc;

        // check if file is uploaded
        if ($request->hasFile('logo')) {

            // delete old logo if exists
            if (!empty($partner->logo_partner)) {
                $oldFile = 'files/logo-partner/' . $partner->logo_partner;
                if (file_exists($oldFile) && is_file($oldFile)) {
                    @unlink($oldFile);
                }
            }

            $file = $request->file('logo');
            $filename = 'partner-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('files/logo-partner', $filename);
            $partner->logo_partner = $filename;
        } 

        $partner->save();

        return redirect()->route('partnerAsuransi')->with('success', 'Partner berhasil diubah');
    }

    public function delete(Request $request)
    {
        $partner = PartnerAsuransi::find($request->id);
        if ($partner) {
            $uploadPath = upload_path('files/logo-partner/');

            if (!empty($partner->logo_partner)) {
                $file = $uploadPath . $partner->logo_partner;

                if (file_exists($file) && is_file($file)) {
                    @unlink($file);
                }
            }

            $partner->delete();
        }

        return redirect()->route('partnerAsuransi')->with('success', 'Partner berhasil dihapus');
    }
}
