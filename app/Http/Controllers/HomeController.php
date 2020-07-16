<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // put your magic
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'pagetitle'    => 'Dashboard',
            'cardTitle'    => NULL,
            'cardSubTitle' => NULL,
            'cardIcon'     => NULL,
            'breadcrumb'   => ['Index' => route('home')]
        ];

        return view('home', $data);
    }
}
