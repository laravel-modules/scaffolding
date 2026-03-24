<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('dashboard.home');
    }
}
