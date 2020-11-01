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
Route::post('/gustavo', function (Request $request) {
    Validator::make($request->all(), [
        'name' => 'required',
        'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        'priority' => 'required',
        'enable' => 'required',
    ])->validate();
    // /storage/images/123.png
    $imageName = $request->file('photo')->getClientOriginalName();

    $pathName = $request->file('photo')->store('images', 'public');

    return $pathName;
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
});
