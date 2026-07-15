<?php

use App\Models\PartnerAsuransi;

if (!function_exists('upload_path')) {
    function upload_path($dir)
    {
        // hosting path 
        $path = file_exists(base_path('../public_html'))
            ? base_path('../public_html/' . ltrim($dir, '/'))
            : public_path($dir);
        
        // local path
        // $path = file_exists(base_path('../rsweb2'))
        //     ? base_path('../rsweb2/' . ltrim($dir, '/'))
        //     : public_path($dir);

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        return $path;
    }
}

if(!function_exists('breadcrumbs')) {
    function getPartner() {
        $partner = PartnerAsuransi::all();
        return $partner;
    }
    
    function getAboutus() {
        $aboutus = \App\Models\Admin\Aboutus::enabled()->get();
        return $aboutus;
    }
}