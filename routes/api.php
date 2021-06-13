<?php

use App\Http\Controllers\Api\v1\CommunityController;
use App\Http\Controllers\Api\v1\EventController;
use App\Http\Controllers\Api\v1\FoodController as V1FoodController;
use App\Http\Controllers\Auth\{AuthController, ProfileUserController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// GET
Route::get('/v1/foods', [V1FoodController::class, 'getAll']);
Route::get('/v1/communities', [CommunityController::class,'getAll']);
Route::get('/v1/events', [EventController::class,'getAll']);

// POST
Route::post('/v1/community/create',[CommunityController::class, 'store']);
Route::post('/v1/food/create',[V1FoodController::class, 'store']);
Route::post('/v1/event/create',[EventController::class, 'store']);

Route::group(['prefix' => 'v1','namespace' => 'Api\v1','middleware' => 'auth:sanctum'], function () {
    // return $request->user();

    Route::get('/get-profile', [ProfileUserController::class,'getProfile']);
    Route::post('/update-profile', [ProfileUserController::class, 'updateProfile']);

    Route::post('/logout',[AuthController::class,'logout']);
});
