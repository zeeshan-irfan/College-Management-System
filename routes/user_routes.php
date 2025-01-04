<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\ChallanController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\FatherinfoController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

Route::put('/updatePersonalInfo',[PersonalController::class,'updatePersonalInfo'])->name('updatePersonalInfo');
Route::put('/updateHafizInfo',[PersonalController::class,'updateHafizInfo'])->name('updateHafizInfo');
Route::put('/updateDisableInfo',[PersonalController::class,'updateDisableInfo'])->name('updateDisableInfo');
Route::put('/updatefatherInfo',[FatherinfoController::class,'updatefatherInfo'])->name('updatefatherInfo');
Route::put('/updateMatricEducation',[EducationController::class,'updateMatricEducation'])->name('updateMatricEducation');
Route::put('/updateInterEducation',[EducationController::class,'updateInterEducation'])->name('updateInterEducation');
Route::put('/updateBaEducation',[EducationController::class,'updateBaEducation'])->name('updateBaEducation');
Route::put('/updateBsEducation',[EducationController::class,'updateBsEducation'])->name('updateBsEducation');

Route::get('/', [NavigationController::class,'toUserDashboard'])->name('user.home');
Route::view('/profile', 'user.profile')->name('user.profile');
// Route::view('/apply', 'user.apply')->name('user.apply');
Route::get('/applied', [RecordController::class,'applied'])->name('user.applied');
Route::view('/account', 'user.account')->name('user.account');
Route::view('/help', 'user.help')->name('user.help');
Route::get('/about', [ AboutController::class,'index'])->name('user.about');
Route::get('/admission',[AdmissionController::class,'apply'])->name('admission.apply');
Route::post('/admission',[RecordController::class,'store'])->middleware('throttle:records')->name('record.store');
Route::get('/challan/{id}',[ChallanController::class,'challanDownload'])->name('challan.download');
