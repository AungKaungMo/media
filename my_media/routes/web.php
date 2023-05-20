<?php

use App\Http\Controllers\categoryController;
use App\Http\Controllers\listController;
use App\Http\Controllers\postController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\trendPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [profileController::class, 'homeProfile'])->name('dashboard');
    Route::post('admin/updatePf', [profileController::class, 'updateProfileAcc'])->name('adminPfUpdate');

    Route::get('admin/list', [listController::class, 'homeList'])->name('adminList');
    Route::get('admin/trendpost', [trendPostController::class, 'homeTrendpost'])->name('adminTrendpost');

    Route::get('admin/changePassword', [profileController::class, 'changingPassword'])->name('adminPswChange');
    Route::post('admin/updatepsw', [profileController::class, 'updatingPassword'])->name('adminPswUpdate');

    Route::get('admin/list/deletelist{id}', [listController::class, 'deleteAcc'])->name('deleteAdminList');
    Route::post('admin/listSearch', [listController::class, 'searchAdmin'])->name('adminListSearch');
    Route::get('admin/list/deleteCategory{id}', [categoryController::class, 'deleteCategory'])->name('deleteCategory');

    Route::get('admin/category', [categoryController::class, 'homeCategory'])->name('adminCategory');
    Route::post('admin/category/create', [categoryController::class, 'homeCategoryCreate'])->name('adminCategoryCreate');
    Route::post('admin/categorySearch', [categoryController::class, 'homeCategorySearch'])->name('adminCategorySearch');
    Route::get('admin/category/updateCategory{id}', [categoryController::class, 'updateCategory'])->name('updateCategory');
    Route::post('admin/category/newUpdatCategory', [categoryController::class, 'newCategory'])->name('newCategory');

    Route::get('admin/post', [postController::class, 'homePost'])->name('adminPost');
    Route::post('admin/post/posting', [postController::class, 'postNew'])->name('postNew');
    Route::get('admin/post/deletePost{id}', [postController::class, 'postDelete'])->name('postDelete');
    Route::get('admin/post/updatePost{id}', [postController::class, 'updatePost'])->name('updatePost');
    Route::post('admin/post/UpdatingPost', [postController::class, 'UpdatingPost'])->name('UpdatingPost');
});
