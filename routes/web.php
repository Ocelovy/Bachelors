<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CommentController,
    Controller,
    DoctorController,
    PatientController,
    PatientRecordController,
    UserAmbulanceController,
    UserController};
use Illuminate\Support\Facades\Auth;

Route::view('/', 'home')->name('home');
Route::get('/fotogaleria', [Controller::class, 'fotogaleriaView'])->name('fotogaleria');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::post('/user/updatePhoto', [UserController::class, 'updatePhoto'])->name('user.updatePhoto');
    Route::delete('/user/deletePhoto', [UserController::class, 'deletePhoto'])->name('user.deletePhoto');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.delete');
    Route::resource('comments', CommentController::class);
});

Route::middleware(['role'])->group(function () {
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::resource('user', UserController::class);
    Route::resource('name', UserController::class)->except(['create', 'edit', 'update', 'destroy']);
    Route::get('/user/{user}/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/comment', [CommentController::class, 'index'])->name('comment');
    Route::prefix('patients')->group(function () {
        Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
        Route::get('/pacient', [PatientController::class, 'pacientView'])->name('pacient');
        Route::post('/', [PatientController::class, 'store'])->name('patients.store');
        Route::get('/', [PatientController::class, 'index'])->name('patients.index');
        Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::put('/{patient}', [PatientController::class, 'update'])->name('patients.update');
        Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
        Route::get('/form', [PatientController::class, 'showForm'])->name('pacient.form');
        Route::get('/{patient}', [PatientController::class, 'getPatientInfo'])->name('patients.info');
        Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
        Route::get('/patients/{patient}/records', [PatientRecordController::class, 'show'])->name('patient.records.show');
        Route::post('/patients/{patient}/records', [PatientRecordController::class, 'store'])->name('patient.records.store');
        Route::get('/users/{userId}/assign', [UserAmbulanceController::class, 'assignForm'])->name('users.assign.form');
        Route::post('/users/{userId}/assign', [UserAmbulanceController::class, 'assign'])->name('users.assign');
    });
    Route::get('/ambulances', [UserAmbulanceController::class, 'index'])->name('ambulances.index');
    Route::get('/ambulances/{ambulance}/edit', [UserAmbulanceController::class, 'edit'])->name('ambulances.edit');
    Route::get('/ambulances/{id}/edit-employees', 'UserAmbulanceController@editEmployees')->name('ambulances.edit-employees');
    Route::put('/ambulances/{ambulance}', [UserAmbulanceController::class, 'update'])->name('ambulances.update');
    Route::post('/ambulances/{ambulance}/assign', [UserAmbulanceController::class, 'assign'])->name('ambulances.users.assign');
    Route::get('/ambulances/{ambulance}/assignForm', [UserAmbulanceController::class, 'assignForm'])->name('ambulances.assignForm');
    Route::delete('/ambulances/{ambulance}/users/{user}/remove', [UserAmbulanceController::class, 'remove'])->name('ambulances.users.remove');
    Route::get('/ambulances/search', [UserAmbulanceController::class, 'search'])->name('ambulances.search');
    Route::post('/ambulances', [UserAmbulanceController::class, 'store'])->name('ambulances.store');
    Route::post('/user/{id}/update-titles', [UserController::class, 'updateTitles'])->name('user.updateTitles');
});

Route::prefix('doctors')->group(function () {
    Route::get('/kontakt', [DoctorController::class, 'index'])->name('kontakt');
});

Route::group(['middleware' => ['isDoktorOrAdmin']], function () {
    Route::delete('/records/{record}', [PatientRecordController::class, 'destroy'])->name('records.destroy');
    Route::get('/patients/{patient}/records', [PatientRecordController::class, 'show'])->name('patient.records.show');
    Route::put('/doctor/{doctor}/specialization', [DoctorController::class, 'updateSpecialization'])->name('doctors.updateSpecialization');
});

Route::group(['middleware' => ['role']], function () {

});





