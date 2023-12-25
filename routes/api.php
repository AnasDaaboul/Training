<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\PurchaseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('signup' , [UserController::class , 'store'])->name('signup');
Route::post('login' , [UserController::class , 'login'])->name('login');
Route::post('logout' , [UserController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('createCourse' , [CourseController::class , 'store']);
Route::post('courses' , [CourseController::class] , 'index');
Route::post('SoftDeleteCourse' , [CourseController::class , 'softDelete']);

Route::post('packages' , [PackageController::class] , 'index');
Route::post('createPackage' , [PackageController::class , 'store']);
Route::post('SoftDeletePackage' , [PackageController::class , 'softDelete']);

Route::post('makePurchase' , [PurchaseController::class, 'store']);
Route::post('verifyLogin' , [UserController::class , 'verifyLogin']);
