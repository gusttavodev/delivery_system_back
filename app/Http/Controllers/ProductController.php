<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Category as CategoryResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::paginate(6)->transform(function ($product) {
                    return ProductResource::make($product);
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
        return Inertia::render('Product/Create', [
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
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
        $product = Product::findOrFail($id)->where('id', $id)->with('categories')->get();
        $categories = CategoryResource::collection(Category::all());

        return Inertia::render('Product/Edit', [
            'product' => new ProductResource($product[0]),
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if($request->updateImage != "false"){
            $pathName = $request->file('photo')->store('images', 'public');
            $product->photo = $pathName;
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

        return redirect()->back();
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
