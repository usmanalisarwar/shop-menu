<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\MenuGenerateController;
use App\Http\Controllers\admin\MenuImageController;
use App\Http\Controllers\admin\CategoryController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/menu/{slug}', [MenuGenerateController::class, 'generateQRCode'])->name('generate.qrcode');
Route::get('/menu-book/{slug}', [MenuGenerateController::class, 'showBook'])->name('book.show');
Auth::routes(); // This includes the default authentication routes

// Menus routes with authentication middleware
Route::group(['middleware' => ['auth']], function () {
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::post('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('menus/{id}', [MenuController::class, 'destroy'])->name('menus.delete');
    Route::get('/logout', [MenuController::class, 'logout'])->name('admin.logout');
    Route::get('menus/{id}/images', [MenuController::class, 'getMenuImages']);
    Route::get('menus/{id}/pdf', [MenuController::class, 'generatePdf'])->name('menus.pdf');
    Route::get('/menus/pdf/all', [MenuController::class, 'generatePdfAll'])->name('menus.pdfAll');

    // Menu-images routes
    Route::post('/upload-menu-image', [MenuImageController::class, 'create'])->name('menu-images.create');
    Route::get('/dashboard', [MenuImageController::class, 'index'])->name('admin.dashboard');

    //Categories routes
    Route::get('/categories',[CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories',[CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit',[CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
    Route::get('/categories/subcategories', [CategoryController::class, 'getSubCategories'])->name('categories.subcategories');

});

