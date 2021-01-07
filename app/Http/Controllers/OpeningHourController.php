<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Address;
use App\Enums\DaysOfWeek;
use App\Models\OpeningHour;
use Illuminate\Http\Request;
use App\Models\Establishment;

class OpeningHourController extends Controller
{
    public function store(Request $request)
    {
        $user_id =  $request->user()->id;
        $establishment = Establishment::findByUser($request->establishment_id, $user_id);

        $daysOfWeek = $request->openingHour;

        //Regra de Negocio
        foreach ($daysOfWeek as $key => $value) {
            $openingHour = OpeningHour::where('day', $value['day'])
            ->where('establishment_id', $establishment->id)->first();

            if(!$openingHour){
                $openingHour = new OpeningHour();
                $openingHour->day = $value['day'];
                $openingHour->establishment_id = $establishment->id;
            }
            $openingHour->start_time = $value['start_time'];
            $openingHour->end_time = $value['end_time'];
            $openingHour->not_open = $value['not_open'];

            $openingHour->save();
        }

        return redirect()->back()->with('message', 'Estabelecimento atualizado com sucesso!');
    }
}
