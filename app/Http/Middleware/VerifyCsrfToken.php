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
        '/dNew',
        '/pNew',
        '/pLogin',
        '/loginEnable',
        '/loginDisable',
        '/approveDoctor',
        '/get_pend_doc',
        '/UnderReviewDoctor',
        '/removeUnderReview',
        '/RejectDoctor',
        '/removeRejectDoctor',
        '/todaysAppoinment',
        '/upcomingAppoinment',
        '/acceptAppoinment',
        '/cancelAppoinment',
        '/videoCallLinkSend',
        '/show-slots',
        '/proccedToPay',
        '/prescription-save',
        '/edit-prescription-save',
        '/delete-prescription',
        '/display-prescription',
        '/page-forgot-password',
        '/doctor-forgot-password',
        '/patient-forgot-password',
        '/chPasswordPat',
        '/chPasswordDoc',
    ];
}
