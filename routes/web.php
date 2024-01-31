<?php

use Illuminate\Support\Facades\Route;
use app\Models;
use App\Models\GastosPersonales;
use App\Http\Controllers\GastosPersonalesController;
use App\Http\Controllers\GastosOficinaController;
use App\Http\Controllers\GastosClubesController;
use App\Http\Controllers\CompromisosdepagoController;



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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');


   



Route::resource('/gastospersonales', GastosPersonalesController::class);

Route::resource('/gastosoficina', GastosOficinaController::class);

Route::resource('/gastosclubes', GastosClubesController::class);

Route::resource('/compromisos_pago', CompromisosdepagoController::class);









