<?php

use Intervention\Image\Image;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });


Route::get('/', 'C_home@index');
Route::get('/login', 'C_login@index');
Route::get('/logout', 'C_login@logout');
Route::put('/login', 'C_login@login');

Route::get('/register', 'C_register@index');
Route::put('/register', 'C_register@insert');

Route::get('/masterDeveloper', 'C_MasterDeveloper@index');
Route::put('/masterDeveloper', 'C_MasterDeveloper@insert');
Route::get('/masterDeveloper/eid{IdDeveloper}', ['uses' => 'C_MasterDeveloper@edit']);
Route::get('/masterDeveloper/did{IdDeveloper}', ['uses' => 'C_MasterDeveloper@delete']);
Route::put('/masterDeveloper/save', 'C_MasterDeveloper@save');

Route::get('/masterPerumahan', 'C_MasterPerumahan@index');
Route::put('/masterPerumahan', 'C_MasterPerumahan@insert');
Route::get('/masterPerumahan/eid{IdPerumahan}', ['uses' => 'C_MasterPerumahan@edit']);
Route::get('/masterPerumahan/did{IdPerumahan}', ['uses' => 'C_MasterPerumahan@delete']);
Route::put('/masterPerumahan/save', 'C_MasterPerumahan@save');

Route::get('/masterRumah', 'C_MasterRumah@index');
Route::put('/masterRumah', 'C_MasterRumah@insert');
Route::get('/masterRumah/eid{IdRumah}', ['uses' => 'C_MasterRumah@edit']);
Route::get('/masterRumah/did{IdRumah}', ['uses' => 'C_MasterRumah@delete']);
Route::put('/masterRumah/save', 'C_MasterRumah@save');
Route::post('/masterRumah', 'C_MasterRumah@fetch')->name('C_MasterRumah.fetch');

Route::get('/penilaianKriteria', 'C_PenilaianKriteria@index');
Route::put('/penilaianKriteria', 'C_PenilaianKriteria@insert');

Route::get('/hasilAnalisa', 'C_HasilAnalisa@index');
Route::post('/hasilAnalisa', 'C_HasilAnalisa@fetch')->name('C_HasilAnalisa.fetch');

Route::get('storage/{filename}', function ($filename)
{
    return Image::make(storage_path('public/' . $filename))->response();
});
