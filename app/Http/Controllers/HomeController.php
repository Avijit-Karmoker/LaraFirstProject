<?php

namespace App\Http\Controllers;

use App\Mail\NewAdminMail;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function vendor_action_change($id)
    {
        $user = User::find($id);
        if ($user->action == false) {
            $user->action = true;
        }
        else {
            $user->action = false;
        }
        $user->save();
        return back();
    }

    public function add_user(Request $request)
    {
        $request->validate([
            "email_address" => 'unique:App\Models\User,email',
        ]);

        $random_password = Str::upper(Str::random(8));

        User::insert([
            'name' => $request->name,
            'email' => $request->email_address,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt($random_password),
            'created_at' => Carbon::now(),
            'role' => 'admin'
        ]);

        Mail::to($request->email_address)->send(new NewAdminMail(auth()->user()->name, $request->email_address, $random_password));

        return back();
    }
}
