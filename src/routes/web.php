<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AddressController;


/*
-------------------------------------------------
| 認証不要
-------------------------------------------------
*/

// 会員登録
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'store']);

// メール認証画面
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 認証リンククリック時
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('profile.initial');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ログイン
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ログアウト
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 商品一覧(トップ)
Route::get('/', [ItemController::class, 'index']);

// マイリスト
Route::get('/?tab=mylist', [ItemController::class, 'mylist']);

// 商品詳細
Route::get('/item/{item_id}', [ItemController::class, 'detail']);

Route::post('/item/{item_id}/like', [LikeController::class, 'toggle'])
    ->middleware('auth');

Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])
    ->middleware('auth');

/*
-------------------------------------------------
| 認証必要
-------------------------------------------------
*/

// 初回登録プロフィール保存用
Route::post('/mypage/profile/initial', [UserController::class, 'saveInitialProfile'])
    ->name('profile.setup.update');

// 新規登録後のプロフィール設定画面
Route::get('/mypage/profile/initial', [UserController::class, 'initialProfile'])
    ->name('profile.initial');

Route::middleware(['auth', 'verified'])->group(function () {

    // 商品購入画面
    Route::get('/purchase/{item_id}', [ItemController::class, 'purchase']);
    Route::post('/purchase/{item_id}', [ItemController::class, 'purchaseStore']);
    Route::get('/purchase/success/{item_id}', [ItemController::class, 'success']);

    // 住所変更
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'edit']);
    Route::post('/purchase/address/{item_id}', [AddressController::class, 'updatePurchaseAddress']);

    // 商品出品
    Route::get('/sell', [ItemController::class, 'create'])->name('items.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('items.store');

    // プロフィール
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');

    // プロフィール編集（メール認証済みユーザー用）
    Route::get('/mypage/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [UserController::class, 'update'])->name('profile.update');
});

