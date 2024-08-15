<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\ShopListController;
use App\Http\Controllers\ShopDetailController;
use App\Http\Controllers\DoneController;
use App\Http\Controllers\MyPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ユーザー登録
Route::get('/register', [RegisteredUserController::class, 'register'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'create']);

//認証メールからの確認用URLをクリックすると、このルートが呼ばれる
Route::get('/verify-email/{token}', [RegisteredUserController::class, 'verify'])->name('verify.email');

//認証メールからの確認用URLをクリックすると、このルートが呼ばれる
Route::get('/verification/success', function () {
    return view('verification.success');
})->name('verification.success');

//ユーザー登録完了ページ
Route::get('/thanks', [ThanksController::class, 'thanks'])->name('thanks');

//ログイン
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//ログイン後の店舗一覧ページ
Route::middleware('auth')->group(function () {  //ログインしているユーザーのみアクセス可能
    Route::get('/', [ShopListController::class, 'index'])->name('index');
    Route::post('/', [ShopListController::class, 'favorite'])->name('favorite');
    Route::get('/search', [ShopListController::class, 'search'])->name('search');
});

//店舗詳細ページ
//IDありで/detail/{id}にアクセスした場合のルート
Route::get('/detail/{id}', [ShopDetailController::class, 'detail'])->name('detail');
//IDなしで/detailにアクセスした場合のルート
Route::get('/detail', [ShopDetailController::class, 'noDetail'])->name('noDetail');
Route::post('/detail', [ShopDetailController::class, 'showPaymentForm'])->name('showPaymentForm');

//決済処理
// 直接/paymentにアクセスした場合のルート
Route::get('/payment', [ShopDetailController::class, 'noPayment'])->name('noPayment');
//店舗詳細からアクセスされた場合のルート
Route::post('/payment', [ShopDetailController::class, 'processPayment'])->name('processPayment');

Route::middleware('auth')->group(function () {  //ログインしているユーザーのみアクセス可能
    //予約完了ページ
    Route::get('/done', [DoneController::class, 'done'])->name('done');
});

//マイページ
Route::middleware('auth')->group(function () {  //ログインしているユーザーのみアクセス可能
    Route::get('/mypage', [MyPageController::class, 'mypage'])->name('mypage');
    Route::post('/updateProfile', [MyPageController::class, 'updateProfile'])->name('updateProfile');
    Route::delete('/deleteReservation/{reservation}', [MyPageController::class, 'deleteReservation'])->name('deleteReservation');
    Route::post('/submitReview', [MyPageController::class, 'submitReview'])->name('submitReview');
    //qrコードを読み取った後の処理
    Route::get('/reservations/read-qr-code/{id}', [MyPageController::class, 'readQrCode'])->name('reservations.readQrCode');
});
