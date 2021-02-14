<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

use Illuminate\Http\Request;

use App\Models\Establishment;
use App\Http\Resources\CategoryWithProducts;
use App\Http\Resources\Establishment as EstablishmentResource;

class PublicEstablishmentController extends Controller
{
    public function home($public_link_name)
    {
        $establishment = Establishment::where('public_link_name', $public_link_name)->get()->first();

        $userId = $establishment->user_id;
        $user = User::find($userId);
        $categories = $user->categories;
        return Inertia::render('Menu/Establishment/Home', [
            'categories' =>  CategoryWithProducts::collection($categories),
            'establishment' => new EstablishmentResource($establishment)
        ]);
    }
}
