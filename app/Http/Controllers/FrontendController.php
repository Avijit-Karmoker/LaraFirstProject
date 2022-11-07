<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Khsing\World\World;
use Khsing\World\Models\Country;

class FrontendController extends Controller
{
    function index()
    {
        return view('frontend.index', [
            'products' => Product::latest()->limit(6)->get(),
            'categories' => Category::all(),
            'brand_images' => Brand::limit(3)->get(),
        ]);
    }

    function about()
    {
        return view('frontend.about');
    }

    function product_details($id)
    {
        $product = Product::findOrFail($id);
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->get();
        return view('frontend.product_details', compact('product', 'related_products'));
    }

    function contact()
    {
        return view('frontend.contact');
    }

    function cart()
    {
        return view('frontend.cart');
    }

    function checkout()
    {
        $after_explode = explode('/', url()->previous());
        if(end($after_explode) =='cart'){
            $countries = World::Countries();
            return view('frontend.checkout', compact('countries'));
        }
        else{
            abort(404);
        }
        // return view('frontend.cart');
    }

    function getcitylist(Request $request)
    {
        $country = Country::getByCode($request->country_code);
        $cities_from_db = $country->children();
        $sorted = collect($cities_from_db)->sortBy('name');
        $cities = $sorted->values()->all();
        $generated_city_dropdown = "";
        foreach($cities as $city) {
            $generated_city_dropdown .= "<option value='$city->id'>$city->name</option>";
        }
        return $generated_city_dropdown;
    }

    function checkout_post(Request $request)
    {
        return $request;
    }

    function team()
    {
        //SELECT * FROM teams
        // $teams = Team::all();

        //SELECT * FROM teams WHERE id = 5
        // $teams = Team::find(5);

        // if given id not found then use findOrFail
        // $teams = Team::findOrFail(5);

        // SELECT * FROM teams WHERE phone_number = "192801923190309"
        // $teams = Team::where('phone_number', "192801923190309")->get();

        // SELECT id, name, phone_number FROM teams WHERE phone_number = "192801923190309";
        // $teams = Team::where('phone_number', "192801923190309")->get(['id', 'name', 'phone_number']);

        // SELECT * FROM teams WHERE name = "dysul" AND phone_number = "192801923190309"
        // $teams = Team::where([
        //     'name' => "dysul",
        //     'phone_number' => "192801923190309"
        // ])->get();

        //SELECT COUNT(*) AS total FROM teams
        // $teams = Team::count();

        //SELECT COUNT(*) AS total FROM teams WHERE name = "dysul"
        // $teams = Team::where('name', 'dysul')->count();

        $teams = Team::paginate(5);
        $teams_count = Team::count();
        $deleted_teams = Team::onlyTrashed()->get();
        return view('team', compact('teams', 'teams_count', 'deleted_teams'));
    }

    function teaminsert(Request $request)
    {
        $request->validate([
            "email" => 'required',
            "phone_number" => 'required',
        ], [
            'email.required' => "ইমেইল দেস নাই কেন?",
            'phone_number.required' => 'ফোন নাম্বার কই?'
        ]);
        if (preg_match('/^[a-z]+$/i', $request->name)) {
            if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $request->password)) {
                Team::insert([
                    // 'field name' => value
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => $request->password,
                    'created_at' => Carbon::now(),
                ]);
            } else {
                return back()->with('password_error', 'Password is not valid!');
            }
        } else {
            return back()->with('name_error', 'Name is not valid!');
        }
        return back()->with('success', 'Add member successfully!');
    }

    function teamSoftDelete($id)
    {
        if ($id == "all") {
            Team::where('deleted_at', NULL)->delete();
            return back();
        } else {
            //DELETE FROM teams WHERE id = $id;
            Team::find($id)->delete();
            return back();
        }
    }

    function teamDelete($id)
    {
        Team::where('id', $id)->forceDelete();
        return back();
    }

    function teamEdit($id)
    {
        // $team = Team::find($id);
        return view('teamedit', [
            'team' => Team::find($id),
        ]);
        // return view('teamedit')->with('team', $team);
        // return view('teamedit', compact('team'));
    }

    function teamEditPost(Request $request, $id)
    {
        //    UPDATE teams SET 'name' = $name. 'phone_number' = $phone_number, 'password' = $password WHERE id = $id
        Team::find($id)->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'password' => $request->password,
        ]);
        // return back();
        return redirect('team');
    }

    function teamRestore($id)
    {
        if ($id == "all") {
            Team::onlyTrashed()->restore();
            return back();
        } else {
            //DELETE FROM teams WHERE id = $id;
            Team::onlyTrashed()->where('id', $id)->restore();
            return back();
        }
    }

    function contact_post(Request $request)
    {
        Mail::to('bergthegold622@gmail.com')->send(new ContactMessage($request->except('_token')));
        return back();
    }
}
