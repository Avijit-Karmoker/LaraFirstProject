<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Withdrawl;
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

    public function vendor_order()
    {
        $invoices = Invoice::with(['invoice_details' => function($q){
            $q->with('relationshipwithproduct');
        }])->where('vendor_id', auth()->id())->get();
        return view('dashboard.vendor.order', compact('invoices'));
    }

    public function vendor_order_status_change(Request $request, $id)
    {
        Invoice::find($id)->update([
            'order_status' => $request->order_status
        ]);
        if($request->order_status == 'delivered'){
            if(Invoice::find($id)->payment_method == 'cod'){
                Invoice::find($id)->update([
                    'payment_status' => 'paid'
                ]);
            }
        }
        return back();
    }

    public function vendor_wallet()
    {
        $invoices = Invoice::with(['invoice_details' => function($q){
            $q->with('relationshipwithproduct');
        }])->where([
            'vendor_id' => auth()->id(),
            'payment_status' => 'paid',
            'order_status' => 'delivered'
        ])->get();
        return view('dashboard.vendor.wallet', compact('invoices'));
    }

    public function vendor_wallet_withdraw(Request $request)
    {
        $invoices = Invoice::whereIn('id', $request->invoices)->get();
        return view('dashboard.vendor.wallet_withdraw', compact('invoices'));
    }

    public function vendor_wallet_withdraw_request(Request $request)
    {
        $withdraw_ids = explode(',', rtrim(ltrim($request->withdraw_ids, '['), ']'));
        foreach($withdraw_ids as $withdraw_id){
            Withdrawl::insert([
                'invoice_id' => $withdraw_id,
                'vendor_id' => auth()->id(),
                'created_at' => Carbon::now(),
            ]);
            Invoice::find($withdraw_id)->update([
                'withdraw_status' => 'request sent',
            ]);
        }
        return redirect('vendor/wallet');
    }
}
