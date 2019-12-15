<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\masterdeveloper;


class C_MasterDeveloper extends Controller
{
    public function index()
    {
        $data = DB::table('getDeveloperView')->get();
        $masterWilayah = DB::table('masterwilayahs')->get();
        return view('masterDeveloper', ['data' => $data, 'masterWilayah' => $masterWilayah, 'msgType' => '', 'msgStr' => '']);
    }

    public function insert(Request $request)
    {
        if ($request->has('submit')){
            $IdWilayah = $request->masterWilayah;
            $KodeDeveloper = $request->KodeDeveloper;
            $NamaDeveloper = $request->NamaDeveloper;
            $Alamat = $request->Alamat;
            $NoTelp = $request->NoTelp;

            $user = $request->session()->get('login_state');
            $IdMUserCreate = $user->IdMUser;
            $IdMUserUpdate = $user->IdMUser;

            $cekDeveloper = DB::table('masterdevelopers')->where('KodeDeveloper', $KodeDeveloper)
                                                         ->count();

            if ($cekDeveloper > 0) {
                $data = DB::table('getDeveloperView')->get();
                $masterWilayah = DB::table('masterwilayahs')->get();
                return view('masterDeveloper', ['data' => $data, 'masterWilayah' => $masterWilayah, 'msgType' => 'warning', 'msgStr' => 'Kode Developer tidak boleh sama!']);
            } else {
                masterdeveloper::create([
                    'IdWilayah' => $IdWilayah,
                    'KodeDeveloper' => $KodeDeveloper,
                    'NamaDeveloper' => $NamaDeveloper,
                    'Alamat' => $Alamat,
                    'NoTelp' => $NoTelp,
                    'IdUserCreate' => $IdMUserCreate,
                    'IdUserUpdate' => $IdMUserUpdate
                ]);

                $data = DB::table('getDeveloperView')->get();
                $masterWilayah = DB::table('masterwilayahs')->get();
                return view('masterDeveloper', ['data' => $data, 'masterWilayah' => $masterWilayah, 'msgType' => 'success', 'msgStr' => 'Data Developer berhasil ditambahkan']);
            }
        }
    }

    public function edit($IdDeveloper)
    {
        $data = DB::table('getDeveloperView')->where('IdDeveloper', $IdDeveloper)
                                             ->get()[0];
        $masterWilayah = DB::table('masterwilayahs')->get();
        return view('masterDeveloperEdit', ['data' => $data, 'masterWilayah' => $masterWilayah, 'msgType' => '', 'msgStr' => '']);
    }

    public function save(Request $request)
    {
        if ($request->has('submit')){
            $IdDeveloper = $request->IdDeveloper;
            $IdWilayah = $request->masterWilayah;
            $KodeDeveloper = $request->KodeDeveloper;
            $NamaDeveloper = $request->NamaDeveloper;
            $Alamat = $request->Alamat;
            $NoTelp = $request->NoTelp;

            $user = $request->session()->get('login_state');
            $IdMUserUpdate = $user->IdMUser;

            masterdeveloper::where('IdDeveloper', $IdDeveloper)->update(['IdWilayah' => $IdWilayah,
                                                                         'KodeDeveloper' => $KodeDeveloper,
                                                                         'NamaDeveloper' => $NamaDeveloper,
                                                                         'Alamat' => $Alamat,
                                                                         'NoTelp' => $NoTelp,
                                                                         'IdUserUpdate' => $IdMUserUpdate]);

            $data = DB::table('getDeveloperView')->get();
            $masterWilayah = DB::table('masterwilayahs')->get();
            return view('masterDeveloper', ['data' => $data, 'masterWilayah' => $masterWilayah, 'msgType' => 'success', 'msgStr' => 'Data Developer berhasil diubah']);
        }
    }

    public function delete($IdDeveloper)
    {
        masterdeveloper::where('IdDeveloper', $IdDeveloper)->delete();
        $data = DB::table('getDeveloperView')->get();
        $masterWilayah = DB::table('masterwilayahs')->get();
        return view('masterDeveloper', ['data' => $data, 'masterWilayah' => $masterWilayah, 'msgType' => 'success', 'msgStr' => 'Data Developer berhasil dihapus']);
    }
}
