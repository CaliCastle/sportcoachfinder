<?php

namespace SCF\Http\Controllers;

use Illuminate\Http\Request;
use SCF\Sport;

class HomeController extends Controller
{
    /**
     * HTTP Request.
     *
     * @var Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showBecomeACoach()
    {
        return view('apply');
    }
}
