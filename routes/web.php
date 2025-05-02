<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\Admin\LoginController;
Use App\Http\Controllers\CategoryController;
Use App\Http\Controllers\ProductController;
Use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SessionCartController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[HomeController::class,'index']);
Route::get('/admin-login',[LoginController::class,'create']);
Route::post('/admin-logincheck',[LoginController::class,'logincheck'])->name('admin.login');
Route::get('/admin-dashboard',[LoginController::class,'dashboard']);
Route::get('/admin-categories-list',[CategoryController::class,'list'])->name('admin.category.list');
Route::get('/admin-create-category',[CategoryController::class,'create'])->name('admin.create.category');
Route::post('/admin-save-category',[CategoryController::class,'store'])->name('admin.save.category');
Route::get('/edit-category/{id}',[CategoryController::class,'edit'])->name('admin.edit.category');
Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('admin.update.category');
Route::get('/delete-category/{id}',[CategoryController::class,'delete'])->name('admin.delete.category');

Route::get('/create-products',[ProductController::class,'create'])->name('admin.create.products');
Route::post('/save-products',[ProductController::class,'store'])->name('admin.save.products');
Route::get('/list-products',[ProductController::class,'view'])->name('admin.view.products');
Route::get('/edit-products/{id}',[ProductController::class,'edit']);
// Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit'])->name('admin.edit.product');
Route::put('/admin/update-product/{id}', [ProductController::class, 'update'])->name('admin.update.products');
Route::post('/admin/delete-image', [ProductController::class, 'deleteImage'])->name('admin.delete.image');
Route::get('/delete-products/{id}', [ProductController::class, 'deleteProduct'])->name('admin.delete.product');

// users
Route::get('/Userregistration', [RegisterController::class, 'showSignUpForm'])->name('signup');
Route::post('/Usersignup', [RegisterController::class, 'signUp'])->name('signup.submit');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/userregister', [RegisterController::class, 'store'])->name('register.submit');
Route::post('/addtocart',[SessionCartController::class,'addCart'])->name('cart.store');
Route::get('/removeItem/{pid}',[SessionCartController::class,'removeCart']);
Route::get('/itemCount',[SessionCartController::class,'getCartCount']);
Route::get('/getItem',[SessionCartController::class,'getCart']);
Route::get('/sessionDestroy',[SessionCartController::class,'sessionDestroy']);


