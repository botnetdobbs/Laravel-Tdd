<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * return landing page if guest and dashboard if authenticated
     *
     * @return void
     */
    public function index()
    {
        if (auth()->user()) {
            return \view('home');
        }
        return \view('pages.landing');
    }
}
