<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard.home', absolute: false))
                    : inertia('Auth/VerifyEmail', [
                        'config' => [
                            'banner' => asset('build/images/illustrations/boy-verify-email-light.png'),
                        ],
                    ]);
    }
}
