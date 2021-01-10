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
use App\Http\Resources\Additional as AdditionalResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id =  $request->user()->id;

        return Inertia::render('Product/Index', [
            'products' => Product::where('user_id', $user_id)->paginate(6)->transform(function ($product) {
                    return ProductResource::make($product);
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user =  $request->user();

        $categories = CategoryResource::collection($user->categories);
        $additionals = AdditionalResource::collection($user->additionals);

        return Inertia::render('Product/Create', [
            'categories' => $categories,
            'additionals' => $additionals
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

        $product->name = $request->name;
        $product->priority = $request->priority;
        $product->price = $request->price;

        $product->photo = $pathName;
        $product->description = $request->description;
        $product->enable = $request->enable == 'true' ? true : false;
        $product->available = true;
        $product->user_id = $request->user()->id;

        $product->save();

        $product->categories()->sync($request->category);
        $product->additionals()->sync($request->additionals);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $product = Product::findByUser($id, $user_id);

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $user =  $request->user();

        // Find
        $product = $user->products->where('id', $id)->first();
        if(!isset($product)) abort(404);

        $categories = CategoryResource::collection($user->categories);
        $additionals = AdditionalResource::collection($user->additionals);

        return Inertia::render('Product/Edit', [
            'product' => new ProductResource($product),
            'categories' => $categories,
            'additionals' => $additionals
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
        $user_id =  $request->user()->id;
        $product = Product::findByUser($id, $user_id);

        if($request->updateImage != "false"){
            $pathName = $request->file('photo')->store('images', 'public');
            $product->photo = $pathName;
        }

        $product->categories()->sync($request->category);
        $product->additionals()->sync($request->additionals);

        $product->name = $request->name;
        $product->priority = $request->priority;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->enable = $request->enable == 'true' ? true : false;
        $product->available = true;
        $product->user_id = $request->user()->id;
        $product->save();

        return redirect()->back()->with('message', 'Produto Atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $product = Product::findByUser($id, $user_id);
        $product->delete();

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
        $product = Product::findByUser($id, $user_id);
        $product->enable = $product->enable ? false : true;
        $product->save();

        return redirect()->back();
    }
}
