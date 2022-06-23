<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('temperature/',['uses' => 'App\Http\Controllers\TemperatureController@store']);
Route::get('temperatures/',['uses' => 'App\Http\Controllers\TemperatureController@getTemperature'])->middleware(['auth:api']);

Route::post('auth',['uses' => 'App\Http\Controllers\AuthController@login']);

Route::delete('branch/{branchId}',['uses' => 'App\Http\Controllers\BranchController@deleteBranch']);
Route::delete('employee/{employeeId}',['uses' => 'App\Http\Controllers\EmployeeController@deleteEmployee']);
Route::put('branch/{branchId}',['uses' => 'App\Http\Controllers\BranchController@deleteBranch']);
