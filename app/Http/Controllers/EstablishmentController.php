<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use Illuminate\Http\Request;
use Inertia\Inertia;


use App\Http\Requests\Establishment\EstablishmentCreateRequest;

use App\Http\Resources\Establishment as EstablishmentResource;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id =  $request->user()->id;

        return Inertia::render('Establishment/Index', [
            'establishments' => Establishment::where('user_id', $user_id)->paginate(6)->transform(function ($establishments) {
                    return EstablishmentResource::make($establishments);
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
        return Inertia::render('Establishment/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EstablishmentCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstablishmentCreateRequest $request)
    {
        $picturePath = $request->file('picture')->store('images', 'public');
        $backgroundPicturePath = $request->file('background_picture')->store('images', 'public');

        $establishment = new Establishment();

        $establishment->name = $request->name;
        $establishment->description = $request->description;
        $establishment->delivery_time = $request->delivery_time;
        $establishment->min_value = $request->min_value;
        $establishment->phone = $request->phone;

        $establishment->picture = $picturePath;
        $establishment->background_picture = $backgroundPicturePath;
        $establishment->user_id = $request->user()->id;

        $establishment->public_link_name = strtolower(str_replace(' ', '_', $request->name));

        $establishment->save();

        return redirect()->back()->with('message', 'Estabelecimento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Establishment $establishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establishment $establishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establishment $establishment)
    {
        //
    }
}
