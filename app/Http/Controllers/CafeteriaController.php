<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CafeteriaController extends Controller
{   
    public function getCafeteria()
    {
        $data = Cafeteria::find(1);

        return response()->json($data);
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'first' => 'required',
            'second' => 'required',
            'third' => 'required',
            'first_sub' => 'integer|max:200000',
            'second_sub' => 'integer|max:200000',
            'third_sub' => 'integer|max:200000',
            'total' => 'required|integer|max:400000',
        ], [
            'first_sub.max' => 'Szálláshely nem lehet nagyobb mint 200.000 Ft!',
            'second_sub.max' => 'Vendéglátás nem lehet nagyobb mint 200.000 Ft!',
            'third_sub.max' => 'Szabadidő nem lehet nagyobb mint 200.000 Ft!',
            'total.max' => 'A 3 zseb összege nem lehet több mint 400.000 Ft!',
        ]);
        
        if ($validator->fails()) {
            return to_route('home')->with('error', $validator->messages());
        } else {
            $validatedData = $request->validate([
                'first' => 'required',
                'second' => 'required',
                'third' => 'required',
                'first_sub' => 'required',
                'second_sub' => 'required',
                'third_sub' => 'required',
                'total' => 'required',
            ]);
            
            $validatedData['first'] = json_encode($validatedData['first']);
            $validatedData['second'] = json_encode($validatedData['second']);
            $validatedData['third'] = json_encode($validatedData['third']);
            
            Cafeteria::updateOrCreate(['id' => 1], $validatedData);

            return to_route('home')->with('message', 'Sikeres beküldés!');
        }
    }
}