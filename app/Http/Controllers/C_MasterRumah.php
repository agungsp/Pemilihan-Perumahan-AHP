<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\masterrumah;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;

class C_MasterRumah extends Controller
{
    public function index()
    {
        $masterPerumahan = DB::table('getNomorRumahPerPerumahan')->get();
        $data = DB::table('getViewRumah')->get();
        return view('masterRumah', ['data' => $data, 'masterPerumahan' => $masterPerumahan,
                                    'msgType' => '', 'msgStr' => '']);
    }

    public function insert(Request $request)
    {
        $masterPerumahan = explode('-', $request->masterPerumahan) ;
        $IdPerumahan = $masterPerumahan[0];
        $KodeRumah = $request->KodeRumah;
        $NamaRumah = $request->NamaRumah;
        $Harga = str_replace(',', '', $request->Harga);
        $Tipe = str_replace(',', '', $request->Tipe);
        $LuasTanah = str_replace(',', '', $request->LuasTanah);
        $Akses = str_replace(',', '', $request->Akses);
        $Sertifikat = $request->Sertifikat;

        $IsKeamanan = true;
        $IsTempatIbadah = true;
        $IsTaman = true;
        $IsMarket = true;
        $IsOlahraga = true;

        if ($request->Fasilitas == 1) {
            $IsTaman = false;
            $IsMarket = false;
            $IsOlahraga = false;
        }
        elseif ($request->Fasilitas == 2) {
            $IsMarket = false;
            $IsOlahraga = false;
        }

        $FasilitasLain = ($request->FasilitasLain != null)?$request->FasilitasLain:'-';
        $GambarRumah = Input::file('GambarRumah');
        $GambarDenah = Input::file('GambarDenah');

        $user = $request->session()->get('login_state');
        $IdMUserCreate = $user->IdMUser;
        $IdMUserUpdate = $user->IdMUser;

        $cekRumah = DB::table('masterrumahs')->where('KodeRumah', $KodeRumah)
                                                 ->count();

        if ($cekRumah > 0) {
            $masterPerumahan = DB::table('getNomorRumahPerPerumahan')->get();
            $data = DB::table('getViewRumah')->get();
            return view('masterRumah', ['data' => $data, 'masterPerumahan' => $masterPerumahan,
                                        'msgType' => 'warning', 'msgStr' => 'Kode rumah tidak boleh sama']);
        }
        else {
            $nameGambarRumah = $KodeRumah.'.'.$GambarRumah->getClientOriginalExtension();
            $nameGambarRumahTumb = $KodeRumah.'_tumb.'.$GambarRumah->getClientOriginalExtension();
            $nameGambarDenah = $KodeRumah.'_denah.'.$GambarDenah->getClientOriginalExtension();
            $nameGambarDenahTumb = $KodeRumah.'_denah_tumb.'.$GambarDenah->getClientOriginalExtension();

            masterrumah::create([
                'IdPerumahan' => $IdPerumahan,
                'KodeRumah' => $KodeRumah,
                'NamaRumah' => $NamaRumah,
                'IsKeamanan' => $IsKeamanan,
                'IsTempatIbadah' => $IsTempatIbadah,
                'IsTaman' => $IsTaman,
                'IsMarket' => $IsMarket,
                'IsOlahraga' => $IsOlahraga,
                'FasilitasLain' => $FasilitasLain,
                'Harga' => $Harga,
                'Akses' => $Akses,
                'Sertifikat' => $Sertifikat,
                'Tipe' => $Tipe,
                'LuasTanah' => $LuasTanah,
                'GambarRumah' => asset('storage/'.$nameGambarRumah),
                'GambarRumahTumb' => asset('storage/'.$nameGambarRumahTumb),
                'GambarDenah' => asset('storage/'.$nameGambarDenah),
                'GambarDenahTumb' => asset('storage/'.$nameGambarDenahTumb),
                'IdUserCreate' => $IdMUserCreate,
                'IdUserUpdate' => $IdMUserUpdate
            ]);

            $GambarRumah->move('storage', $nameGambarRumah); //Upload Gambar Asli
            $GambarDenah->move('storage', $nameGambarDenah); //Upload Gambar Asli

            $GambarRumahTumb = Image::make('storage/'.$nameGambarRumah); // Load Gambar;
            $GambarRumahTumb->resize(100,100)->save('storage/'.$nameGambarRumahTumb); // resize untuk tumbnail dan save

            $GambarDenahTumb = Image::make('storage/'.$nameGambarDenah); // Load Gambar;
            $GambarDenahTumb->resize(100,100)->save('storage/'.$nameGambarDenahTumb); // resize untuk tumbnail dan save

            $masterPerumahan = DB::table('getNomorRumahPerPerumahan')->get();
            $data = DB::table('getViewRumah')->get();
            return view('masterRumah', ['data' => $data, 'masterPerumahan' => $masterPerumahan,
                                        'msgType' => 'success', 'msgStr' => 'Data rumah berhasil ditambahkan']);
        }
    }

    public function edit($IdRumah)
    {
        $masterPerumahan = DB::table('getNomorRumahPerPerumahan')->get();
        $data = DB::table('getViewRumah')->where('IdRumah', $IdRumah)->get()[0];
        $Fasilitas = 3;

        if (!$data->IsOlahraga && !$data->IsMarket) {
            $Fasilitas = 2;
        }

        if (!$data->IsTaman) {
            $Fasilitas = 1;
        }

        return view('masterRumahEdit', ['data' => $data, 'masterPerumahan' => $masterPerumahan, 'fasilitas' => $Fasilitas,
                                    'msgType' => '', 'msgStr' => '']);
    }

    public function save(Request $request)
    {
        $IdRumah = $request->IdRumah;
        $KodeRumah = $request->KodeRumah;
        $NamaRumah = $request->NamaRumah;
        $Harga = str_replace(',', '', $request->Harga);
        $Tipe = str_replace(',', '', $request->Tipe);
        $LuasTanah = str_replace(',', '', $request->LuasTanah);
        $Akses = str_replace(',', '', $request->Akses);
        $Sertifikat = $request->Sertifikat;
        $IsKeamanan = true;
        $IsTempatIbadah = true;
        $IsTaman = true;
        $IsMarket = true;
        $IsOlahraga = true;

        if ($request->Fasilitas = 1) {
            $IsTaman = false;
            $IsMarket = false;
            $IsOlahraga = false;
        }
        elseif ($request->Fasilitas = 2) {
            $IsMarket = false;
            $IsOlahraga = false;
        }
        $FasilitasLain = ($request->FasilitasLain != null)?$request->FasilitasLain:'';

        $GambarRumah = Input::file('GambarRumah');
        $GambarDenah = Input::file('GambarDenah');

        $user = $request->session()->get('login_state');
        $IdMUserUpdate = $user->IdMUser;

        if ($GambarRumah != null) {
            $nameGambarRumah = $KodeRumah.'.'.$GambarRumah->getClientOriginalExtension();
            $nameGambarRumahTumb = $KodeRumah.'_tumb.'.$GambarRumah->getClientOriginalExtension();
        }

        if ($GambarDenah != null) {
            $nameGambarDenah = $KodeRumah.'_denah.'.$GambarDenah->getClientOriginalExtension();
            $nameGambarDenahTumb = $KodeRumah.'_denah_tumb.'.$GambarDenah->getClientOriginalExtension();
        }

        DB::beginTransaction();
        masterrumah::where('IdRumah', $IdRumah)->update([
            'KodeRumah' => $KodeRumah,
            'NamaRumah' => $NamaRumah,
            'IsKeamanan' => $IsKeamanan,
            'IsTempatIbadah' => $IsTempatIbadah,
            'IsTaman' => $IsTaman,
            'IsMarket' => $IsMarket,
            'IsOlahraga' => $IsOlahraga,
            'FasilitasLain' => $FasilitasLain,
            'Harga' => $Harga,
            'Akses' => $Akses,
            'Sertifikat' => $Sertifikat,
            'Tipe' => $Tipe,
            'LuasTanah' => $LuasTanah,
            'IdUserUpdate' => $IdMUserUpdate
        ]);

        if ($GambarRumah != null) {
            masterrumah::where('IdRumah', $IdRumah)->update([
                'GambarRumah' => asset('storage/'.$nameGambarRumah),
                'GambarRumahTumb' => asset('storage/'.$nameGambarRumahTumb)
            ]);
            $GambarRumah->move('storage', $nameGambarRumah); //Upload Gambar Asli
            $GambarRumahTumb = Image::make('storage/'.$nameGambarRumah); // Load Gambar;
            $GambarRumahTumb->resize(100,100)->save('storage/'.$nameGambarRumahTumb); // resize untuk tumbnail dan save
        }

        if ($GambarDenah != null) {
            masterrumah::where('IdRumah', $IdRumah)->update([
                'GambarDenah' => asset('storage/'.$nameGambarDenah),
                'GambarDenahTumb' => asset('storage/'.$nameGambarDenahTumb)
            ]);
            $GambarDenah->move('storage', $nameGambarDenah); //Upload Gambar Asli
            $GambarDenahTumb = Image::make('storage/'.$nameGambarDenah); // Load Gambar;
            $GambarDenahTumb->resize(100,100)->save('storage/'.$nameGambarDenahTumb); // resize untuk tumbnail dan save
        }

        DB::commit();

        $masterPerumahan = DB::table('getNomorRumahPerPerumahan')->get();
        $data = DB::table('getViewRumah')->get();
        return view('masterRumah', ['data' => $data, 'masterPerumahan' => $masterPerumahan,
                                    'msgType' => 'success', 'msgStr' => 'Data rumah berhasil diubah']);
    }

    public function delete($IdRumah)
    {
        masterrumah::where('IdRumah', $IdRumah)->delete();
        $masterPerumahan = DB::table('getNomorRumahPerPerumahan')->get();
        $data = DB::table('getViewRumah')->get();
        return view('masterRumah', ['data' => $data, 'masterPerumahan' => $masterPerumahan,
                                    'msgType' => 'success', 'msgStr' => 'Data rumah berhasil dihapus']);
    }

    public function fetch(Request $request)
    {
        $field = $request->field;
        $value = $request->value;

        $data = DB::table('getViewRumah')->where($field, $value)
                                         ->get()[0];
        $Fasilitas = '';
        $Fasilitas .= $data->IsKeamanan==1?"Keamanan, ":"";
        $Fasilitas .= $data->IsTempatIbadah==1?"Tempat Ibadah, ":"";
        $Fasilitas .= $data->IsTaman==1?"Taman, ":"";
        $Fasilitas .= $data->IsMarket==1?"Market, ":"";
        $Fasilitas .= $data->IsOlahraga==1?"Tempat Olahraga, ":"";

        $output = '';
        $output .= '<div class="modal-body">';
        $output .= '<h3>'.$data->NamaRumah.'</h3>';
        $output .= '<hr>';
        $output .= '<div class="row float-center">';
        $output .=     '<div class="col"><img src="'.$data->GambarRumahTumb.'"></div>';
        $output .=     '<div class="col"><img src="'.$data->GambarDenahTumb.'"></div>';
        $output .= '</div>';
        $output .= '<hr>';
        $output .= '<div class="row">';
        $output .=     '<table class="table table-stripe table-responsive">';
        $output .=         '<tr>';
        $output .=             '<td>Perumahan</td>';
        $output .=             '<td>'.$data->NamaPerumahan.'</td>';
        $output .=         '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Kode</td>';
        $output .=             '<td>'.$data->KodeRumah.'</td>';
        $output .=         '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Nama</td>';
        $output .=             '<td>'.$data->NamaRumah.'</td>';
        $output .=         '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Tipe</td>';
        $output .=             '<td>'.number_format($data->Tipe).'</td>';
        $output .=         '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Luas Tanah</td>';
        $output .=             '<td>'.number_format($data->LuasTanah).'</td>';
        $output .=         '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Sertifikat</td>';
        $output .=             '<td>'.$data->Sertifikat.'</td>';
        $output .=         '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Fasilitas</td>';
        $output .=             '<td>'. $Fasilitas .'</td>';
        $output .=         '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Fasilitas Lain</td>';
        $output .=             '<td>'.$data->FasilitasLain.'</td>';
        $output .=          '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Akses tempat Umum</td>';
        $output .=             '<td>'.number_format($data->Akses).' menit</td>';
        $output .=         '</tr>';
        $output .=         '<tr>';
        $output .=             '<td>Harga</td>';
        $output .=             '<td>'.number_format($data->Harga).'</td>';
        $output .=          '</tr>';
        $output .=     '</table>';
        $output .= '</div>';
        $output .= '</div>';
        echo $output;
    }
}
