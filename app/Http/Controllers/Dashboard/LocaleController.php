<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Change the dashboard language.
     *
     * @param  string  $locale
     * @return RedirectResponse
     */
    public function update($locale)
    {
        Session::put('locale', $locale);

        return back();
    }
}
