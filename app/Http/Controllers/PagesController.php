<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
            $user = User::find(auth()->user()->id)->with('posts')->first();
            return \view('home', compact('user'));
        }
        return \view('pages.landing');
    }
}
