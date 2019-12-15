<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_login extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('login_state')) { // Jika sudah login
            return view('home');
        }
        else { // Jika belum login
            return view('login', ['msgType' => '', 'msgStr' => '']);
        }
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);

        $cekUser = DB::table('MasterUsers')->where('Username', $username)
                                           ->where('Password', $password)
                                           ->count();
        if ($cekUser > 0) {
            $user = DB::table('MasterUsers')->where('Username', $username)
                                            ->where('Password', $password)
                                            ->get();
            $userArray = $user[0];
            $nama_pendek = explode(" ", $userArray->NamaUser);
            $userArray->nama_pendek = $nama_pendek[0];
            $request->session()->put('login_state', $userArray);
            return redirect('/');
        }
        else {
            return view('login', ['msgType' => 'warning', 'msgStr' => 'User `'.$username.'` tidak ditemukan!']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        if(!$request->session()->has("login_state")){
            return redirect('/');
        }
    }
}
