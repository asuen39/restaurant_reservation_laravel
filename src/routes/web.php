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

Route::get('/register', [RegisteredUserController::class, 'register'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'create']);

//認証メールからの確認用URLをクリックすると、このルートが呼ばれる
Route::get('/verify-email/{token}', [RegisteredUserController::class, 'verify'])->name('verify.email');

//認証メールからの確認用URLをクリックすると、このルートが呼ばれる
Route::get('/verification/success', function () {
    return view('verification.success');
})->name('verification.success');

Route::get('/thanks', [ThanksController::class, 'thanks'])->name('thanks');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [ShopListController::class, 'index'])->name('index');
Route::post('/', [ShopListController::class, 'favorite'])->name('favorite');
Route::get('/search', [ShopListController::class, 'search'])->name('search');

Route::get('/detail/{id}', [ShopDetailController::class, 'detail'])->name('detail');
Route::post('/detail', [ShopDetailController::class, 'showPaymentForm'])->name('showPaymentForm');

Route::post('/payment', [ShopDetailController::class, 'processPayment'])->name('processPayment');

Route::get('/done', [DoneController::class, 'done'])->name('done');

Route::get('/mypage', [MyPageController::class, 'mypage'])->name('mypage');
Route::post('/updateProfile', [MyPageController::class, 'updateProfile'])->name('updateProfile');
Route::delete('/deleteReservation/{reservation}', [MyPageController::class, 'deleteReservation'])->name('deleteReservation');
Route::post('/submitReview', [MyPageController::class, 'submitReview'])->name('submitReview');
