<?php

use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\SekretariatController;
use App\Http\Controllers\SesiController;
use App\Models\matakuliah;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sekretariat/test',[MatakuliahController::class,'viewMatakuliah']);

Route::resource('sekretariat',MatakuliahController::class);


// Route::get('/sekretariat/view-matakuliah', 'SekretariatController@viewMatakuliah')->name('view-matakuliah');
