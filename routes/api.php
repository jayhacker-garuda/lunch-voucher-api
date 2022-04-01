<?php

use App\Http\Controllers\api\Admin\Crud\AdminController;
use App\Http\Controllers\api\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\api\Canteen\LoginController as CanteenLoginController;
use App\Http\Controllers\api\Parent\Crud\ParentController;
use App\Http\Controllers\api\Parent\LoginController as ParentLoginController;
use App\Http\Controllers\api\Parent\RegisterController as ParentRegisterController;
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

Route::post('admin/login',[AdminLoginController::class, 'login']);
Route::post('canteen/login',[CanteenLoginController::class, 'login']);
Route::post('parent/login',[ParentLoginController::class, 'login']);
Route::post('parent/register',[ParentRegisterController::class, 'register']);




Route::group(['middleware' => ['auth:sanctum']], function() {


    Route::post('admin/create/canteen-staff',[AdminController::class, 'create']);

    Route::post('parent/add/child',[ParentController::class, 'create']);

    Route::post('parent/check',[ParentController::class, 'active']);

    // Delete Token And Logout User
    Route::get('admin/logout', [AdminLoginController::class, 'logout']);
    Route::get('canteen/logout', [CanteenLoginController::class, 'logout']);
    Route::get('parent/logout', [ParentLoginController::class, 'logout']);

});