<?php

use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\AuthCOntroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\Feature\ApiTokenPermissionsTest;

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
Route::post('user/login', [AuthCOntroller::class, 'login']);
Route::post('user/register', [AuthCOntroller::class, 'registeration']);
Route::get('category', function () {
    return response()->json([
        'message' => 'This is testing'
    ]);
})->middleware('auth:sanctum');
Route::get('post', [ApiPostController::class, 'allPost']);
Route::get('category', [ApiCategoryController::class, 'allCategory']);
Route::post('post/search', [ApiPostController::class, 'searchPost']);
Route::post('category/choose', [ApiCategoryController::class, 'chooseCategory']);
Route::post('post/postDetails', [ApiPostController::class, 'postDetails']);
