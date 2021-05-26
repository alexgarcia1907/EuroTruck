<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Oferta;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Auth::routes();
Route::resource('users',\App\Http\Controllers\UserController::class);
Route::resource('empresa',\App\Http\Controllers\EmpresaController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/politica-de-cookies', 'App\Http\Controllers\HomeController@cookies');
Route::get('/aviso-legal', 'App\Http\Controllers\HomeController@avisolegal');
Route::get('/politica-de-privacidad', 'App\Http\Controllers\HomeController@politicaprivacidad');

Route::get('admin' , [App\Http\Controllers\HomeController::class, 'admin'])->middleware('admin');
Route::get('/ofertas', [App\Http\Controllers\AdminController::class, 'getOfertas'])->middleware('admin');
Route::get('/ofertas/disponibles', [App\Http\Controllers\RepartidorController::class, 'ofertasDisponibles'])->middleware('repartidor');
Route::get('/repartidor/{id}', [App\Http\Controllers\RepartidorController::class, 'show'])->middleware('repartidor');
Route::get('/repartidor/aceptaroferta/{id}', [App\Http\Controllers\RepartidorController::class, 'aceptarOferta'])->middleware('repartidor');
Route::get('/oferta/{id}/entregada', [App\Http\Controllers\RepartidorController::class, 'entregarOferta'])->middleware('repartidor');

Route::get('login/google', 'App\Http\Controllers\socialLogin@redirectGoogle');
Route::get('login/google/callback', 'App\Http\Controllers\socialLogin@CallbackGoogle');

/**
 * Ruta con funcion anónima para descargar usuarios en XML.(La libreria no permite redirigir a un controlador.)
 */
Route::get('/download/users', function () {
    $users = User::all();
    return response()->xml(['users' => $users->toArray()]);
})->middleware('admin');

/**
 * Ruta con funcion anónima para descargar ofertas en XML.(La libreria no permite redirigir a un controlador.)
 */
Route::get('/download/ofertas', function () {
    $ofertas = Oferta::all();
    return response()->xml(['ofertas' => $ofertas->toArray()]);
})->middleware('admin');