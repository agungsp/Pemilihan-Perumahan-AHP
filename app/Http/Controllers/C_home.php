<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class C_home extends Controller
{
    public function index()
    {
        $masterRumah = DB::table('masterrumahs')->orderByDesc('created_at') ->get();
        return view('home', ['masterRumah' => $masterRumah, 'msgType' => '', 'msgStr' => '']);
    }
}
