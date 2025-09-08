<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ---------------- Public Product view Routes ----------------
Route::get('products', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);
// ---------------- Public Authentication Routes ----------------
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// ---------------- Protected General Routes ----------------
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users/me', [AuthController::class, 'me']);
});

// ----------------Client Profile Routes ----------------
Route::middleware(['auth:sanctum', 'role:client'])->group(function () {
    Route::post('clients/profile', [ClientController::class, 'update']);
});
// --------------Admin-only routes to manage client profiles-----------------
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('admin/clients/{id}/profile', [ClientController::class, 'update']);
});

// ---------------- Vendor Profile Routes ----------------
Route::middleware(['auth:sanctum', 'role:vendor'])->group(function () {
    Route::post('vendors/profile', [VendorController::class, 'update']);
});

//----------------Admin-only routes to manage vendor profiles-------------
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('admin/vendors/{id}/profile', [VendorController::class, 'update']);
    Route::delete('admin/vendors/{id}/profile', [VendorController::class, 'destroy']);
});
//----------------Vendor-only routes to manage their products-------------
Route::middleware(['auth:sanctum', 'role:vendor', 'is_completed'])->group(function () {
    Route::post('products/create', [ProductController::class, 'store']);
    Route::put('product/{id}/update', [ProductController::class, 'update']);
    Route::delete('product/{id}/delete', [ProductController::class, 'destroy']);
});
//----------------Admin-only routes to manage Products-------------
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('products/create', [ProductController::class, 'store']);
    Route::put('product/{id}/update', [ProductController::class, 'update']);
    Route::delete('product/{id}/delete', [ProductController::class, 'destroy']);
});