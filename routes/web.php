<?php

use App\Models\Branch;
use App\Models\Report;
use App\Models\Employee;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',['branches' => Branch::all(),'employees'=>Employee::all(),'reports' => Report::all()]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/employee', 'App\Http\Controllers\EmployeeController@getAllEmployees');
Route::get('/show', 'App\Http\Controllers\EmployeeController@showEmployees');
Route::Post('/create/employee', 'App\Http\Controllers\EmployeeController@postEmployee' )->name('create.employee');
Route::put('/create/employee/{employeeId}', 'App\Http\Controllers\EmployeeController@createEmployee')->name('view.employee');
Route::delete('/delete/employee/{employeeId}','App\Http\Controllers\EmployeeController@deleteEmployee')->name('employee.delete');

Route::get('/branch', 'App\Http\Controllers\BranchController@getAllBranches')->middleware(['auth', 'verified']);
Route::get('/view', 'App\Http\Controllers\BranchController@viewBranches')->middleware(['auth', 'verified']);
Route::Post('/branch', 'App\Http\Controllers\BranchController@store' )->name('branch.store');
Route::put('/create/branch/{branchId}', 'App\Http\Controllers\BranchController@createBranch')->name('view.branch');
Route::delete('/delete/branch/{branchId}','App\Http\Controllers\BranchController@deleteBranch')->name('branch.delete');

Route::get('/reports', 'App\Http\Controllers\ReportController@showReports');
