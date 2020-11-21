<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Resources\User as UserResource;

use App\Http\Requests\User\UserCreateRequest;

use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Index', [
            'users' => User::paginate(6)->transform(function ($user) {
                    return UserResource::make($user);
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
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user =  DB::transaction(function () use ($request) {
            return tap(User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });

        $user->assignRole('User');

        // return redirect()->back()->with('message', 'Usuario Criado com Successo.');
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
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
        User::findOrFail($id)->delete();

        return redirect()->back();
    }

}
