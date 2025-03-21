<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\MenuGenerateController;
use App\Http\Controllers\admin\MenuImageController;
use App\Http\Controllers\admin\MenuItemController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContactsController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PriceManagementController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ContactController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

Route::get('/send-test-mail', function () {
    $data = ['name' => 'John Doe']; // Replace with dynamic data if needed

    // Send email
    Mail::to('faisal.mahmood.alam@gmail.com')->send(new SendMail($data));

    return 'Email sent successfully!';
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home.login')->with('message', 'Your email has been verified. Please log in.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');

//front end routes
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('home.about-us');
Route::get('/menu', [HomeController::class, 'menu'])->name('home.menu');
Route::get('/menuItems', [HomeController::class, 'menuItems'])->name('home.menuItems');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('home.contact-us');
Route::get('/services', [HomeController::class, 'service'])->name('home.services');
Route::get('/user/login', [HomeController::class, 'login'])->name('home.login');

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

Route::get('/contacts', [ContactsController::class, 'index'])
        ->name('contacts.index')
        ->middleware(['checkRolePermission:contacts,read-contact']);
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
    Route::get('/price-detail/{id}', [MenuItemController::class, 'getPriceDetail'])->name('getPriceDetail');

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
    Route::any('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit')
        ->middleware(['checkRolePermission:categories,edit-category']);
    Route::any('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update')
        ->middleware(['checkRolePermission:categories,edit-category']);
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.delete')
        ->middleware(['checkRolePermission:categories,delete-category']);
    Route::get('/categories/subcategories', [CategoryController::class, 'getSubCategories'])->name('categories.subcategories');

    // Menu Image routes
    Route::post('/upload-menu-image', [MenuImageController::class, 'create'])
        ->name('menu-images.create');
    Route::post('/upload-menu-item-image', [MenuImageController::class, 'menuItemCreate'])
        ->name('menu-item-images.menuItemCreate');
    Route::post('/upload-category-image', [MenuImageController::class, 'categoryCreate'])
        ->name('category-images.categoryCreate');
    Route::get('/dashboard', [MenuImageController::class, 'index'])
        ->middleware(['auth', 'verified'])
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
    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware(['checkRolePermission:users,read-user']);
    Route::post('user', [UserController::class, 'store'])->name('users.add')->middleware(['checkRolePermission:users,add-new-user']);
    Route::post('user-update', [UserController::class, 'update'])->name('users.edit')->middleware(['checkRolePermission:users,edit-user']);
    Route::post('user-delete', [UserController::class, 'destroy'])->name('users.delete')->middleware(['checkRolePermission:users,delete-user']);

    // Price Management routes (already set up)
    Route::get('price-managements', [PriceManagementController::class, 'index'])
        ->name('price-managements.index')
        ->middleware(['checkRolePermission:price-managements,read-price-management']);
    Route::get('price-managements/create', [PriceManagementController::class, 'create'])
        ->name('price-managements.create')
        ->middleware(['checkRolePermission:price-managements,add-new-price-management']);
    Route::post('price-managements', [PriceManagementController::class, 'store'])
        ->name('price-managements.store')
        ->middleware(['checkRolePermission:price-managements,add-new-price-management']);
    Route::get('price-managements/{priceMangement}/edit', [PriceManagementController::class, 'edit'])
        ->name('price-managements.edit')
        ->middleware(['checkRolePermission:price-managements,edit-price-management']);
    Route::post('price-managements/{priceMangement}', [PriceManagementController::class, 'update'])
        ->name('price-managements.update')
        ->middleware(['checkRolePermission:price-managements,edit-price-management']);
    Route::delete('price-managements/{id}', [PriceManagementController::class, 'destroy'])
        ->name('price-managements.delete')
        ->middleware(['checkRolePermission:price-managements,delete-price-management']);
});
