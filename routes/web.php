<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/doctors')->group(function(){
  Route::get('/login', [App\Http\Controllers\Auth\DoctorLoginController::class, 'showLoginForm'])->name('doctors.login');
  Route::post('/login', [App\Http\Controllers\Auth\DoctorLoginController::class, 'login'])->name('doctors.login.submit');
  Route::get('/logout', [App\Http\Controllers\Auth\DoctorLoginController::class, 'logout'])->name('doctors.logout');
  Route::get('/register', [App\Http\Controllers\Auth\DoctorLoginController::class, 'showRegistrationForm'])->name('doctors.register');
  Route::post('/register', [App\Http\Controllers\Auth\DoctorLoginController::class, 'register'])->name('doctors.register.submit');

  Route::get('/', [App\Http\Controllers\DoctorController::class, 'index'])->name('doctors.index');
  Route::get('/prescriptions/create/{consultation}', [App\Http\Controllers\PrescriptionController::class, 'showForm'])->name('doctors.prescriptions.create');
  Route::get('/prescriptions/edit/{prescription}', [App\Http\Controllers\PrescriptionController::class, 'showEditForm'])->name('doctors.prescriptions.edit');
  Route::post('/prescriptions/create', [App\Http\Controllers\PrescriptionController::class, 'store'])->name('doctors.prescriptions.store');
  Route::post('/prescriptions/edit', [App\Http\Controllers\PrescriptionController::class, 'update'])->name('doctors.prescriptions.update');
  Route::delete('/prescriptions/destroy/{id}', [App\Http\Controllers\PrescriptionController::class, 'destroy'])->name('doctors.prescriptions.destroy');
  Route::get('/prescriptions', [App\Http\Controllers\PrescriptionController::class, 'index'])->name('doctors.prescriptions');
  Route::get('/profile/{doctor}', [App\Http\Controllers\DoctorController::class, 'showProfile'])->name('doctors.profile');
  Route::post('/profile/{doctor}', [App\Http\Controllers\DoctorController::class, 'updateProfile'])->name('doctors.profile.submit');
  Route::get('/see_patient_profile/{patient}', [App\Http\Controllers\DoctorController::class, 'seePatientProfile'])->name('doctors.patients.seeprofile');
});

Route::prefix('/patients')->group(function(){
  Route::get('/login', [App\Http\Controllers\Auth\PatientLoginController::class, 'showLoginForm'])->name('patients.login');
  Route::post('/login', [App\Http\Controllers\Auth\PatientLoginController::class, 'login'])->name('patients.login.submit');
  Route::get('/logout', [App\Http\Controllers\Auth\PatientLoginController::class, 'logout'])->name('patients.logout');
  Route::get('/register', [App\Http\Controllers\Auth\PatientLoginController::class, 'showRegistrationForm'])->name('patients.register');
  Route::post('/register', [App\Http\Controllers\Auth\PatientLoginController::class, 'register'])->name('patients.register.submit');

  Route::get('/', [App\Http\Controllers\PatientController::class, 'index'])->name('patients.index');
  Route::get('/consult/{doctor}', [App\Http\Controllers\PatientController::class, 'consult'])->name('patients.consult');
  Route::post('/consult', [App\Http\Controllers\ConsultationController::class, 'create'])->name('patients.consult.create')->middleware('auth:patient');
  Route::get('/prescriptions', [App\Http\Controllers\PatientController::class, 'showPrescriptions'])->name('patients.prescriptions');
  Route::get('/profile/{patient}', [App\Http\Controllers\PatientController::class, 'showProfile'])->name('patients.profile');
  Route::post('/profile/{patient}', [App\Http\Controllers\PatientController::class, 'updateProfile'])->name('patients.profile.submit');
});
