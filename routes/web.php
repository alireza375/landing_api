<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultiyContoller;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\InspirationController;
use Illuminate\Support\Facades\Route;

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

Route::post('/banner-page', [BannerController::class, 'BannerPage']);

//inspiration page
Route::post('/create-inspiration', [InspirationController::class, 'create']);
Route::post('/update-inspiration/{id?}', [InspirationController::class, 'update']);
Route::delete('/delete-inspiration/{id?}', [InspirationController::class, 'destroy']);
Route::get('/index-inspiration', [InspirationController::class, 'index']);

//card
Route::post('/create-card', [CardController::class, 'create']);
Route::post('/update-card/{id?}', [CardController::class, 'update']);
Route::get('/index-card', [CardController::class, 'index']);
Route::delete('/delete-card/{id?}', [CardController::class, 'destroy']);

//course
Route::get('/index-course', [CourseController::class, 'index']);
Route::post('/create-course', [CourseController::class, 'create']);
Route::post('/update-course/{id?}', [CourseController::class, 'update']);
Route::delete('/delete-course/{id?}', [CourseController::class, 'destroy']);

//Faculty
Route::get('/index-faculty', [FacultiyContoller::class, 'index']);
Route::post('/create-faculty', [FacultiyContoller::class, 'create']);
Route::post('/update-faculty/{id}', [FacultiyContoller::class, 'update']);
Route::delete('/delete-faculty/{id}', [FacultiyContoller::class, 'destroy']);


//footer
Route::get('/index-footer', [FooterController::class, 'index']);
Route::post('/create-footer', [FooterController::class, 'create']);
Route::post('/update-footer/{id}', [FooterController::class, 'update']);
Route::delete('/delete-footer/{id}', [FooterController::class, 'destroy']);

