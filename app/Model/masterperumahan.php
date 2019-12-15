<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class masterperumahan extends Model
{
    protected $fillable = ['IdDeveloper', 'KodePerumahan', 'NamaPerumahan', 'Alamat', 'NoTelp', 'Fax', 'IdMUserCreate', 'IdMUserUpdate'];
}
