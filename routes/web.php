<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashBoardController;
use App\Http\Middleware\CheckLogin;

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
   
// })->name('dashboard');

Route::get('/',[LoginController::class,'index']);

Route::post('/login',[LoginController::class,'login'])->name('login');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::middleware([CheckLogin::class])->group(function(){ 

    Route::get('/sampleform',[DashBoardController::class, 'sample']);

    /*Dash Board*/
    Route::get('/dashboard',[DashBoardController::class, 'index'])->name('dashboard');

    /********/

    
    /** Company */
    Route::get('/company',[CompanyController::class, 'index'])->name('company');

    Route::get('/listcompany',[CompanyController::class, 'listCompany'])->name('listcompany');

    Route::get('/showcompany',[CompanyController::class, 'showCompany'])->name('showcompany');

    Route::post('/savecompany',[CompanyController::class, 'saveCompany'])->name('savecompany');


    /******/


});




//Route::get('/test',[UserController::class,'createuser']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
