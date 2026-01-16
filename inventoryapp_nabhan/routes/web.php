<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;


    Route::get('/', [DashboardController::class, 'home'])->name('home')->middleware('auth');
    Route::get('/form', [FormController::class, 'form']);
    Route::post('/welcome', [FormController::class, 'welcome']);

    Route::get('/profile', [ProfileController::class, 'getProfile'])->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth');
    Route::post('/profile', [ProfileController::class, 'store'])->middleware('auth');

    Route::middleware('auth', 'admin')->group(function () {
        //CRUD Categories
        // C => Create Data
        Route::get('/categories/create', [CategoriesController::class, 'create'] );
        Route::post('/categories', [CategoriesController::class, 'store'] );

        //R => Read Data
        Route::get('/categories', [CategoriesController::class, 'index']);
        Route::get('/categories/{id}', [CategoriesController::class, 'show']);

        //U => Update Data
        Route::get('/categories/{id}/edit' , [CategoriesController::class, 'edit']);
        Route::put('/categories/{id}' , [CategoriesController::class, 'update']);

        //D => Delete Data
        Route::delete('/categories/{id}' , [CategoriesController::class, 'destroy']);
    });

    //CRUD Products
    Route::resource('/product', ProductController::class);

    Route::middleware('guest')->group(function () {
        //Auth Routes
        //register
        Route::get('/register', [AuthController::class, 'formregister']);
        Route::post('/register', [AuthController::class, 'register']);

        //login
        Route::get('/login', [AuthController::class, 'formlogin']);
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    //logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::middleware('auth')->group(function () {
        //Get List Products
        Route::get('/transaction', [TransactionController::class, 'index']);
        Route::get('/transaction/create', [TransactionController::class, 'create']);
        Route::post('/transaction', [TransactionController::class, 'store']);

        //Admin
        Route::put('/transaction/{id}', [TransactionController::class, 'update']);
    });