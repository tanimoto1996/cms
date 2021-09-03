<?php

// ファサードとはインスタンス化しなくても使えるクラス
// サービスコンテナ（AppServiceProvider.php）に登録することで使える
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\DashboardController;


Route::get('/', DashboardController::class)->name('dashboard');
