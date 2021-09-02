<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\dAuth;
use App\Http\Controllers\docHandler;
use App\Http\Controllers\logout;
use App\Http\Controllers\pAuth;
use App\Http\Controllers\proccedToPay;








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

// patient's profile
Route::get('/d/patient-profile', function() {
    return view('/d/patient-profile');
});

// doctor profile-settings
Route::view('/d/profile-settings', '/d/profile-settings');

// doctor profile-settings form submit
Route::post('/UpdateDoctorProfileSettings', [docHandler::class, 'UpdateDoctorProfileSettings']);

// doctor's dashboard today's appoinment
Route::get('/todaysAppoinment', [docHandler::class, 'todaysAppoinment']);

// doctor's dashboard upcoming appoinment
Route::get('/upcomingAppoinment', [docHandler::class, 'upcomingAppoinments'], function (Request $req) {
    $token = $req->session()->token();

    $token = csrf_token();
});

// doctor's dashboard accept appoinment
Route::get('/acceptAppoinment', [docHandler::class, 'acceptAppoinment'], function (Request $req) {
    $token = $req->session()->token();

    $token = csrf_token();
});

// doctor's dashboard cancel appoinment
Route::get('/cancelAppoinment', [docHandler::class, 'cancelAppoinment'], function (Request $req) {
    $token = $req->session()->token();

    $token = csrf_token();
});





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
Route::get('/p/doctor-profile', function () {
    return view('/p/doctor-profile');
});

// patient booking page
Route::get('/p/booking', function () {
    return view('p/booking');
});

// patient chechout page
Route::get('/p/chechout', function() {
    return view('p/chechout');
});




//** Other Routes **//

// proccedToPay (booking page)
Route::post('/proccedToPay', [proccedToPay::class, 'proToPay'], function (Request $req) {
    $token = $req->session()->token();

    $token = csrf_token();
});

// logout routing
Route::post('/logout', [logout::class, 'logout']);






