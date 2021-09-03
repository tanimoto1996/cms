<?php

// ファサードとはインスタンス化しなくても使えるクラス
// サービスコンテナ（AppServiceProvider.php）に登録することで使える
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::resource('posts', PostController::class)->only(['index', 'show']);
