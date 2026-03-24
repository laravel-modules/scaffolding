<?php

namespace App\Emails\Http\Controllers;

use App\Emails\Models\Email;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class MailJobController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the email.
     */
    public function index(): View
    {
        $emails = Email::query()->latest()->paginate();

        return view('dashboard.emails.index', compact('emails'));
    }

    /**
     * Display the specified email.
     */
    public function show(Email $email): View
    {
        return view('dashboard.emails.show', compact('email'));
    }
}
