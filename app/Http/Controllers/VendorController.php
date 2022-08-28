<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function vendor_regestration()
    {
        return view('frontend.vendor.register');
    }

    public function vendor_login()
    {
        return view('frontend.vendor.login');
    }

    public function vendor_login_post(Request $request)
    {
        if(User::where('email', $request->email)->exists()){
            if(User::where('email', $request->email)->first()->role == 'vendor'){
                if(User::where('email', $request->email)->first()->action == true){
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        return redirect('home');
                    } else {
                        echo "Your email or password is wrong!";
                    }
                }
                else {
                    return "Your account is not approved";
                }
            }
            else {
                return "You are not vendor";
            }
        }
        else{
            return "You are not register yet";
        }
    }

    public function vendor_regestration_post(Request $request)
    {
        User::insert([
            $request->except('_token', 'password', 'password_confirmation', 'g-recaptcha-response') + [
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt($request->password),
                'created_at' => Carbon::now(),
                'role' => 'vendor',
                'action' => false,
            ]
        ]);

        // User::insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'email_verified_at' => Carbon::now(),
        //     'password' => bcrypt($request->password),
        //     'phone_number' => $request->phone_number,
        //     'created_at' => Carbon::now(),
        //     'role' => 'vendor',
        // ]);
        return redirect('/vendor/login');
    }
}
