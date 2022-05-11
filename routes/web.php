<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckSuperAdminMiddleware;
use Illuminate\Support\Facades\Route;

//admin
    Route::get('login',[AuthController::class, 'login'])->name('login');
    Route::get('signup',[AuthController::class, 'signup'])->name('signup');
    Route::post('login',[AuthController::class, 'processLogin'])->name('process_login');
    Route::group([
        'middleware' => CheckLoginMiddleware::class,
    ],function(){
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::resource('courses', CourseController::class)->except([
            'show',
            'destroy',
        ]);
        Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');
        Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('courses.api.name');

    });
    Route::group([
        'middleware' => CheckSuperAdminMiddleware::class,
    ],function(){

        Route::delete('courses/{courses}', [CourseController::class, 'destroy'])->name('courses.destroy');

    });

Route::group([
    'middleware' => CheckLoginMiddleware::class,
],function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('category', CategoryController::class)->except([
        'show',
        'destroy',
    ]);
    Route::get('category/api', [CategoryController::class, 'api'])->name('category.api');
    Route::get('category/api/name', [CategoryController::class, 'apiName'])->name('category.api.name');

});
Route::group([
    'middleware' => CheckSuperAdminMiddleware::class,
],function(){

    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

});







