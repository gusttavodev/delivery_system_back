<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
Route::post('/gustavo', function (Request $request) {
    $product = Product::findOrFail(9)->with('categories')->get();

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


    $product->name = $request->name;
    $product->priority = $request->priority;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->enable = $request->enable == 'true' ? true : false;
    $product->available = true;

    // $product->save();

    return "OK";
});


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['namespace'=>'App\Http\Controllers' ,'prefix' => '/category', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', array('as' => 'indexCategory', 'uses' => 'CategoryController@index'));
    Route::get('/create', array('as' => 'createCategory', 'uses' => 'CategoryController@create'));
    Route::post('/create', array('as' => 'storeCategory', 'uses' => 'CategoryController@store'));
    Route::delete('/{id}', array('as' => 'deleteCategory', 'uses' => 'CategoryController@destroy'));
    Route::get('/edit/{id}', array('as' => 'editCategory', 'uses' => 'CategoryController@edit'));
    Route::post('/edit/{id}', array('as' => 'updateCategory', 'uses' => 'CategoryController@update'));
    Route::post('/enableDisable/{id}', array('as' => 'enableDisableCategory', 'uses' => 'CategoryController@enableDisable'));
});


Route::group(['namespace'=>'App\Http\Controllers' ,'prefix' => '/product', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', array('as' => 'indexProduct', 'uses' => 'ProductController@index'));
    Route::get('/create', array('as' => 'createProduct', 'uses' => 'ProductController@create'));
    Route::post('/create', array('as' => 'storeProduct', 'uses' => 'ProductController@store'));
    Route::delete('/{id}', array('as' => 'deleteProduct', 'uses' => 'ProductController@destroy'));
    Route::get('/edit/{id}', array('as' => 'editProduct', 'uses' => 'ProductController@edit'));
    Route::post('/edit/{id}', array('as' => 'updateProduct', 'uses' => 'ProductController@update'));
    Route::post('/enableDisable/{id}', array('as' => 'enableDisableProduct', 'uses' => 'ProductController@enableDisable'));
});
