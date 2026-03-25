<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $view = 'home')
    {
        $lang = app()->getLocale();

        if (view()->exists("web.$lang.$view")) {
            return view("web.$lang.$view");
        }

        abort(404);
    }
}
