<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
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
        $this->validate($request, [
            'name' => 'required',
            'photo' => 'required',
            'priority' => 'required',
            'enable' => 'required',
        ]);

        $category = new Category();
        $category->name =$request->name;
        $category->photo =$request->photo;
        $category->priority =$request->priority;
        $category->enable =$request->enable;
        $category->save();

        return response($category, 201);
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
            'photo' => 'required',
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
        return response('sucess', 200);
    }
}
