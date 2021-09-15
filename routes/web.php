<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// controllers
use App\Http\Controllers\aAuth;
use App\Http\Controllers\dAuth;
use App\Http\Controllers\pAuth;
use App\Http\Controllers\aHandler;
use App\Http\Controllers\docHandler;
use App\Http\Controllers\patHandler;
use App\Http\Controllers\logout;
use App\Http\Controllers\temp;
// middlewares
use App\Http\Middleware\Authenticate as check_auth;
use GuzzleHttp\Middleware;





// Route::group(['middleware' => ['web']], function () {

    //** Admin Routes **//
    // login page
    Route::get('/a-login', function () {
        return view('/a/index');
    });

    Route::post('/admin_login', [aAuth::class, 'logAdmin']);

    //register admin
    Route::get('/a-register', function () {
        return view('/a/register');
    });
    Route::post('/admin_registration', [aAuth::class, 'newAdmin']);

    Route::group(['middleware' => ['admin_check_login']], function () {

        //admin dashboard
        Route::get('/a/dashboard', function () {
            return view('/a/dashboard');
        });

        //admin appoinment
        Route::get('/a/appoinment', function () {
            return view('/a/appoinment');
        });

        //admin doctor
        Route::get('/a/doctor', function () {
            return view('/a/doctor');
        });
        // it disble doctor's login
        Route::post('/loginDisable', [aHandler::class, 'loginDisable']);
        // it enable doctor's login
        Route::post('/loginEnable', [aHandler::class, 'loginEnable']);

        //admin pending doctor
        Route::get('/a/pending-doctor', function () {
            return view('/a/pending_doc');
        });
        // approve the doctor account
        Route::post('/approveDoctor', [aHandler::class, 'approveDoctor']);

        //admin patient
        Route::get('/a/patient', function () {
            return view('/a/patient');
        });
    });






        // Route::group(['middleware' => ['login_page']], function() {
            //** login/Register doctor Routes **//
            Route::get('/', function() {
                return view('index');
            });
            // Route::get('doctor-login/{auth?}', function ($auth) {
            //     return view('index', ['auth'=>$auth]);
            // })->name('doctor-login');


            Route::get('/doctor-reset/{token}/{time}', function ($token, $time) {
                return view('doctor-reset', ['token'=> $token, 'time'=>$time]);
            })->name('doctor-reset');

            //signup login
            Route::post('/dNew', [dAuth::class, 'newDoc']);
            Route::post('/', [dAuth::class, 'logDoc']);
            Route::post('/doctor-forgot-password', [dAuth::class, 'forgotDoc']);
            Route::post('/doctor-change-password-route', [dAuth::class, 'changePasswordDoc']);


            //** login/Register patient Routes **//
            Route::get('/p-login', function () {
                return view('p_login');
            });
            // forgot password
            Route::get('/patient-reset/{token}/{time}', function ($token, $time) {
                return view('patient-reset', ['token'=> $token, 'time'=>$time]);
            })->name('patient-reset');

            //signup login
            Route::post('/pNew', [pAuth::class, 'newPat']);
            Route::post('/pLogin', [pAuth::class, 'loginPat']);
            Route::post('/patient-forgot-password', [pAuth::class, 'forgotPat']);
            Route::post('/patient-change-password-route', [pAuth::class, 'changePasswordPat']);
        // });



    Route::group(['middleware' => ['check_login']], function () {

        // Route::group(['middleware' => ['doctor_page']], function() {
            //** doctor Routes **//

            // doctor dashboard
            Route::get('/d', function() {
                return view('d/index');
            });

            // doctor schedule-timings
            Route::view('/d/schedule-timings', 'd/schedule-timings');
            // adding time schedules to the database
            Route::post('/schedule-timings', [docHandler::class, 'scheduleTimings']);
            // displaying available slots time
            Route::post('/show-slots', [docHandler::class, 'showSlots']);

            // doctor appointments
            Route::view('/d/appointments', '/d/appointments');

            // patient's profile
            Route::get('/d/patient-profile/{id}', function ($id) {
                return view('/d/patient-profile', ['id'=>$id]);
            })->name('patient-profile');

            // doctor profile-settings
            Route::view('/d/profile-settings', '/d/profile-settings');

            // doctor profile-settings form submit
            Route::post('/UpdateDoctorProfileSettings', [docHandler::class, 'UpdateDoctorProfileSettings']);

            // doctor's dashboard today's appoinment
            Route::get('/todaysAppoinment', [docHandler::class, 'todaysAppoinment']);

            // doctor's dashboard upcoming appoinment
            Route::get('/upcomingAppoinment', [docHandler::class, 'upcomingAppoinments']);

            // doctor accept appoinment
            Route::post('/acceptAppoinment', [docHandler::class, 'acceptAppoinment']);

            // doctor cancel appoinment
            Route::post('/cancelAppoinment', [docHandler::class, 'cancelAppoinment']);

            //  adding prescriptions
            Route::post('/prescription-save', [docHandler::class, 'prescriptionSave']);
            //  editing prescriptions
            Route::post('/edit-prescription-save', [docHandler::class, 'editPrescriptionSave']);
            // getting all prescriptions of perticular patient
            Route::get('/display-prescription', [temp::class, 'displayPrescription']);
            //  deleting prescriptions
            Route::post('/delete-prescription', [docHandler::class, 'deletePrescription']);

        // });




        // Route::group(['middleware' => ['patient_page']], function() {
            //** Patients Routes **//

            // select-doctor index page
            Route::view('/p', 'p/index');

            // patient dashboard
            Route::view('/p/dashboard', 'p/dashboard');

            // patient doctor-profile
            Route::get('/p/doctor-profile/{id}', function ($id) {
                return view('/p/doctor-profile', ['id'=>$id]);
            })->name('doctor-profile');

            // patient booking page
            Route::get('/p/booking/{id}', function ($id) {
                return view('p/booking', ['id'=>$id]);
            })->name('booking');

            // proccedToPay action (booking page)
            Route::post('/proccedToPay', [patHandler::class, 'proToPay']);

            // patient chechout page
            Route::get('/p/checkout/{id}/{date}/{time}', function ($id, $date, $time) {
                return view('/p/checkout', ['id'=>$id, 'date'=>$date, 'time'=>$time]);
            })->name('checkout');
        // });

    });

    // logout routing
    Route::post('/logout', [logout::class, 'logout']);






// });
