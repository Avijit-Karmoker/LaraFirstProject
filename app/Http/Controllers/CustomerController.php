<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Invoice_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\InvoicesExport;
use App\Models\Review;
use Maatwebsite\Excel\Facades\Excel;
use Image;

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

    public function download_invoice($id)
    {
        $invoice = Invoice::find($id);
        $invoice_details = Invoice_detail::where('invoice_id', $id)->get();
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice', 'invoice_details'));
        return $pdf->setPaper('a4', 'portrait')->stream(time().'-invoice.pdf');
    }

    public function download_invoice_all($id)
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function give_review($id){
        $invoice_details = Invoice_detail::with('relationshipwithproduct')->where('invoice_id', $id)->get();
        return view('frontend.customer.review', compact('invoice_details'));
    }

    public function insert_review(Request $request, $invoice_details_id){
        $product_id = Invoice_detail::find($invoice_details_id)->product_id;

        if($request->hasfile('review_image')) {
            $extention = $request->file('review_image')->getClientOriginalExtension();
            $new_review_image = $invoice_details_id . "-" . Carbon::now()->format('Y_m_d') . "." . $extention;
            $img = Image::make($request->file('review_image'))->resize(800, 609);
            $img->save(base_path('public/uploads/review_image/' . $new_review_image), 80);

            Review::insert([
                'user_id' => auth()->id(),
                'product_id' => $product_id,
                'invoice_details_id' => $invoice_details_id,
                'rating' => $request->rating,
                'comment' => $request->comments,
                'review_image' => $new_review_image,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            Review::insert([
                'user_id' => auth()->id(),
                'product_id' => $product_id,
                'invoice_details_id' => $invoice_details_id,
                'rating' => $request->rating,
                'comment' => $request->comments,
                'created_at' => Carbon::now(),
            ]);
        }

        return back();
    }
}

