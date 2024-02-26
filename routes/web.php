<?php

use App\Http\Controllers\Frontend\Auth\AuthController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

// $tables = DB::select('SHOW TABLES');
//     dump(DB::connection()->getDatabaseName());
//     // return view('welcome');
//     dd($tables);
});

// Route::get('/login', [AuthController::class, 'loginView']);

// Route::post('/login', [AuthController::class, 'login'])->name('login.post');
