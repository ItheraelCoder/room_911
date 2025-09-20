<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Auth\AdminController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[AccessController::class,'showAccessForm'])->name('access.form');
Route::post('/access_attempt',[AccessController::class,'handleAccess'])->name('access.attempt');

Route::get('admin/login',[AdminController::class,'showLoginForm'])->name('admin.login');
Route::post('admin/login',[AdminController::class,'login']);

Route::get('admin/register',[AdminController::class,'showRegisterForm'])->name('admin.register');
Route::post('admin/register',[AdminController::class,'register']);


Route::middleware(['auth:admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard',[EmployeeController::class,'index'])->name('admin.dashboard');
    Route::resource('employees',EmployeeController::class)->except(['show']);
    Route::post('/employees/import',[EmployeeController::class,'import'])->name('employees.import');
    Route::get('/employees/{employee}/history',[EmployeeController::class,'showHistory'])->name('employees.history');
    Route::get('/employees/{employee}/history/pdf',[EmployeeController::class,'downloadHistoryPdf'])->name('employees.history.pdf');
    Route::post('/logout',[AdminController::class,'logout'])->name('admin.logout');
});