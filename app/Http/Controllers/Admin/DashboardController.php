<?php

namespace SCF\Http\Controllers\Admin;

use GeoIp2\Database\Reader;
use Illuminate\Http\Request;
use SCF\Http\Controllers\Controller;
use SCF\Library\Location;
use SCF\Models\User;

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

    /**
     * Users page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users()
    {
        $users = User::paginate();

        return view('admin.users', compact('users'));
    }

    /**
     * Reviews page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reviews()
    {
        return view('admin.reviews');
    }

    /**
     * Report page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report()
    {
        return view('admin.report');
    }

    /**
     * Settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        return view('admin.settings');
    }
}
