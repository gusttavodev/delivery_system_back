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

use Spatie\Permission\Models\Role;

use App\Models\WppSession;
use App\Http\Requests\WppSession\WppSessionCreate;
use App\Events\WppSessionEvent;

Route::post('/gustavo', function (Request $request) {
    $wppSession = WppSession::first();
    $wppSession->is_auth = $request->qrCode ? true : false;
    $wppSession->save();
    WppSessionEvent::dispatch($wppSession);
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

Route::group(['namespace'=>'App\Http\Controllers' ,'prefix' => '/user', 'middleware' => ['auth:sanctum', 'is_admin']], function () {
    Route::get('/', array('as' => 'indexUser', 'uses' => 'UserController@index'));
    Route::get('/create', array('as' => 'createUser', 'uses' => 'UserController@create'));
    Route::post('/create', array('as' => 'storeUser', 'uses' => 'UserController@store'));
    Route::delete('/{id}', array('as' => 'deleteUser', 'uses' => 'UserController@destroy'));
    Route::get('/edit/{id}', array('as' => 'editUser', 'uses' => 'UserController@edit'));
    Route::post('/edit/{id}', array('as' => 'updateUser', 'uses' => 'UserController@update'));
});

Route::group(['namespace'=>'App\Http\Controllers' ,'prefix' => '/role', 'middleware' => ['auth:sanctum', 'is_admin']], function () {
    Route::get('/', array('as' => 'indexRole', 'uses' => 'RoleController@index'));
    Route::get('/create', array('as' => 'createRole', 'uses' => 'RoleController@create'));
    Route::post('/create', array('as' => 'storeRole', 'uses' => 'RoleController@store'));
    Route::delete('/{id}', array('as' => 'deleteRole', 'uses' => 'RoleController@destroy'));
    Route::get('/edit/{id}', array('as' => 'editRole', 'uses' => 'RoleController@edit'));
    Route::post('/edit/{id}', array('as' => 'updateRole', 'uses' => 'RoleController@update'));
});

Route::group(['namespace'=>'App\Http\Controllers' ,'prefix' => '/wpp/contacts', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', array('as' => 'indexWppContacs', 'uses' => 'WppContactController@index'));
    Route::get('/create', array('as' => 'createWppContacs', 'uses' => 'WppContactController@create'));
    Route::post('/create', array('as' => 'storeWppContacs', 'uses' => 'WppContactController@store'));
    Route::delete('/{id}', array('as' => 'deleteWppContacs', 'uses' => 'WppContactController@destroy'));
    Route::get('/edit/{id}', array('as' => 'editWppContacs', 'uses' => 'WppContactController@edit'));
    Route::post('/edit/{id}', array('as' => 'updateWppContacs', 'uses' => 'WppContactController@update'));

    // Route::get('/import', array('as' => 'indexWppContacs', 'uses' => 'WppContactController@index'));
});

Route::group(['namespace'=>'App\Http\Controllers' ,'prefix' => '/wpp/session', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', array('as' => 'indexWppSession', 'uses' => 'WppSessionController@index'));
    Route::get('/create', array('as' => 'createWppSession', 'uses' => 'WppSessionController@create'));
    Route::post('/create', array('as' => 'storeWppSession', 'uses' => 'WppSessionController@store'));
    Route::delete('/{id}', array('as' => 'deleteWppSession', 'uses' => 'WppSessionController@destroy'));
    Route::get('/edit/{id}', array('as' => 'editWppSession', 'uses' => 'WppSessionController@edit'));
    Route::post('/edit/{id}', array('as' => 'updateWppSession', 'uses' => 'WppSessionController@update'));
});

Route::group(['namespace'=>'App\Http\Controllers' ,'prefix' => '/roadmap', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', array('as' => 'indexRoadmap', 'uses' => 'RoadmapController@index'));
    Route::get('/create', array('as' => 'createRoadmap', 'uses' => 'RoadmapController@create'));
    Route::post('/create', array('as' => 'storeRoadmap', 'uses' => 'RoadmapController@store'));
    Route::delete('/{id}', array('as' => 'deleteRoadmap', 'uses' => 'RoadmapController@destroy'));
    Route::get('/edit/{id}', array('as' => 'editRoadmap', 'uses' => 'RoadmapController@edit'));
    Route::post('/edit/{id}', array('as' => 'updateRoadmap', 'uses' => 'RoadmapController@update'));
});

Route::group(['namespace'=>'App\Http\Controllers' ,'prefix' => '/roadmap/{roadmap_id}/step', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', array('as' => 'indexRoadmapStep', 'uses' => 'RoadmapStepController@index'));
    Route::get('/create', array('as' => 'createRoadmapStep', 'uses' => 'RoadmapStepController@create'));
    Route::post('/create', array('as' => 'storeRoadmapStep', 'uses' => 'RoadmapStepController@store'));
    Route::delete('/{id}', array('as' => 'deleteRoadmapStep', 'uses' => 'RoadmapStepController@destroy'));
    Route::get('/edit/{id}', array('as' => 'editRoadmapStep', 'uses' => 'RoadmapStepController@edit'));
    Route::post('/edit/{id}', array('as' => 'updateRoadmapStep', 'uses' => 'RoadmapStepController@update'));

    Route::post('/store/order', array('as' => 'storeOrderRoadmapStep', 'uses' => 'RoadmapStepController@storeOrder'));
});

