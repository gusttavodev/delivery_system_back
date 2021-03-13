<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Http\Resources\ThemeResource;
use App\Http\Requests\ThemeCreateRequest;
use App\Http\Resources\Establishment as EstablishmentResource;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Theme/Index', [
            'themes' => Theme::paginate(6)->transform(function ($theme) {
                    return ThemeResource::make($theme);
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
        return Inertia::render('Theme/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ThemeCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThemeCreateRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = $request->user()->id;

        Theme::create($input);

        return redirect()->back()->with('message', 'Thema criado com sucesso !!!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\ThemeResource
     */
    public function show(Theme $theme)
    {
        $theme = Theme::findOrFail($id);
        return new ThemeResource($theme);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Number  $id
     * @return \Illuminate\Http\ThemeResource
     */
    public function edit($id)
    {
        $theme = Theme::findOrFail($id);
        return Inertia::render('Theme/Edit', ['theme' => new ThemeResource($theme)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeCreateRequest $request, $id)
    {
        // $theme =  $request->user()->themes->where('id', $id)->first();
        $request->user()->themes()->findOrFail($id);

        $input = $request->validated();
        $input['user_id'] = $request->user()->id;

        $theme->update($input);

        return redirect()->back()->with('message', 'Tema atualizado !!!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $theme =  $request->user()->themes->where('id', $id)->first();
        $theme->delete();

        return redirect()->back()->with('message', 'Tema removido  !!!.');
    }
}
