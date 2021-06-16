<?php

use App\Http\Controllers\Api\v1\CommunityController;
use App\Http\Controllers\Api\v1\EventController;
use App\Http\Controllers\Api\v1\FoodController as V1FoodController;
use App\Http\Controllers\Auth\{AuthController, ProfileUserController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
Route::post('/register', [AuthController::class,'register']);   
Route::post('/login', [AuthController::class,'login']);
Route::post('/login-oauth', [AuthController::class,'login_oauth']);
Route::post('/daftar', [AuthController::class, 'store']);

=======
>>>>>>> 7c9a1464456eab3d8fe1db25bbda69efa6c9c561
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


<<<<<<< HEAD
// Get by id
Route::get('/v1/foods/{food:id}/show', [V1FoodController::class, 'show']);
Route::get('/v1/community/{community:id}/show', [CommunityController::class, 'show']);

// POST
Route::post('/v1/community/create',[CommunityController::class, 'store']);
Route::post('/v1/food/create',[V1FoodController::class, 'store']);
Route::post('/v1/event/create',[EventController::class, 'store']);

// DELETE
Route::delete('/v1/community/{community:id}', [CommunityController::class,'destroy']);
Route::delete('/v1/foods/{food:id}', [V1FoodController::class,'destroy']);
=======
// Login
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/login-google', [AuthController::class,'login_google']);

>>>>>>> 7c9a1464456eab3d8fe1db25bbda69efa6c9c561

Route::group(['prefix' => 'v1','namespace' => 'Api\v1','middleware' => 'auth:sanctum'], function () {
    // return $request->user();

    /**
     * Searing foods and community
     */
    Route::get('/foods/{name}', [V1FoodController::class, 'searchFood']);
    Route::get('/community/{name}', [CommunityController::class, 'searchCommunity']);


    /**
     * Foods
     */
        Route::get('/foods', [V1FoodController::class, 'getAll']);
        Route::get('/foods/{food:id}/show', [V1FoodController::class, 'show']);
        Route::post('/food/create',[V1FoodController::class, 'store']);
        Route::delete('/foods/{food:id}', [V1FoodController::class,'destroy']);

    /**
     * Community
     */
        Route::get('/communities', [CommunityController::class,'getAll']);
        Route::get('/community/{community:id}/show', [CommunityController::class, 'show']);
        Route::post('/community/create',[CommunityController::class, 'store']);
        Route::delete('/community/{community:id}', [CommunityController::class,'destroy']);

     /**
      * Event
      */
        Route::get('/events', [EventController::class,'getAll']);
        Route::post('/event/create',[EventController::class, 'store']);

    // Profile
    Route::get('/get-profile', [ProfileUserController::class,'getProfile']);
    Route::post('/update-profile', [ProfileUserController::class, 'updateProfile']);
    Route::post('/logout',[AuthController::class,'logout']);
});
