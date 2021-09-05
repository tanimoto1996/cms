<?php

// ファサードとはインスタンス化しなくても使えるクラス
// サービスコンテナ（AppServiceProvider.php）に登録することで使える
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\PostController;


Route::get('/', DashboardController::class)->name('dashboard');

// AuthSavesProvider（サービスプロバイダー）でroleカラムが１のユーザだけCRUDを使える
Route::group(['middleware' => 'can:admin'], function () {
  Route::resource('posts', PostController::class)->except('show');
});
