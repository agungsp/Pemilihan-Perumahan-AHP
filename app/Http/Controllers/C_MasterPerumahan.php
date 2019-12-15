<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\masterperumahan;

class C_MasterPerumahan extends Controller
{
    public function index()
    {
        $masterDeveloper = DB::table('getNomorPerumahanPerDeveloper')->get();
        $data = DB::table('getViewPerumahan')->get();
        return view('masterPerumahan', ['data' => $data,
                                        'masterDeveloper' => $masterDeveloper,
                                        'msgType' => '', 'msgStr' => '']);
    }

    public function insert(Request $request)
    {
        $temp = explode('-', $request->masterDeveloper);
        $IdDeveloper = $temp[0];
        $KodePerumahan = $request->KodePerumahan;
        $NamaPerumahan = $request->NamaPerumahan;
        $Alamat = $request->Alamat;
        $NoTelp = $request->NoTelp;

        $user = $request->session()->get('login_state');
        $IdMUserCreate = $user->IdMUser;
        $IdMUserUpdate = $user->IdMUser;

        $cekPerumahan = DB::table('masterperumahans')->where('KodePerumahan', $KodePerumahan)
                                                     ->count();
        if ($cekPerumahan > 0) {
            $masterDeveloper = DB::table('getNomorPerumahanPerDeveloper')->get();
            $data = DB::table('getViewPerumahan')->get();
            return view('masterPerumahan', ['data' => $data,
                                            'masterDeveloper' => $masterDeveloper,
                                            'msgType' => 'warning', 'msgStr' => 'Kode perumahan tidak boleh sama!']);
        }
        else {
            masterperumahan::create([
                'IdDeveloper' => $IdDeveloper,
                'KodePerumahan' => $KodePerumahan,
                'NamaPerumahan' => $NamaPerumahan,
                'Alamat' => $Alamat,
                'NoTelp' => $NoTelp,
                'Fax' => '',
                'IdMUserCreate' => $IdMUserCreate,
                'IdMUserUpdate' => $IdMUserUpdate
            ]);

            $masterDeveloper = DB::table('getNomorPerumahanPerDeveloper')->get();
            $data = DB::table('getViewPerumahan')->get();
            return view('masterPerumahan', ['data' => $data,
                                            'masterDeveloper' => $masterDeveloper,
                                            'msgType' => 'success', 'msgStr' => 'Data perumahan berhasil ditambahkan']);
        }
    }

    public function edit($IdPerumahan)
    {
        $masterDeveloper = DB::table('getNomorPerumahanPerDeveloper')->get();
        $data = DB::table('getViewPerumahan')->where('IdPerumahan', $IdPerumahan)
                                             ->get()[0];
        return view('masterPerumahanEdit', ['data' => $data,
                                            'masterDeveloper' => $masterDeveloper,
                                            'msgType' => '', 'msgStr' => '']);
    }

    public function save(Request $request)
    {
        $IdPerumahan = $request->IdPerumahan;
        $NamaPerumahan = $request->NamaPerumahan;
        $Alamat = $request->Alamat;
        $NoTelp = $request->NoTelp;

        $user = $request->session()->get('login_state');
        $IdMUserUpdate = $user->IdMUser;

        masterperumahan::where('IdPerumahan', $IdPerumahan)
                       ->update([
                            'NamaPerumahan' => $NamaPerumahan,
                            'Alamat' => $Alamat,
                            'NoTelp' => $NoTelp,
                            'Fax' => '',
                            'IdMUserUpdate' => $IdMUserUpdate
                       ]);

        $masterDeveloper = DB::table('getNomorPerumahanPerDeveloper')->get();
        $data = DB::table('getViewPerumahan')->get();
        return view('masterPerumahan', ['data' => $data,
                                        'masterDeveloper' => $masterDeveloper,
                                        'msgType' => 'success', 'msgStr' => 'Data perumahan berhasil diubah']);
    }

    public function delete($IdPerumahan)
    {
        masterperumahan::where('IdPerumahan', $IdPerumahan)->delete();
        $masterDeveloper = DB::table('getNomorPerumahanPerDeveloper')->get();
        $data = DB::table('getViewPerumahan')->get();
        return view('masterPerumahan', ['data' => $data,
                                        'masterDeveloper' => $masterDeveloper,
                                        'msgType' => 'success', 'msgStr' => 'Data perumahan berhasil dihapus']);
    }
}
