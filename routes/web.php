<?php

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
 
Route::get('/welcome', function () {
    return view('nav');
}); 

Route::get('/', 'PagesController@index');
Route::get('/input', 'PagesController@input');

// Route::get('/', function () {
//     return 'Hi There! You are welcome';
// });

Route::get('/personal', 'PagesController@personal');
Route::get('/customer', 'PagesController@customer');
Route::get('/technical', 'PagesController@technical');

Route::get('/compare', 'PagesController@compare');
// Route::get('/predict', 'PagesController@predict');
// Route::get('/database', 'PagesController@database');

Route::resource('/dashboard', 'DashController');
Route::resource('/predict', 'ComputationsController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
