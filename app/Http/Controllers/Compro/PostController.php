<?php

namespace App\Http\Controllers\Compro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Postingan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($id)
    {
        $data = Postingan::getById($id);
        return view('compro.post.index', [
            'data' => $data
        ]);
    }
}
