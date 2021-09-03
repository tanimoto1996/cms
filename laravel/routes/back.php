<?php

// ファサードとはインスタンス化しなくても使えるクラス
// サービスコンテナ（AppServiceProvider.php）に登録することで使える
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
  echo 'back';
});
