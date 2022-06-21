<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

//http://192.168.1.2:8000/api/temperature?temperature=34.5&branch_id=1
class TemperatureController extends Controller
{
    public function store(){

        Temperature::create([
            'temperature' => request()->temperature,
            'branch_id' => request()->branch_id
        ]);
    }

    public function getTemperature(){
//        $user = Auth::user();

        $temperatures = Temperature::paginate(15);

        return response()->json(['status' => true,  'user' => $temperatures]);
    }

     public function showTemperature() {
        $temperatures = Temperature::all();

        return Inertia::render( 'Temperature', [ 'temperatures' => $temperatures ] );

    }

}
