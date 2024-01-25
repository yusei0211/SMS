<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\LikeController;
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



Route::get('/', function () {
    return view('user.welcome');
});

Route::middleware('auth:users')->group(function(){
    //ブログ一覧画面を表示
Route::get('/',[BlogController::class, 'showList'])->name('blogs');

//ブログ登録画面
Route::get('/blog/create',[BlogController::class, 'showCreate'])->name('create');

//ブログ登録
Route::post('/blog/store',[BlogController::class, 'exeStore'])->name('store');

//ブログ詳細を表示
Route::get('/blog/{id}',[BlogController::class, 'showDetail'])->name('show');

//ブログ編集を表示
Route::get('/blog/edit/{id}',[BlogController::class, 'showEdit'])->name('edit');

//ブログ編集
Route::get('/blog/update',[BlogController::class, 'exeUpdate'])->name('update');

//ブログ削除
Route::get('/blog/delete/{id}',[BlogController::class, 'exeDelete'])->name('delete');

//ブログいいね
Route::get('/blog/like/{id}',[LikeController::class, 'exeLike'])->name('like');

//ブログいいね削除
Route::get('/blog/unlike/{id}',[LikeController::class, 'exeUnlike'])->name('unlike');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
