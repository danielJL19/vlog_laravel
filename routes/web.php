<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/article/{id}',[HomeController::class,'show'])->name('article.cliente.show');
Route::get('home',function(){
    return view('home');
});
Route::get('/dashboard', function () {
    $articles=User::find(auth()->user()->id)->articles;
    $categories = Category::all();
    return view('dashboard',compact('categories','articles'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/article/edit/{article}', [ArticleController::class,'edit'])->middleware(['auth', 'verified'])->name('article.edit');
Route::post('/dashboard/article/edit/{article}',[ArticleController::class,'update'])->middleware(['auth','verified'])->name('article.update');


Route::get('/dashboard/article/{id}',[ArticleController::class,'destroy'])->middleware('auth','verified')->name('article.destroy');

Route::post('/dashboard',[ArticleController::class,'store'])->middleware(['auth','verified'])->name('article.store');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
