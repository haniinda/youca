<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/', [\App\Http\Controllers\HomeWebController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth:sanctum', 'accountType']], function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/services', [App\Http\Controllers\AdvserviceًWebController::class, 'index']);
        Route::get('/services/create', [App\Http\Controllers\AdvserviceًWebController::class, 'create']);
        Route::post('/services', [App\Http\Controllers\AdvserviceًWebController::class, 'store']);
        Route::get('/services/edit/{id}', [App\Http\Controllers\AdvserviceًWebController::class, 'edit']);
        Route::post('/services/edit/{id}', [App\Http\Controllers\AdvserviceًWebController::class, 'update']);
        Route::get('/services/categories/{id}', [App\Http\Controllers\AdvserviceًWebController::class, 'categories']);
        Route::post('/services/categories/{id}', [App\Http\Controllers\AdvserviceًWebController::class, 'updateCategories']);
        Route::get('/services/delete/{id}', [App\Http\Controllers\AdvserviceًWebController::class, 'delete']);
        Route::post('/services/delete/{id}', [App\Http\Controllers\AdvserviceًWebController::class, 'destroy']);
        Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
        Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create']);
        Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store']);
        Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
        Route::post('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
        Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete']);
        Route::post('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
        Route::get('/roles', [App\Http\Controllers\RoleWebController::class, 'index']);
        Route::get('/roles/create', [App\Http\Controllers\RoleWebController::class, 'create']);
        Route::post('/roles', [App\Http\Controllers\RoleWebController::class, 'store']);
        Route::get('/roles/edit/{id}', [App\Http\Controllers\RoleWebController::class, 'edit']);
        Route::post('/roles/edit/{id}', [App\Http\Controllers\RoleWebController::class, 'update']);
        Route::get('/roles/delete/{id}', [App\Http\Controllers\RoleWebController::class, 'delete']);
        Route::post('/roles/delete/{id}', [App\Http\Controllers\RoleWebController::class, 'destroy']);
        Route::get('/users', [App\Http\Controllers\UserWebController::class, 'index']);
        Route::get('/users/create', [App\Http\Controllers\UserWebController::class, 'create']);
        Route::post('/users', [App\Http\Controllers\UserWebController::class, 'store']);
        Route::get('/users/delete/{id}', [App\Http\Controllers\UserWebController::class, 'delete']);
        Route::post('/users/delete/{id}', [App\Http\Controllers\UserWebController::class, 'destroy']);
        Route::get('/users/edit/{id}', [App\Http\Controllers\UserWebController::class, 'edit']);
        Route::post('/users/edit/{id}', [App\Http\Controllers\UserWebController::class, 'update']);
        Route::post('/users/changepassword/{id}', [App\Http\Controllers\UserWebController::class, 'UpdatePassword']);
        Route::get('/users/changepassword/{id}', [App\Http\Controllers\UserWebController::class, 'changePassword']);
        Route::get('/Clients', [App\Http\Controllers\CompanyController::class, 'index']);
        Route::get('/Clients/create', [App\Http\Controllers\CompanyController::class, 'create']);
        Route::post('/Clients/create', [App\Http\Controllers\CompanyController::class, 'store']);
        Route::get('/Clients/edit/{id}', [App\Http\Controllers\CompanyController::class, 'edit']);
        Route::post('/Clients/edit/{id}', [App\Http\Controllers\CompanyController::class, 'update']);
        Route::get('/Clients/delete/{id}', [App\Http\Controllers\CompanyController::class, 'delete']);
        Route::post('/Clients/delete/{id}', [App\Http\Controllers\CompanyController::class, 'destroy']);
        Route::get('/Clients/users/{id}', [App\Http\Controllers\CompanyController::class, 'users']);
        Route::post('/Clients/users/{id}', [App\Http\Controllers\CompanyController::class, 'updateUsers']);
        Route::get('/companyTypes', [App\Http\Controllers\TypeController::class, 'index']);
        Route::get('/companyTypes/create', [App\Http\Controllers\TypeController::class, 'create']);
        Route::post('/companyTypes', [App\Http\Controllers\TypeController::class, 'store']);
        Route::get('/companyTypes/edit/{id}', [App\Http\Controllers\TypeController::class, 'edit']);
        Route::post('/companyTypes/edit/{id}', [App\Http\Controllers\TypeController::class, 'update']);
        Route::get('/companyTypes/delete/{id}', [App\Http\Controllers\TypeController::class, 'delete']);
        Route::post('/companyTypes/delete/{id}', [App\Http\Controllers\TypeController::class, 'destroy']);

    });
    Route::get('/ADS', [App\Http\Controllers\AdvsWebController::class, 'index']);
    Route::get('/ADS/create', [App\Http\Controllers\AdvsWebController::class, 'create']);
    Route::post('/ADS/create', [App\Http\Controllers\AdvsWebController::class, 'store']);
    Route::get('/ADS/edit/{id}', [App\Http\Controllers\AdvsWebController::class, 'edit']);
    Route::post('/ADS/edit/{id}', [App\Http\Controllers\AdvsWebController::class, 'update']);
    Route::get('/ADS/delete/{id}', [App\Http\Controllers\AdvsWebController::class, 'delete']);
    Route::post('/ADS/delete/{id}', [App\Http\Controllers\AdvsWebController::class, 'destroy']);
});
Route::get('logout', [App\Http\Controllers\UserWebController::class, 'logout'])->middleware('auth');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeWebController::class, 'index'])->name('home');


Route::get('/home', [\App\Http\Controllers\HomeWebController::class, 'index'])->name('home');
Route::get('/403', function () {
    dd("forbidden");
})->name('403');


//
//Route::get('/forgot-password', function () {
//    return view('auth.forgot-password');
//})->middleware('guest')->name('password.request');
//
//
//Route::post('/forgot-password', function (Request $request) {
//    $request->validate(['email' => 'required|email']);
//
//    $status = Password::sendResetLink(
//        $request->only('email')
//    );
//
//    return $status === Password::RESET_LINK_SENT
//        ? back()->with(['status' => __($status)])
//        : back()->withErrors(['email' => __($status)]);
//})->middleware('guest')->name('password.email');
//
//
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');
//
//
Route::post('/reset-password',[\App\Http\Controllers\UserWebController::class, 'forgetPassword'])->middleware('guest')->name('password.update');
