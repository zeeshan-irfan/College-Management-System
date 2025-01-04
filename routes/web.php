<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ChallanController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    Route::put('/updateNameImage',[ImageController::class,'updateNameImage'])->name('updateNameImage');
    Route::put('/updateAddress',[AddressController::class,'updateAddress'])->name('updateAddress');
    Route::post('/contact/send', [EmailController::class, 'sendEmail'])->name('contact.send');
});

require __DIR__.'/auth.php';

Route::prefix('user')->middleware(['auth','checkrole:user,student'])->group(function(){

    require __DIR__.'/user_routes.php';

});

// Routes for users with the 'student' role
Route::prefix('student')->middleware(['auth', 'checkrole:student'])->group(function () {

});

// Routes for users with the 'admin' role
Route::prefix('admin')->middleware(['auth','checkrole:admin'])->group(function(){

    Route::get('/', [NavigationController::class,'toAdminDashboard'])->name('admin.home');
    Route::view('/account', 'admin.account')->name('admin.account');
    Route::view('/help', 'admin.help')->name('admin.help');
    Route::get('/about',[ AboutController::class,'index'])->name('admin.about');
    Route::post('/about/store',[ AboutController::class,'store'])->name('about.store');
    Route::get('/about/edit/{id}',[ AboutController::class,'edit'])->name('about.edit');
    Route::put('/about/update/{id}',[ AboutController::class,'update'])->name('about.update');
    Route::post('/about/destroy/{id}',[ AboutController::class,'destroy'])->name('about.destroy');
    Route::resource('department',DepartmentController::class);
    Route::resource('program',ProgramController::class);
    Route::resource('degree',DegreeController::class);
    Route::resource('admission',AdmissionController::class)->except(['create','destroy']);
    Route::get('/degree/{id}/linkpage',[DegreeController::class,'linkpage'])->name('degree.linkpage');
    Route::put('/degree/{id}/link',[DegreeController::class,'link'])->name('degree.link');
    Route::get('/bank',[BankController::class,'index'])->name('bank.index');
    Route::post('/bank/store',[BankController::class,'store'])->name('bank.store');
    Route::get('/bank/edit/{id}', [BankController::class, 'edit'])->name('bank.edit');
    Route::put('/update/{id}', [BankController::class, 'update'])->name('bank.update'); // Update the bank
    Route::resource('user',UserController::class);
    Route::get('/users/search', [UserController::class, 'search'])->name('user.search');
    Route::get('/admissions/applications', [RecordController::class, 'applications'])->name('records.applicants');
    Route::get('/admissions/applications/search', [RecordController::class, 'search'])->name('records.search');
    Route::post('/admissions/destroy/{id}', [RecordController::class, 'destroy'])->name('record.destroy');
    Route::get('/downloads',[ExportController::class,'index'])->name('export.index');
    Route::get('/downloads/generate',[ExportController::class,'generate'])->name('export.generate');
    Route::get('/export-records', [ExportController::class, 'export'])->name('records.export');

});

// Routes for users with the 'clerk' role
Route::prefix('clerk')->middleware(['auth','checkrole:clerk'])->group(function(){

});

// Routes for users with the 'hod' role
Route::prefix('hod')->middleware(['auth','checkrole:hod'])->group(function(){

});

// Routes for users with the 'faculty' role
Route::prefix('faculty')->middleware(['auth','checkrole:faculty'])->group(function(){

});
