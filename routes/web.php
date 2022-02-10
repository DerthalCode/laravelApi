<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CommentControler;

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
Route::get('/',[CompanyController::class,'index']);
Route::get('/add-company',[CompanyController::class, 'addCompany']);
Route::post('/store',[CompanyController::class,'storeCompany']);
Route::get('/company/{company}',[CompanyController::class, 'showCompany']);
Route::get('/delete/company/{company}',[CompanyController::class, 'deleteCompany']);
Route::get('/update/company/{company}',[CompanyController::class, 'updateCompany']);
Route::post('/update/{company}',[CompanyController::class,'storeUpdate']);
Route::get('/import-company',[CompanyController::class, 'importCompany']);
Route::post('/checkImport', [CompanyController::class, 'processImport']);
Route::post('/storeImport', [CompanyController::class, 'storeImport'])->name('store.import'); //issaugo csv i db
Route::post('/', [CompanyController::class, 'Import']);
Route::post('/company/{company}/comment', [CompanyController::class, 'create']);
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
