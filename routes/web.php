<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

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
//     return view('welcome');
// });

Route::get('/', [ImageController::class, 'index']);
Route::post('/ajaxuploadimg',[ImageController::class, 'imguploadpost'])->name('upload');
Route::post('/store', [ImageController::class, 'store'])->name('store');
