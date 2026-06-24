<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    } 

    public function register()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect(RouteServiceProvider::DASHBOARD);
        }else{
            return redirect("login")->with([
                'auth' => 'fail',
                'message' => 'Username / password tidak valid!'
            ]);
        }

    }

    public function registration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(Request $request)
    {
        // dd($request->all());
      $user = User::create([
        'name' => $request['nama'],
        'jabatan' => 'Pasien',
        'username' => $request['username'],
        'email' => $request['email'],
        'password' => Hash::make($request['password2']),
        'role' => 0
      ]);

      $newUserId = $user->id;
      $userDetail = UserDetail::create([
        'user_id' => $newUserId,
        'no_hp' => $request['no_hp'],
        'jenis_kelamin' => $request['jk'],
        'status' => $request['status'],
        'tgl_lahir' => $request['tgl_lahir'],
        'pendidikan' => $request['pendidikan'],
        'nama_ibu' => $request['ibu'],
        'nama_ayah' => $request['ayah'],
        'agama' => $request['agama'],
        'pekerjaan' => $request['pekerjaan'],
        'alamat_lengkap' => $request['alamat'],
        'klinik_tujuan' => $request['klinik_tujuan'],
        'warga_negara' => $request['warganegara']
      ]);

      Auth::login($user);

      if($userDetail) {
        return redirect("dashboard")->withSuccess('Daftar berhasil');
      }
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
