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

        // $establishmentPrimaryColor = "app_blue";
        // $establishmentSecondaryColor = "app_dark_blue";
        // $establishmentTextColor = "red-800";
        // $establishmentTitleTextColor = "orange-400";
        // $establishmentTitleTextHoverColor = "red-100";
        // $establishmentBackgroundColor = "gray-500";

        $establishmentPrimaryColor = "app_blue";
        $establishmentSecondaryColor = "app_dark_blue";
        $establishmentTextColor = "black";
        $establishmentTitleTextColor = "black";
        $establishmentTitleTextHoverColor = "white";
        $establishmentBackgroundColor = "gray-100";


        return Inertia::render('Menu/Establishment/Home', [
            'categories' =>  CategoryWithProducts::collection($categories),
            'establishment' => new EstablishmentResource($establishment),
            'primary_color' => $establishmentPrimaryColor,
            'secondary_color' => $establishmentSecondaryColor,
            'text_color' => $establishmentTextColor,
            'title_text_color' => $establishmentTitleTextColor,
            'title_text_hover_color' => $establishmentTitleTextHoverColor,
            'background_color' => $establishmentBackgroundColor
        ]);
    }
}
