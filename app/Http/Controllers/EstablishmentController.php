<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Address;
use App\Enums\DaysOfWeek;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Http\Resources\Establishment as EstablishmentResource;

use App\Http\Requests\Establishment\EstablishmentCreateRequest;
use App\Http\Requests\Establishment\EstablishmentUpdateRequest;
use App\Http\Requests\Establishment\EstablishmentAddressCreateRequest;

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
    public function edit($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $establishment = Establishment::findByUser($id, $user_id);

        $daysOfWeek = DaysOfWeek::List;

        return Inertia::render('Establishment/Edit', [
            'establishment' => EstablishmentResource::make($establishment),
            'daysOfWeek' => $daysOfWeek
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function update($id,  EstablishmentUpdateRequest $request)
    {
        $user_id =  $request->user()->id;
        $establishment = Establishment::findByUser($id, $user_id);

        $establishment->name = $request->name;
        $establishment->description = $request->description;
        $establishment->delivery_time = $request->delivery_time;
        $establishment->min_value = $request->min_value;
        $establishment->phone = $request->phone;

        if($request->picture) {
            $picturePath = $request->file('picture')->store('images', 'public');
            $establishment->picture = $picturePath;
        }
        if($request->background_picture) {
            $backgroundPicturePath = $request->file('background_picture')->store('images', 'public');
            $establishment->background_picture = $backgroundPicturePath;
        }

        $establishment->public_link_name = strtolower(str_replace(' ', '_', $request->name));
        $establishment->save();

        return redirect()->back()->with('message', 'Estabelecimento atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $establishment = Establishment::findByUser($id, $user_id);

        return redirect()->back();
    }

    public function storeAddress(EstablishmentAddressCreateRequest $request)
    {
        $establishment = $request->establishment;

        if($establishment->address_id){
            $address = Address::find($establishment->address_id);
        }else {
            $address = new Address();
        }

        $address->zip_code = $request->zip_code;
        $address->street = $request->street;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->district = $request->district;
        $address->state = $request->state;
        $address->number = $request->number;
        $address->complement = $request->complement;
        $address->save();

        $establishment->address_id = $address->id;
        $establishment->save();

        return redirect()->back();
    }
}
