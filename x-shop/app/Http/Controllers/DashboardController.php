<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardPage(Request $request):View{
        return view('pages.dashboard.dashboard-page');
    }
}
