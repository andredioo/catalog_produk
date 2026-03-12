<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoController;
use App\Models\Foto;
use App\Http\Controllers\KomentarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;





Route::get('/', function () {
    return view('welcome');
});



Route::get('/admin/dashboard', [FotoController::class, 'index'])->name('admin.dashboard');

Route::delete('/foto/{id}', [FotoController::class, 'destroy'])->name('foto.destroy');
Route::post('/foto/store', [FotoController::class,'store']);
Route::post('/foto/update/{id}', [FotoController::class,'update']);
Route::get('/foto/delete/{id}', [FotoController::class,'delete']);
Route::post('/komentar/balas/{id}', [KomentarController::class, 'balas']);
Route::post('/komentar/balas/{id}', [KomentarController::class, 'balas']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard')->middleware('user');
});
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
});
Route::get('/admin/dashboard', [FotoController::class,'index']);
Route::post('/foto/store', [FotoController::class,'store']);
Route::get('/foto/delete/{id}', [FotoController::class,'destroy']);
Route::get('/user/dashboard', function () {
    $fotos = Foto::all();
    return view('user.dashboard', compact('fotos'));
});
Route::post('/komentar/store', [KomentarController::class,'store']);

Route::post('/komentar/store', [KomentarController::class,'store']);

Route::get('/user/dashboard', function () {
    $fotos = Foto::all();
    return view('user.dashboard', ['fotos' => $fotos]);
});
Route::get('/admin/dashboard', [FotoController::class,'index']);
Route::get('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');

});
Route::get('/komentar/delete/{id}', [KomentarController::class,'destroy']);
Route::get('/komentar/delete/{id}', [KomentarController::class,'destroy']);
Route::post('/komentar/balas/{id}', [KomentarController::class,'balas']);
Route::post('/komentar/balas/{id}', [KomentarController::class,'balas']);