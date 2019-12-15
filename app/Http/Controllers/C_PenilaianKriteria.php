<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_PenilaianKriteria extends Controller
{
    public function index()
    {
        $data = DB::table('masterkriterias')->get();
        return view('penilaianKriteria', ['data' => $data, 'msgType' => '', 'msgStr' => '']);
    }

    public function insert(Request $request)
    {
        $user_request = array();
        $user_matrix = array();
        $admin_request = array();
        $admin_matrix = array();

        $matrix = array();

        $data = DB::table('masterkriterias')->get();
        for ($i=1; $i <= count($data); $i++) {
            $row = array();
            for ($j=1; $j <= count($data); $j++) {
                if ($i == $j) {
                    array_push($row, 1);
                } else if ($i < $j) {
                    array_push($row, $request->get($i.'_'.$j));
                    if ($request->session()->has('login_state')) {
                        $admin_request[$i.'_'.$j] = $request->get($i.'_'.$j);
                    } else {
                        $user_request[$i.'_'.$j] = $request->get($i.'_'.$j);
                    }
                } else if ($i > $j) {
                    array_push($row, $matrix[$j-1][$j-1]/$matrix[$j-1][$i-1]);
                }
            }
            array_push($matrix, $row);
        }

        if ($request->session()->has('login_state')) {
            $admin_matrix = $matrix;
            $request->session()->put('admin_request', $admin_request);
            $request->session()->put('admin_matrix', $admin_matrix);
        } else {
            $user_matrix = $matrix;
            $request->session()->put('user_request', $user_request);
            $request->session()->put('user_matrix', $user_matrix);
        }

        $data = DB::table('masterkriterias')->get();
        return view('penilaianKriteria', ['data' => $data, 'msgType' => 'success', 'msgStr' => 'Penilaian kriteria berhasil disimpan.']);
    }
}
