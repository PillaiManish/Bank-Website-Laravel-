<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController,App\Http\Controllers\BasicController,App\Http\Controllers\WalletController;

Route::get('/',[BasicController::class,'getHome']);

Route::get('/login',[AccountController::class,'getLogin']);
Route::post('/login',[AccountController::class,'postLogin']);
Route::get('/logout',[AccountController::class,'getLogout']);
Route::get('/register',[AccountController::class,'getRegister']);
Route::post('/register',[AccountController::class,'postRegister']);
Route::get('/verify/{token}',[AccountController::class,'getVerify']);
Route::get('/changepassword',[AccountController::class,'getChangePassword']);
Route::post('/changepassword',[AccountController::class,'postChangePassword']);
Route::get('/forgotpassword',[AccountController::class,'getForgotPassword']);
Route::post('/forgotpassword',[AccountController::class,'postForgotPassword']);
Route::get('/forgotpassword/{token}',[AccountController::class,'getForgotPasswordEmail']);
Route::post('/forgotpassword/{token}',[AccountController::class,'postForgotPasswordEmail']);

Route::get('/wallet',[WalletController::class,'getWallet']);
Route::post('/wallet',[WalletController::class,'postWallet']);
Route::post('/walletStatus',[WalletController::class,'walletCallBack']);

