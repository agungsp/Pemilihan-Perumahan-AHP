<?php

namespace App\Http\Controllers;

use App\Model\masteruser;
use Illuminate\Http\Request;
use App\Model\tblMasterUser;
use Illuminate\Support\Facades\DB;

class C_register extends Controller
{
    public function index()
    {
        return view('register', ['msgType' => '', 'msgStr' => '']);
    }

    public function insert(Request $request)
    {
        $username = $request->Username;
        $nama = $request->Nama;
        $password = md5($request->Password);

        $cekUser = DB::table('masterusers')->where('Username', $username)
                                           ->get();

        if (count($cekUser) == 0) {
            masteruser::create([
                'Username' => $username,
                'NamaUser' => $nama,
                'Password' => $password
            ]);
            return view('login', ['msgType' => 'success', 'msgStr' => 'User baru berhasil dibuat.']);
        }
        else {
            return view('register', ['msgType' => 'warning', 'msgStr' => 'User yang dibuat sudah ada!']);
        }
    }
}
