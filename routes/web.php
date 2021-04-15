<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StaffController;
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

Route::middleware([CheckLogin::class])->group(function(){ //'role:Super-admin

    Route::get('/sampleform',[DashBoardController::class, 'sample']);

    /*Dash Board*/
    Route::get('/dashboard',[DashBoardController::class, 'index'])->name('dashboard');

    /**** End Dash Board *******/

    /** Company */
    Route::get('/company',[CompanyController::class, 'index'])->name('company')->middleware('role_or_permission:Super-admin|company-full_access|company-read');

    Route::get('/listcompany',[CompanyController::class, 'listCompany'])->name('listcompany')->middleware('role_or_permission:Super-admin|company-full_access|company-read|company-read_write');

    Route::get('/showcompany/{id?}',[CompanyController::class, 'showCompany'])->name('showcompany')->middleware('role_or_permission:Super-admin|company-full_access|company-read|company-read_write');

    Route::post('/savecompany',[CompanyController::class, 'saveCompany'])->name('savecompany')->middleware('role_or_permission:Super-admin|company-full_access|company-read_write');

    Route::delete('/deletecompany',[CompanyController::class,'deleteCompany'])->name('deletecompany')->middleware('role_or_permission:Super-admin|company-full_access');

    Route::post('/savecomment',[CompanyController::class, 'saveComment'])->name('saveComment')->middleware('role_or_permission:Super-admin|company-full_access|company-read_write');

    Route::get('/showcomments',[CompanyController::class, 'showComments'])->name('showcomments')->middleware('role_or_permission:Super-admin|company-full_access|company-read|company-read_write');
    
    Route::delete('/deletecomment',[CompanyController::class,'deleteComment'])->name('deletecomment')->middleware('role_or_permission:Super-admin|company-full_access');
 

    /***** End Company******/

     /** Staff */ 
     Route::get('/staff',[StaffController::class, 'index'])->name('staff')->middleware('role_or_permission:Super-admin|staff-full_access');

     Route::get('/listcompanystaff',[StaffController::class, 'listStaff'])->name('listcompanystaff')->middleware('role_or_permission:Super-admin|company-full_access|company-read|company-read_write');
 
     Route::post('/savestaff',[StaffController::class, 'saveStaff'])->name('savestaff')->middleware('role_or_permission:Super-admin|company-full_access|company-read_write');
 
     Route::get('/getstaff',[StaffController::class,'getStaff'])->name('getstaff')->middleware('role_or_permission:Super-admin|company-full_access|company-read_write');

     Route::delete('/deletestaff',[StaffController::class,'deleteStaff'])->name('deletestaff')->middleware('role_or_permission:Super-admin|company-full_access');
 
     /***** End Staff******/    

    /** Users */
    Route::get('/users',[UserController::class, 'index'])->name('users')->middleware('role_or_permission:Super-admin|user-full_access|user-read');

    Route::get('/listusers',[UserController::class, 'listUsers'])->name('listusers')->middleware('role_or_permission:Super-admin|user-full_access|user-read');

    Route::get('/getuser',[UserController::class, 'getUser'])->name('getuser');

    Route::post('/saveuser',[UserController::class, 'saveUser'])->name('saveuser')->middleware('role_or_permission:Super-admin|user-full_access|user-read');

    /***** End Users******/

    /** Role & Permission */
    Route::get('/role',[RolePermissionController::class, 'index'])->name('role');

    Route::get('/showrole/{id?}',[RolePermissionController::class, 'showRole'])->name('showrole');

    Route::post('/saverole',[RolePermissionController::class, 'saveRole'])->name('saverole');

    /***** End Role & Permission *******/


});




//Route::get('/test',[UserController::class,'createuser']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
