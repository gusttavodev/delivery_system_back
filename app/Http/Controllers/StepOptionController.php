<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;

use App\Models\StepOption;
use App\Models\RoadmapStep;
use Illuminate\Http\Request;

class StepOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($roadmap_step_id, Request $request)
    {
        $roadmapStep = RoadmapStep::find($roadmap_step_id);

        $user_id =  $request->user()->id;
        $products = Product::where('user_id', $user_id)->get();

        return Inertia::render('StepOption/Create', [
            'roadmapStep' => $roadmapStep,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StepOption  $stepOption
     * @return \Illuminate\Http\Response
     */
    public function show(StepOption $stepOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StepOption  $stepOption
     * @return \Illuminate\Http\Response
     */
    public function edit(StepOption $stepOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StepOption  $stepOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StepOption $stepOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StepOption  $stepOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(StepOption $stepOption)
    {
        //
    }
}
