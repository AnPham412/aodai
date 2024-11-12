<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    //Brands
    Route::get('/admin/brands', [BrandController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brand/add', [BrandController::class, 'add_brand'])->name('admin.brand-add');
    Route::post('admin/brand/store', [BrandController::class, 'store_brand'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update', [BrandController::class, 'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete', [BrandController::class, 'brand_delete'])->name('admin.brand.delete');
});
