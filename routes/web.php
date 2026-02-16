<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\PostController;
use App\Models\Groups;
use App\Models\Post;
use Illuminate\Support\Facades\DB;


// use SebastianBergmann\FileIterator\Factory;
// use Faker\Factory as FakerFactory;
Route::get('/unicode', function () {
    return view('form');
});

// 1. Tạo các route đăng nhập/đăng ký/đăng xuất mặc định (bao gồm /login)
Auth::routes([
    'register'=>false
]);

// 2. Route cho trang Admin (khớp với $redirectTo = '/admin' trong LoginController)
// Route::get('/admin', function () {
//     return view('admin');
// })->middleware('auth')->name('admin');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('index');
    // Quản lý bài viết
    Route::prefix('posts')->name('posts.')->middleware('can:posts')->group(function () {
        Route::get('/',[PostsController::class,'index'])->name('index')->can('viewAny',Post::class);
        Route::get('/add',[PostsController::class,'add'])->name('add')->can('create',Post::class);
        Route::post('add',[PostsController::class,'postadd'])->name('postadd')->can('create',Post::class);
         Route::get('edit/{post}',[PostsController::class,'edit'])->name('edit')->can('posts.edit',Post::class);
         Route::put('edit/{post}',[PostsController::class,'update'])->name('update')->can('posts.edit',Post::class);;
         Route::delete('delete/{post}',[PostsController::class,'delete'])->name('delete');
    });
    // Quản lý nhóm người dùng
    Route::prefix('groups')->name('groups.')->group(function () {
        Route::get('/',[GroupsController::class,'index'])->name('index');
         Route::get('add',[GroupsController::class,'add'])->name('add');
         Route::post('add',[GroupsController::class,'postadd'])->name('postadd');
         Route::get('edit/{group}',[GroupsController::class,'edit'])->name('edit');
         Route::put('edit/{group}',[GroupsController::class,'update'])->name('update');
         Route::delete('delete/{group}',[GroupsController::class,'delete'])->name('delete');
         Route::get('permission/{group}',[GroupsController::class,'permission'])->name('permission');
         Route::post('permission/{group}',[GroupsController::class,'postpermission']);
    });
    // Quản lý người dùng
    Route::prefix('users')->name('users.')->middleware('can:users')->group(function () {
        Route::get('/',[UsersController::class,'index'])->name('index');
         Route::get('add',[UsersController::class,'add'])->name('add');
         Route::post('add',[UsersController::class,'postadd'])->name('postadd');
         Route::get('edit/{user}',[UsersController::class,'edit'])->name('edit');
         Route::put('edit/{user}',[UsersController::class,'update'])->name('update');
         Route::delete('delete/{user}',[UsersController::class,'delete'])->name('delete');

    });
});
