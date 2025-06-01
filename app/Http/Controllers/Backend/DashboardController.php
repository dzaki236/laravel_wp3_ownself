<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __invoke()
    {
        $data['page'] = 'dashboard';
        $data['title'] = 'Dashboard Admin';
        return view('backend.dashboard.index', $data);
    }
}
