<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use App\Models\Additional;
use Illuminate\Http\Request;
use App\Http\Resources\Additional as AdditionalResource;
use App\Http\Requests\Additional\AdditionalCreateRequest;

class AdditionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id =  $request->user()->id;

        return Inertia::render('Additional/Index', [
            'additionals' => Additional::where('user_id', $user_id)->paginate(6)->transform(function ($additionals) {
                    return AdditionalResource::make($additionals);
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
        return Inertia::render('Additional/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdditionalCreateRequest $request)
    {
        $additional = new Additional();
        $additional->name = $request->name;
        $additional->price = $request->price;
        $additional->quantity_limit = $request->quantity_limit;

        $additional->user_id = $request->user()->id;

        $additional->save();

        return redirect()->back()->with('message', 'Adicionar criado com sucesso !!!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function show(Additional $additional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $additional = Additional::findOrFail($id);
        return Inertia::render('Additional/Edit', ['additional' => $additional]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function update($id, AdditionalCreateRequest $request)
    {
        $user_id =  $request->user()->id;
        $additional = Additional::findByUser($id, $user_id);

        $additional->name = $request->name;
        $additional->price = $request->price;
        $additional->quantity_limit = $request->quantity_limit;

        $additional->user_id = $request->user()->id;

        $additional->save();

        return redirect()->back()->with('message', 'Adicional atualizado com sucesso !!!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user_id =  $request->user()->id;
        $additional = Additional::findByUser($id, $user_id);
        $additional->delete();

        return redirect()->back();
    }
}
