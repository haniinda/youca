<?php
declare(strict_types=1);
use App\Http\Controllers\AdvsController;
use App\Http\Controllers\AdvserviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\UserController;
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
Route::group(['middleware' => ['auth:sanctum' , 'verified']] , function () {
    Route::resource('/adv' , AdvsController::class);
    Route::resource('/service' , AdvserviceController::class );
    Route::post('/logout' ,[AuthController::class , 'logout']);
    Route::resource('/category' , CategoryApiController::class);
    Route::get('/get-profile' , [UserController::class , 'getprofile']);
    Route::post('/update-profile' , [UserController::class , 'updateprofile']);
//    Route::get('/delete-user/{id}' , [UserController::class , 'delete']);
    Route::post('/change-password' , [ChangePasswordController::class , 'changepassword']);
    Route::get('/get_advs_for_service/{id}' , [RelationController::class , 'get_advs_for_service']);
    Route::get('/get_advs_for_category/{id}' , [RelationController::class , 'get_advs_for_category']);
    Route::get('/services_category/{id}' ,[RelationController::class,'servicecategory']);
    Route::get('/search_for_adv/{service_id}/{category_id}' , [AdvsController::class , 'search']);
//    Route::resource( '/company' , CompanyController::class);
//    Route::get('/get_company_by_type' ,[RelationController::class , 'get_company_by_type']);
//    Route::resource('/add-service-category' , AdvserviceCategoryController::class);
});

//////////////////login and register ///////////////////////////////////
Route::get('/register' ,[AuthController::class , 'register']);///->middleware('verified');
Route::post('/register' ,[AuthController::class , 'register']);//->middleware('verified');
Route::post('/login' ,[AuthController::class , 'login']);
//Route::post('/logout' ,[AuthController::class , 'logout'])->middleware(['auth:sanctum']);

//////////////////////check user ///////////////////////////////////////
Route::post('/emailVerification' , [EmailVerificationController::class , 'sendverificationemail'])
    ->name('verification.notice')->middleware(['auth:sanctum']);;
Route::post('/verify-email' ,[EmailVerificationController::class ,'verify'] )
    ->name('verification.verify')->middleware(['auth:sanctum']);

Route::post('/forgot-password' , [NewPasswordController::class , 'sendResetLinkResponse']);
Route::post('/reset-password' , [NewPasswordController::class , 'sendResetResponse']);//->name('password.reset');

//////////////////all about advs //////////////////////////////////////
// Route::resource('/adv' , AdvsController::class);
// Route::resource('/service' , AdvserviceController::class );
//Route::get('/get_advs_for_service/{id}' , [RelationController::class , 'get_advs_for_service']);
//Route::resource('/category' , CategoryController::class);
//Route::get('/get_advs_for_category/{id}' , [RelationController::class , 'get_advs_for_category']);
//Route::get('/services_category/{id}' ,[RelationController::class,'servicecategory']);




//////////////user profile //////////////////////////////////////////
//Route::get('/get-profile' , [UserController::class , 'getprofile']);
// Route::post('/update-profile' , [UserController::class , 'updateprofile']);
//Route::get('/search_for_adv/{id}' , [AdvsController::class , 'search']);

//Route::group(['middleware' => [ 'verified']] , function () {
// Route::get('/get_advs_for_service/{id}' , [RelationController::class , 'get_advs_for_service']);
// Route::get('/get_advs_for_category/{id}' , [RelationController::class , 'get_advs_for_category']);
// Route::get('/services_category/{id}' ,[RelationController::class,'servicecategory']);
// Route::get('/search_for_adv/{id}' , [AdvsController::class , 'search']);

//  });
