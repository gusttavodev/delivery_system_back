<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::paginate(6);

        return Inertia::render('Category/Index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'priority' => 'required',
            'enable' => 'required',
        ])->validate();

        $pathName = $request->file('photo')->store('images', 'public');

        $category = new Category();
        $category->name = $request->name;
        $category->photo = $pathName;
        $category->priority = $request->priority;
        $category->enable = $request->enable == 'true' ? true : false;
        $category->save();

        return redirect()->back()->with('message', 'Post Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'priority' => 'required',
            'enable' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->name =$request->name;
        $category->photo =$request->photo;
        $category->priority =$request->priority;
        $category->enable =$request->enable;
        $category->save();

        return response($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        $categories = Category::all();
        return Inertia::render('Category/Index', ['categories' => $categories]);
    }
}
