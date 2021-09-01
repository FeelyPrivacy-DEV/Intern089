<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dAuth;
use App\Http\Controllers\logout;
use App\Http\Controllers\pAuth;

//** Doctors Routes **//

Route::get('/', function () {
    return view('index');
});

//signup login
Route::post('/dNew', [dAuth::class, 'newDoc']);
Route::post('/', [dAuth::class, 'logDoc']);

// doctor dashboard
Route::view('/d', 'd/index');

// doctor schedule-timings
Route::view('/d/schedule-timings', 'd/schedule-timings');

// doctor appointments
Route::view('/d/appointments', '/d/appointments');






//** Patients Routes **//

Route::get('/p-login', function () {
    return view('p_login');
});

//signup login
Route::post('/pNew', [pAuth::class, 'newPat']);
Route::post('/pLogin', [pAuth::class, 'loginPat']);

// select-doctor index page
Route::view('/p', 'p/index');

// patient dashboard
Route::view('/p/dashboard', 'p/dashboard');

// patient doctor-profile
Route::view('/p/doctor-profile?', '/p/doctor-profile');




//** Other Routes **//

// logout routing
Route::post('/logout', [logout::class, 'logout']);






