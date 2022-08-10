<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'customer') {
            return view('frontend.customer.dashboard');
        } else {
            return view('home', [
                'teams' => Team::all(),
            ]);
        }
    }

    public function users()
    {
        return view('users', [
            'users' => User::all(),
        ]);
    }
}
