<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;


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
Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/category/{id}','category')->name('category');
    Route::get('/contact','contact')->name('contact');
//Route::get('/login','login')->name('login');
//Route::get('/register','register')->name('register');
//Route::get('/singleblog','singleblog')->name('singleblog');
});
Route::post('/subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/comment/store', [CommentController::class, 'store'])->name('comments.store');


Route::get('/my-blogs',[BlogController::class,'myBlogs'])->name('blogs.my-blogs')->middleware('auth');
Route::resource('blogs', BlogController::class);






require __DIR__.'/auth.php';