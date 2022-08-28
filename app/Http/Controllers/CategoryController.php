<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()     //index => all list show function
    {
        return view('dashboard.category.index', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()   //insert form
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)         //store => form data insert
    {
        $request->validate([
            'category_name' => 'required',
            'category_photo' => 'required | image',
        ]);

        if ($request->category_slug) {
            $slug = Str::slug($request->category_slug);
        } else {
            $slug = Str::slug($request->category_name);
        }

        //photo upload start
        $extention = $request->file('category_photo')->getClientOriginalExtension();
        $new_category_name = auth()->id() . "_" . time() . "." . $extention;
        $img = Image::make($request->file('category_photo'))->resize(200, 256);
        $img->save(base_path('public/uploads/category_photos/' . $new_category_name), 80);
        //photo upload end

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'category_photo' => $new_category_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)   //show=> shoe data individual
    {
        return view('dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  //edit => edit form
    {
        return view('dashboard.category.edit', [
            'category' => Category::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  //update => edit code
    {
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_slug),
        ]);

        if ($request->hasFile('category_photo')) {
            //delete file from host
            unlink(base_path('public/uploads/category_photos/' . Category::find($id)->category_photo));

            //image upload
            $extention = $request->file('category_photo')->getClientOriginalExtension();
            $new_category_name = auth()->id() . "_" . time() . "." . $extention;
            $img = Image::make($request->file('category_photo'))->resize(200, 256);
            $img->save(base_path('public/uploads/category_photos/' . $new_category_name), 80);
            //photo upload end
            Category::find($id)->update([
                'category_photo' => $new_category_name,
            ]);
        } else {
            return back()->withErrors('image_error', 'Please upload an image');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  //destroy => delete
    {
        Category::find($id)->delete();
        return redirect('category');
    }
}
