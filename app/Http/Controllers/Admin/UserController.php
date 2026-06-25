<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::getAll();
	$users = User::where('role', '!=', '0')->get();
        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.user.form_create_user');
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.user.form_edit_user', [
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $users = new User();
        $users->name = $request->nama;
        $users->nip = $request->nip;
        $users->jabatan = $request->jabatan;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->role = $request->role;
        $users->password = bcrypt($request->password1);
        $users->save();

        return redirect()->route('user')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $users = User::find($request->id);
        $users->name = $request->nama;
        $users->nip = $request->nip;
        $users->jabatan = $request->jabatan;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->role = $request->role;
        $users->password = bcrypt($request->password1);
        $users->save();
        // dd($request->all());
        return redirect()->route('user')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->route('user')
            ->with('success', 'User berhasil dihapus');
    }
}
