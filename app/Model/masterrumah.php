<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class masterrumah extends Model
{
    protected $fillable = ['IdPerumahan', 'KodeRumah', 'NamaRumah', 'IsKeamanan', 'IsTempatIbadah', 'IsTaman', 'IsMarket', 'IsOlahraga', 'FasilitasLain', 'Harga', 'Akses', 'Sertifikat', 'Tipe', 'LuasTanah', 'GambarRumah', 'GambarRumahTumb', 'GambarDenah', 'GambarDenahTumb', 'IdUserCreate', 'IdUserUpdate'];
}
