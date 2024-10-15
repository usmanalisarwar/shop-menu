<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\MenuGenerateController;
use App\Http\Controllers\admin\MenuImageController;
use App\Http\Controllers\admin\MenuItemController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/menu/{slug}', [MenuGenerateController::class, 'generateQRCode'])->name('generate.qrcode');
Route::get('/menu-book/{slug}', [MenuGenerateController::class, 'showBook'])->name('book.show');
Auth::routes(); // This includes the default authentication routes

// Menus routes with authentication middleware
Route::group(['middleware' => ['auth']], function () {
    // Menu routes
    Route::get('/menus', [MenuController::class, 'index'])
        ->name('menus.index')
        ->middleware(['checkRolePermission:menus,read-menu']);
    Route::get('/menus/create', [MenuController::class, 'create'])
        ->name('menus.create')
        ->middleware(['checkRolePermission:menus,add-new-menu']);
    Route::post('/menus', [MenuController::class, 'store'])
        ->name('menus.store')
        ->middleware(['checkRolePermission:menus,add-new-menu']);
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])
        ->name('menus.edit')
        ->middleware(['checkRolePermission:menus,edit-menu']);
    Route::post('/menus/{menu}', [MenuController::class, 'update'])
        ->name('menus.update')
        ->middleware(['checkRolePermission:menus,edit-menu']);
    Route::delete('/menus/{id}', [MenuController::class, 'destroy'])
        ->name('menus.delete')
        ->middleware(['checkRolePermission:menus,delete-menu']);
    Route::get('/menus/{id}/pdf', [MenuController::class, 'generatePdf'])
        ->name('menus.pdf');
    Route::get('/logout', [MenuController::class, 'logout'])->name('admin.logout');
    Route::get('/qr-code-page', [MenuController::class, 'qrCodePage'])->name('your.qr.code.page.route');

    // Menu-item routes
    Route::get('/menu-items', [MenuItemController::class, 'index'])
        ->name('menu-items.index')
        ->middleware(['checkRolePermission:menu-items,read-menu-item']);
    Route::get('/menu-items/create', [MenuItemController::class, 'create'])
        ->name('menu-items.create')
        ->middleware(['checkRolePermission:menu-items,add-new-menu-item']);
    Route::post('/menu-items', [MenuItemController::class, 'store'])
        ->name('menu-items.store')
        ->middleware(['checkRolePermission:menu-items,add-new-menu-item']);
    Route::get('/menu-items/{menuItem}/edit', [MenuItemController::class, 'edit'])
        ->name('menu-items.edit')
        ->middleware(['checkRolePermission:menu-items,edit-menu-item']);
    Route::post('/menu-items/{menuItem}', [MenuItemController::class, 'update'])
        ->name('menu-items.update')
        ->middleware(['checkRolePermission:menu-items,edit-menu-item']);
    Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy'])
        ->name('menu-items.delete')
        ->middleware(['checkRolePermission:menu-items,delete-menu-item']);

    // Categories routes
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index')
        ->middleware(['checkRolePermission:categories,read-category']);
    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create')
        ->middleware(['checkRolePermission:categories,add-new-category']);
    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store')
        ->middleware(['checkRolePermission:categories,add-new-category']);
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit')
        ->middleware(['checkRolePermission:categories,edit-category']);
    Route::post('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update')
        ->middleware(['checkRolePermission:categories,edit-category']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.delete')
        ->middleware(['checkRolePermission:categories,delete-category']);
    Route::get('/categories/subcategories', [CategoryController::class, 'getSubCategories'])->name('categories.subcategories');
    
    // Menu Image routes
    Route::post('/upload-menu-image', [MenuImageController::class, 'create'])
        ->name('menu-images.create');
    Route::post('/upload-menu-item-image', [MenuImageController::class, 'menuItemCreate'])
        ->name('menu-item-images.menuItemCreate');
    Route::get('/dashboard', [MenuImageController::class, 'index'])
        ->name('admin.dashboard');


    // Roles routes (already set up)
    Route::get('roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware(['checkRolePermission:roles,read-role']);
    Route::post('role', [RoleController::class, 'store'])
        ->name('roles.add')
        ->middleware(['checkRolePermission:roles,add-new-role']);
    Route::post('role-update', [RoleController::class, 'update'])
        ->name('roles.edit')
        ->middleware(['checkRolePermission:roles,edit-role']);
    Route::post('role-delete', [RoleController::class, 'destroy'])
        ->name('roles.delete')
        ->middleware(['checkRolePermission:roles,delete-role']);
    Route::get('roles/{roleId}/permissions', [RoleController::class, 'permissions'])
        ->name('roles.permissions')
        ->middleware(['checkRolePermission:roles,assign-permission']);
    Route::post('roles/{roleId}/assign-permissions', [RoleController::class, 'assignPermissions'])
        ->name('roles.permissions.assign')
        ->middleware(['checkRolePermission:roles,assign-permission']);

    //User routes
    Route::get('users', [UserController::class,'index'])->name('users.index')->middleware(['checkRolePermission:users,read-user']);
    Route::post('user', [UserController::class,'store'])->name('users.add')->middleware(['checkRolePermission:users,add-new-user']);
    Route::post('user-update', [UserController::class,'update'])->name('users.edit')->middleware(['checkRolePermission:users,edit-user']);
    Route::post('user-delete', [UserController::class,'destroy'])->name('users.delete')->middleware(['checkRolePermission:users,delete-user']);
});


