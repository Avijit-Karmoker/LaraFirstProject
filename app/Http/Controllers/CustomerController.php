<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function account()
    {
        return view('frontend.account');
    }

    public function customer_register(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'email' => 'unique:users|email',
            'password' => 'min:8',
        ]);

        $id = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'role' => 'customer',
            'created_at' => Carbon::now(),
        ]);

        User::find($id)->sendEmailVerificationNotification();
        return back()->with('account_created', 'Your account has been created successfully! A verification email send to your mail successfully.');
    }

    public function customer_login(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'email' => 'email',
            'password' => 'min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('home');
        } else {
            echo "Your email or password is wrong!";
        }
    }
}
