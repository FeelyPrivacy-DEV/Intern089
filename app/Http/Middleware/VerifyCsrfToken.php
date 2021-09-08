<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/admin_login',
        '/admin_registration',
        '/',
        'dNew',
        'pNew',
        'pLogin',
        '/loginEnable',
        '/loginDisable',
        '/approveDoctor',
        '/todaysAppoinment',
        '/upcomingAppoinment',
        'acceptAppoinment',
        'cancelAppoinment',
        '/show-slots',
        '/proccedToPay',
        '/doctor-forgot-password',
        '/patient-forgot-password',
    ];
}
