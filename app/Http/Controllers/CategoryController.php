<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Category/Index', [
            'categories' => Category::paginate(6)->transform(function ($category) {
                    return CategoryResource::make($category);
            }),
        ]);
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
    public function store(CategoryCreateRequest $request)
    {
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
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return Inertia::render('Category/Edit', ['category' => new CategoryResource($category)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        if($request->updateImage != "false"){
            $pathName = $request->file('photo')->store('images', 'public');
            $category->photo = $pathName;
        }

        $category->name = $request->name;
        $category->priority = $request->priority;
        $category->enable = $request->enable == 'true' ? true : false;
        $category->save();

        return redirect()->back()->with('message', 'Categoria Atualizado com sucesso.');
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

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enableDisable($id)
    {
        $category = Category::findOrFail($id);
        $category->enable = $category->enable ? false : true;
        $category->save();

        return redirect()->back();
    }
}
