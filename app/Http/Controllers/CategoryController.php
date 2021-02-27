<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id =  $request->user()->id;

        return Inertia::render('Category/Index', [
            'categories' => Category::where('user_id', $user_id)->paginate(6)->transform(function ($category) {
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
        $filePath = $request->file('photo')->store('images/category');
        Storage::disk(env('FILESYSTEM_DRIVER'))->put('images/category', $request->file('photo'));

        $category = new Category();
        $category->name = $request->name;
        $category->photo = $filePath;
        $category->priority = $request->priority;
        $category->enable = $request->enable == 'true' ? true : false;
        $category->user_id = $request->user()->id;
        $category->save();

        return redirect()->back()->with('message', 'Post Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $category = Category::findByUser($id, $user_id);

        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $category = Category::findByUser($id, $user_id);

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

        $user_id =  $request->user()->id;
        $category = Category::findByUser($id, $user_id);

        if($request->updateImage != "false"){
            $filePath = $request->file('photo')->store('images/category');
            Storage::disk(env('FILESYSTEM_DRIVER'))->put('images/category', $request->file('photo'));

            $category->photo = $filePath;
        }

        $category->name = $request->name;
        $category->priority = $request->priority;
        $category->enable = $request->enable == 'true' ? true : false;
        $category->user_id = $request->user()->id;
        $category->save();

        return redirect()->back()->with('message', 'Categoria Atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $category = Category::findByUser($id, $user_id);
        $category->delete();

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enableDisable($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $category = Category::findByUser($id, $user_id);
        $category->enable = $category->enable ? false : true;
        $category->save();

        return redirect()->back();
    }
}
