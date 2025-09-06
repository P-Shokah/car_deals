<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VendorController;

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
// ---------------- Public Authentication Routes ----------------
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// ---------------- Protected General Routes ----------------
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users/me', [AuthController::class, 'me']);
});

// ---------------- Student Profile Routes ----------------
Route::middleware(['auth:sanctum', 'role:client'])->group(function () {
    Route::post('clients/profile', [ClientController::class, 'update']);
});
// --------------Admin-only routes to manage student profiles-----------------
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('admin/clients/{id}/profile', [ClientController::class, 'update']);
});

// ---------------- Teacher Profile Routes ----------------
Route::middleware(['auth:sanctum', 'role:vendor'])->group(function () {
    Route::post('vendors/profile', [VendorController::class, 'update']);
});

//----------------Admin-only routes to manage teacher profiles-------------
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('admin/vendors/{id}/profile', [VendorController::class, 'update']);
    Route::delete('admin/vendors/{id}/profile', [VendorController::class, 'destroy']);
});