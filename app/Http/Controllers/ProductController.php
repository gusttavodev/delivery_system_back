<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(6);

        return Inertia::render('Product/Index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Product/Create', ['categories' => $categories]);
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
            'price' => 'required',
            'description' => 'required',
            'category' => 'required|min:3',

        ])->validate();

        $pathName = $request->file('photo')->store('images', 'public');

        $product = new Product();

        $categoryArray = json_decode($request->category);

        $product->name = $request->name;
        $product->priority = $request->priority;
        $product->price = $request->price;

        $product->photo = $pathName;
        $product->description = $request->description;
        $product->enable = $request->enable == 'true' ? true : false;
        $product->available = true;

        $product->save();

        foreach ($categoryArray as $value) {
            $product->categories()->sync($value, false);
        }

        return redirect()->back()->with('message', 'Post Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id)->with('categories')->get();

        $categories = Category::all();
        return Inertia::render('Product/Edit', ['product' => $product[0], 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($request->updateImage != "false"){
            $this->validate($request, [
                'name' => 'required',
                'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
                'priority' => 'required',
                'enable' => 'required',
                'price' => 'required',
                'description' => 'required',
                'category' => 'required|min:3',
            ]);
            $pathName = $request->file('photo')->store('images', 'public');
            $product->photo = $pathName;
        }else{
            $this->validate($request, [
                'name' => 'required',
                'priority' => 'required',
                'enable' => 'required',
                'price' => 'required',
                'description' => 'required',
                'category' => 'required|min:3',
            ]);
        }
        $categoryArray = json_decode($request->category);

        foreach ($categoryArray as $value) {
            $product->categories()->sync($value, false);
        }
        $product->name = $request->name;
        $product->priority = $request->priority;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->enable = $request->enable == 'true' ? true : false;
        $product->available = true;
        $product->save();

        return redirect()->back()->with('message', 'Produto Atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        $products = Product::paginate(6);
        return Inertia::render('Product/Index', ['products' => $products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enableDisable($id)
    {
        $product = Product::findOrFail($id);
        $product->enable = $product->enable ? false : true;
        $product->save();

        return redirect()->back();
    }
}
