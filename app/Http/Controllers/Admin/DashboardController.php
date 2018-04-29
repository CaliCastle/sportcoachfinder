<?php

namespace SCF\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SCF\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show dashboard of admin.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
