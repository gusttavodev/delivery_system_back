<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\WppSession;
use Illuminate\Http\Request;

use App\Http\Requests\WppSession\WppSessionCreate;
use App\Http\Resources\WppSession as WppSessionResource;

class WppSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('WppSession/Index', [
            'wppSessions' => WppSession::paginate(6)->transform(function ($wppSessions) {
                    return WppSessionResource::make($wppSessions);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WppSessionCreate $request)
    {
        $wppSession = WppSession::where('name', $request->name)->first();

        if(!$wppSession) $wppSession = new WppSession();

        $wppSession->name = $request->name;
        $wppSession->phone = $request->phone;
        if($request->is_auth != null)$wppSession->is_auth = $request->is_auth;
        $wppSession->status = $request->status;
        $wppSession->state = $request->state;

        $wppSession->wa_browser_id = $request->wa_browser_id;
        $wppSession->wa_secret_bundle = $request->wa_secret_bundle;
        $wppSession->wa_token_1 = $request->wa_token_1;
        $wppSession->wa_token_2 = $request->wa_token_2;

        $wppSession->encKey = $request->encKey;
        $wppSession->macKey = $request->macKey;
        $wppSession->qr_code = $request->qr_code;

        $wppSession->user_id = $request->user_id;

        $wppSession->save();

        return redirect()->back()->with('message', 'Session Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WppSession  $wppSession
     * @return \Illuminate\Http\Response
     */
    public function show(WppSession $wppSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WppSession  $wppSession
     * @return \Illuminate\Http\Response
     */
    public function edit(WppSession $wppSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WppSession  $wppSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WppSession $wppSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WppSession  $wppSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(WppSession $wppSession)
    {
        //
    }
}
