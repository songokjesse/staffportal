<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\LeaveAllocationController;
use App\Http\Controllers\Admin\LeaveCategoryController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\StaffDepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Requisition\RequisitionController;
use App\Http\Controllers\Requisition\RequisitionItemController;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::get('/approvals/{id}', [ApprovalController::class, 'show'])->name('approvals.show');
    Route::post('/approvals/', [ApprovalController::class, 'store'])->name('approvals.store');
//    Admin

    //leave Category
    Route::get('/leave_category', [LeaveCategoryController::class, 'index'])->name('leaveCategory.index');
    Route::get('/leave_category/create', [LeaveCategoryController::class, 'create'])->name('leaveCategory.create');
    Route::post('/leave_category/store', [LeaveCategoryController::class, 'store'])->name('leaveCategory.store');

    //leave Allocation
    Route::get('/leave_allocation', [LeaveAllocationController::class, 'index'])->name('leave_allocation.index');
    Route::get('/leave_allocation/create', [LeaveAllocationController::class, 'create'])->name('leave_allocation.create');
    Route::post('/leave_allocation/', [LeaveAllocationController::class, 'store'])->name('leave_allocation.store');

//    Departments
    Route::get('/admin/assign_staff_to_department',  [StaffDepartmentController::class, 'index'])->name('assign_staff_to_department');
    Route::post('/admin/assign_staff_to_department',  [StaffDepartmentController::class, 'store'])->name('save_assigned_staff_to_department');

    Route::resource('/admin/departments',  DepartmentController::class);
    Route::resource('/admin/users',  UserController::class);
    Route::resource('/admin/roles',  RolesController::class);
    Route::resource('/admin/permissions',  PermissionsController::class);

    //site wide notification
    Route::get('/admin/site-notification',function () {
    return view('notification.index');
    })->name('sitewide-notification');

//    Route::get('/make_requisition', [RequisitionController::class, 'make_requisition'])->name('make_requisitions');
});
