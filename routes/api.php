<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\API\RegisterController;


Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});


// Public Routes
Route::apiResource('movies', MovieController::class)->only(['index', 'show']);
Route::apiResource('blog-posts', BlogPostController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);


// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('movies', MovieController::class)->except(['index', 'show']);
    Route::apiResource('blog-posts', BlogPostController::class)->except(['index', 'show']);
    Route::apiResource('genres', GenreController::class)->except(['index', 'show']);
});

