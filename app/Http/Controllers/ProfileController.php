<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        if (Verification::where('user_id', auth()->id())->exists()) {
            if (Verification::where('user_id', auth()->id())->first()->status) {
                $verification_status = true;
            } else {
                $verification_status = false;
            }
        } else {
            $verification_status = false;
        }
        return view('dashboard.profile.index', compact('verification_status'));
    }

    public function profile_photo_upload(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image',
        ]);
        $extention = $request->file('profile_photo')->getClientOriginalExtension();
        $new_name = auth()->user()->name . "_" . auth()->id() . "_" . Carbon::now()->format('Y_m_d') . "." . $extention;
        $img = Image::make($request->file('profile_photo'))->resize(300, 300);
        $img->save(base_path('public/uploads/profile_photos/' . $new_name), 80);

        User::find(auth()->id())->update([
            'profile_photo' => $new_name
        ]);
        return back();
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8|different:current_password',
            'password_confirmation' => 'required',
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)) {
            User::find(auth()->id())->update([
                'password' => bcrypt($request->password),
            ]);
            return back()->with('success', 'New password set successfully!');
        } else {
            return back()->withErrors("Your current password dosen't matched!");
        }
    }
    public function send_verfication_code()
    {
        // auth()->user()->phone_number
        // Str::upper(Str::random(6))
        // ;
        $code = rand(1111, 9999);
        $url = "http://66.45.237.70/api.php";
        $number = auth()->user()->phone_number;
        $text = "Hello, " . auth()->user()->name . " Your balance is: " . $code;
        $data = array(
            'username' => "01834833973",
            'password' => "TE47RSDM",
            'number' => "$number",
            'message' => "$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|", $smsresult);
        Verification::insert([
            'user_id' => auth()->id(),
            'phone_number' => $number,
            'code' => $code,
            'created_at' => Carbon::now()
        ]);
        return back()->with('code_success', 'A four digit code sent to your mobile number!');
    }

    public function check_code(Request $request)
    {
        if ($request->code == Verification::where('user_id', auth()->id())->first()->code) {
            Verification::where('user_id', auth()->id())->update([
                'status' => true,
            ]);
            return back();
        } else {
            return back()->withErrors("Code dosen't match");
        }
    }
}
