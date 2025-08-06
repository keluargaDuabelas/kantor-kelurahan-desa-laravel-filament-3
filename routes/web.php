<?php

use Illuminate\Support\Facades\Route;
use App\Models\Domisili;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cetak/domisili/{id}', function ($id) {
        $data = Domisili::with('penduduk')->findOrFail($id);
         $pdf = Pdf::loadView('pdf.surat-domisili', compact('data'));
        return $pdf->stream('surat-domisili-'.$data->penduduk->nama.'.pdf');
    })->name('cetak.domisili');
});
