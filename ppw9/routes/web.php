<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;

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
Route::get('/kirim-email', [SendEmailController::class,
'index'])->name('kirim-email');

Route::post('/kirim-email', [SendEmailController::class, 'store']);

Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });
   
   Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');

   Route::get('/create-file', [FileController::class, 'createFile']);
   Route::get('/get-file', [FileController::class, 'getFile']);
   Route::get('/download-file', [FileController::class, 'downloadFile']);
   Route::get('/copy-file', [FileController::class, 'copyfile']);
   Route::get('/move-file', [FileController::class, 'movefile']); 
   
//    Route::post('/update-photo', [SendEmailController::class, 'updatePhoto'])->name('update-photo');
   Route::get('/kirim-email', [SendEmailController::class, 'index'])->name('kirim-email');
   Route::post('/kirim-email', [SendEmailController::class, 'store']);
   
   Route::middleware('auth')->post('/update-photo', [SendEmailController::class, 'updatePhoto'])->name('update-photo');
   Route::post('/update-photo', [SendEmailController::class, 'updatePhoto'])->name('update-photo');
   Route::post('/upload', 'FileController@upload')->name('upload');
