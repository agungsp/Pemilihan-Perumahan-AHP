<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\AHP;

class C_HasilAnalisa extends Controller
{
    public function index(Request $request)
    {
        $matrix = array();
        if ($request->session()->has('login_state')) {
            if ($request->session()->has('admin_matrix')) {
                $standar = DB::table('getViewNilaiStandar')->get();
                $matrix = $request->session()->get('admin_matrix');
                $ahp = new AHP($matrix);
                foreach ($standar as $key => $value) {
                    $ahp->set_nilaiStandar(
                        $value->KodeRumah,[
                            $value->N_Harga,
                            $value->N_Akses,
                            $value->N_Sertifikat,
                            $value->N_Fasilitas,
                            $value->N_Tipe
                        ]
                    );
                }

                $ahp->run();
                $StatusKonsisten = $ahp->get_ci() > 1 ? 'Tidak Konsisten' : 'Konsisten';
                return view('hasilAnalisa', ['matrix' => $ahp->get_matrix(),
                                             'sumColumn' => $ahp->get_sumColumns(),
                                             'normalizeMatrix' => $ahp->get_normalizeMatrix(),
                                             'rowAverage' => $ahp->get_rowAverage(),
                                             'consistencyMatrix' => $ahp->get_consistencyMatrix(),
                                             'consistencyCheck' => $ahp->get_consistencyCheck(),
                                             'multipleScore' => $ahp->get_multipleScore(),
                                             'nilaiStandar' => $ahp->get_nilaiStandar(),
                                             'ranking' => $ahp->get_rank(),
                                             'msgType' => 'info',
                                             'msgStr' => 'Cek Konsistensi: ' . $StatusKonsisten]);
            }
            else {
                return view('hasilAnalisa', ['matrix' => [],
                                             'sumColumn' => [],
                                             'normalizeMatrix' => [],
                                             'rowAverage' => [],
                                             'consistencyMatrix' => [],
                                             'consistencyCheck' => [],
                                             'multipleScore' => [],
                                             'nilaiStandar' => [],
                                             'ranking' => [],
                                             'msgType' => 'warning',
                                             'msgStr' => 'Data ranking tidak ada. Silahkan melakukan penilaian kriteria.']);
            }
        } else {
            if ($request->session()->has('user_matrix')) {
                $standar = DB::table('getViewNilaiStandar')->get();
                $matrix = $request->session()->get('user_matrix');
                $ahp = new AHP($matrix);
                foreach ($standar as $key => $value) {
                    $ahp->set_nilaiStandar(
                        $value->KodeRumah,[
                            $value->N_Harga,
                            $value->N_Akses,
                            $value->N_Sertifikat,
                            $value->N_Fasilitas,
                            $value->N_Tipe
                        ]
                    );
                }

                $ahp->run();
                $StatusKonsisten = $ahp->get_ci() > 1 ? 'Tidak Konsisten' : 'Konsisten';
                return view('hasilAnalisa', ['matrix' => [],
                                             'sumColumn' => [],
                                             'normalizeMatrix' => [],
                                             'rowAverage' => [],
                                             'consistencyMatrix' => [],
                                             'consistencyCheck' => [],
                                             'multipleScore' => [],
                                             'nilaiStandar' => [],
                                             'ranking' => $ahp->get_rank(),
                                             'msgType' => 'info',
                                             'msgStr' => 'Cek Konsistensi: ' . $StatusKonsisten]);
            }
            else {
                return view('hasilAnalisa', ['matrix' => [],
                                             'sumColumn' => [],
                                             'normalizeMatrix' => [],
                                             'rowAverage' => [],
                                             'consistencyMatrix' => [],
                                             'consistencyCheck' => [],
                                             'multipleScore' => [],
                                             'nilaiStandar' => [],
                                             'ranking' => [],
                                             'msgType' => 'warning',
                                             'msgStr' => 'Data ranking tidak ada. Silahkan melakukan penilaian kriteria.']);
            }
        }
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
