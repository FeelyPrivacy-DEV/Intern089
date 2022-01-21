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
use App\Http\Controllers\testHandler;
// middlewares
use App\Http\Middleware\Authenticate as check_auth;
use GuzzleHttp\Middleware;





//********************************* Before login Admin Routes *********************************//
Route::get('/a-login', function () {
    return view('/a/index');
})->middleware('afterLogin');
Route::post('/admin_login', [aAuth::class, 'logAdmin']);
Route::get('/a-register', function () {
    return view('/a/register');
})->middleware('afterLogin');
Route::post('/admin_registration', [aAuth::class, 'newAdmin']);




Route::group(['middleware' => ['admin_check_login']], function () {
    //*************************************************** after login Admin Routes ***************************************************//
    Route::get('/a/dashboard', function () {
        return view('/a/dashboard');
    });
    Route::get('/a/appoinment', function () {
        return view('/a/appoinment');
    });
    Route::get('/a/doctor', function () {
        return view('/a/doctor');
    });
    Route::post('/loginDisable', [aHandler::class, 'loginDisable']);
    Route::post('/loginEnable', [aHandler::class, 'loginEnable']);
    Route::get('/a/pending-doctor', function () {
        return view('/a/pending_doc');
    });
    Route::post('/approveDoctor', [aHandler::class, 'approveDoctor']);
    Route::post('/UnderReviewDoctor', [aHandler::class, 'UnderReviewDoctor']);
    Route::post('/removeUnderReview', [aHandler::class, 'removeUnderReview']);
    Route::get('/get_pend_doc', [aHandler::class, 'get_pend_doc']);
    Route::post('/RejectDoctor', [aHandler::class, 'RejectDoctor']);
    Route::post('/removeRejectDoctor', [aHandler::class, 'removeRejectDoctor']);
    Route::get('/a/patient', function () {
        return view('/a/patient');
    });
});






//************************ Before login doctor Routes ************************//
Route::get('/', function() {
    return view('index');
})->middleware('afterLogin');
// Route::get('doctor-login/{auth?}', function ($auth) {
//     return view('index', ['auth'=>$auth]);
// })->name('doctor-login');

Route::get('/doctor-reset/{token}/{time}', function ($token, $time) {
    return view('doctor-reset', ['token'=> $token, 'time'=>$time]);
})->name('doctor-reset');

Route::post('/dNew', [dAuth::class, 'newDoc']);
Route::post('/', [dAuth::class, 'logDoc']);
Route::post('/doctor-forgot-password', [dAuth::class, 'forgotDoc']);
Route::post('/doctor-change-password-route', [dAuth::class, 'changePasswordDoc']);


//************************ Before login patient Routes ************************//
Route::get('/p-login', function () {
    return view('p_login');
})->middleware('afterLogin');
Route::get('/patient-reset/{token}/{time}', function ($token, $time) {
    return view('patient-reset', ['token'=> $token, 'time'=>$time]);
})->name('patient-reset');

Route::post('/pNew', [pAuth::class, 'newPat']);
Route::post('/pLogin', [pAuth::class, 'loginPat']);
Route::post('/patient-forgot-password', [pAuth::class, 'forgotPat']);
Route::post('/patient-change-password-route', [pAuth::class, 'changePasswordPat']);




Route::group(['middleware' => ['check_login']], function () { // This middleware checks that only login user access.
    Route::group(['middleware' => ['crossPat']], function() {   // This middleware checks that only doctor can access the below pages
        //**************************************** After login All doctor Routes ***************************************//

        Route::get('/d', function() {
            return view('d/index');
        });
        Route::view('/d/schedule-timings', 'd/schedule-timings');
        Route::post('/schedule-timings', [docHandler::class, 'scheduleTimings']);
        Route::post('/show-slots', [docHandler::class, 'showSlots']);
        Route::view('/d/appointments', '/d/appointments');
        Route::view('/d/forgot-password', '/d/forgot-password');
        Route::post('/page-forgot-password', [docHandler::class, 'page_forgot_password']);
        Route::get('/d/patient-profile/{id}', function ($id) {
            return view('/d/patient-profile', ['id'=>$id]);
        })->name('patient-profile');

        // doctor invoice
        // Route::get('/d/invoice/{id}', function ($id) {
        //     return view('/d/invoice', ['id'=>$id]);
        // })->name('invoice');

        Route::view('/d/invoice', '/d/invoice');
        Route::view('/d/profile-settings', '/d/profile-settings');
        Route::view('/d/change-password', '/d/change-password');

        // from here all doctor profile setting routes

        Route::post('/updateProfileImg', [docHandler::class, 'updateProfileImg']);
        Route::post('/updateAboutMeInfo', [docHandler::class, 'updateAboutMeInfo']);
        Route::post('/updateClinic', [docHandler::class, 'updateClinic']);
        Route::post('/updateOtherDetails', [docHandler::class, 'updateOtherDetails']);


        Route::post('/UpdateDoctorProfileSettings', [docHandler::class, 'UpdateDoctorProfileSettings']);
        Route::get('/todaysAppoinment', [docHandler::class, 'todaysAppoinment']);
        Route::get('/upcomingAppoinment', [docHandler::class, 'upcomingAppoinments']);
        Route::post('/videoCallLinkSend', [docHandler::class, 'videoCallLinkSend']);
        Route::post('/acceptAppoinment', [docHandler::class, 'acceptAppoinment']);
        Route::post('/cancelAppoinment', [docHandler::class, 'cancelAppoinment']);
        Route::post('/prescription-save', [docHandler::class, 'prescriptionSave']);
        Route::post('/edit-prescription-save', [docHandler::class, 'editPrescriptionSave']);
        Route::get('/display-prescription', [temp::class, 'displayPrescription']);
        Route::post('/delete-prescription', [docHandler::class, 'deletePrescription']);
    });




    Route::group(['middleware' => ['crossDoc']], function() {  // This middleware checks that only patient can access the below pages
        //******************************************* After login All Patients Routes *******************************************//

        Route::view('/p', 'p/index');
        Route::view('/p/dashboard', 'p/dashboard');
        Route::view('/p/change-password', 'p/change-password');

        Route::get('/p/doctor-profile/{id}', function ($id) {
            return view('/p/doctor-profile', ['id'=>$id]);
        })->name('doctor-profile');

        Route::get('/p/booking/{id}', function ($id) {
            return view('p/booking', ['id'=>$id]);
        })->name('booking');

        Route::post('/proccedToPay', [patHandler::class, 'proToPay']);
        Route::post('/chPasswordPat', [patHandler::class, 'chPasswordPat']);

        Route::get('/p/checkout/{id}/{date}/{time}', function ($id, $date, $time) {
            return view('/p/checkout', ['id'=>$id, 'date'=>$date, 'time'=>$time]);
        })->name('checkout');
    });
});

// logout route
Route::post('/logout', [logout::class, 'logout']);




//****************************TEST ROUTES******************************//


// email testing
Route::post('/emailTest', [testHandler::class, 'emailTest']);



