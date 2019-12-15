<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class masterdeveloper extends Model
{
    protected $fillable = ['IdWilayah', 'KodeDeveloper', 'NamaDeveloper', 'Alamat', 'NoTelp', 'IdUserCreate', 'IdUserUpdate'];
}
