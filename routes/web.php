<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\StaffDepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Requisition\RequisitionController;
use App\Http\Controllers\Requisition\RequisitionItemController;
use App\Http\Livewire\MakeRequisition;
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


//Route::get('/', function () {
//    return view('home');
//});

Auth::routes();

Route::group(['middleware' => [  'auth' ]], function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    //    Requisition
    Route::get('/requisitions', [RequisitionController::class, 'index'])->name('requisitions.index');
    Route::get('/requisitions/createPDF/{id}', [RequisitionController::class, 'createPDF'])->name('requisitions.pdf');
    Route::get('/requisitions/show/{id}', [RequisitionController::class, 'show'])->name('requisitions.show');
    Route::get('/requisitions/create', [RequisitionController::class, 'create'])->name('requisitions.create');
    Route::post('/requisitions/store', [RequisitionController::class, 'store'])->name('requisitions.store');
    Route::post('/requisition_items/', [RequisitionItemController::class, 'store'])->name('requisition_items');

//    Admin

//    Departments
    Route::get('/admin/assign_staff_to_department',  [StaffDepartmentController::class, 'index'])->name('assign_staff_to_department');
    Route::post('/admin/assign_staff_to_department',  [StaffDepartmentController::class, 'store'])->name('save_assigned_staff_to_department');

    Route::resource('/admin/departments',  DepartmentController::class);
    Route::resource('/admin/users',  UserController::class);
    Route::resource('/admin/roles',  RolesController::class);
    Route::resource('/admin/permissions',  PermissionsController::class);

//    Route::get('/make_requisition', [RequisitionController::class, 'make_requisition'])->name('make_requisitions');
});
