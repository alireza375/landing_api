<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\GalaryController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\EvenNewController;


// For Even News
Route::get('/even-news-show', [EvenNewController::class, 'EvenIndex']);
Route::post('/even-news-store', [EvenNewController::class, 'EvenStore']);
Route::post('/even-news-update/{id?}', [EvenNewController::class, 'EvenUpdate']);
Route::delete('/even-news-delete/{id?}', [EvenNewController::class, 'DeleteEven']);


// For Notice
Route::get('/notice-show', [NoticeController::class, 'NoticeIndex']);
Route::post('/notice-store', [NoticeController::class, 'NoticeStore']);
Route::post('/notice-update/{id?}', [NoticeController::class, 'NoticeUpdate']);
Route::delete('/notice-delete/{id?}', [NoticeController::class, 'NoticeDelete']);

// For Galary
Route::get('/galary-show', [GalaryController::class, 'GalaryIndex']);
Route::post('/galary-store',[GalaryController::class, 'GalaryStore']);
Route::post('/galary-update/{id?}', [GalaryController::class, 'GalaryUpdate']);
Route::delete('/galary-delete/{id?}', [GalaryController::class, 'GalaryDelete']);

//For Banner
Route::get('/banner-show', [BannerController::class, 'index']);
Route::post('/banner-store', [BannerController::class, 'BannerStore']);
Route::post('/banner-update/{id?}', [BannerController::class, 'BannerUpdate']);
Route::delete('/banner-delete/{id?}', [BannerController::class, 'BannerDestroy']);


