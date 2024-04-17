<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileManagerController;

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


Route::get('/', [FileManagerController::class, 'loginForm']);
Route::get('/register', [FileManagerController::class, 'UserRegister']);
Route::post('/user-register', [FileManagerController::class, 'UserCreate']);

Route::post('/login-check', [FileManagerController::class, 'loginCheck'])->name('login_check');


Route::get('filemanager', [FileManagerController::class, 'index']);
Route::post('file-upload', [FileManagerController::class, 'FileUpload'])->name('file_upload');



Route::get('sign-out', [FileManagerController::class, 'signOut'])->name('sign_out');


