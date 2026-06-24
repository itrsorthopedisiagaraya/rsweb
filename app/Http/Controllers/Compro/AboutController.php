<?php

namespace App\Http\Controllers\Compro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Aboutus;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index($id)
    {
        $data = Aboutus::getById($id);
        return view('compro.post.aboutus', [
            'data' => $data
        ]);
    }
}
