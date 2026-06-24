<?php

use App\Models\PartnerAsuransi;

if(!function_exists('upload_path')) {
    function upload_path($dir) {
        // $path = '/home/rsorthop/public_html/' . $dir; // server
        $path = public_path($dir); // local
        return $path;
    }
}

if(!function_exists('breadcrumbs')) {
    function getPartner() {
        $partner = PartnerAsuransi::all();
        return $partner;
    }
}