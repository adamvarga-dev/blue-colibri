<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\CheckAmount;

class CafeteriaController extends Controller
{   
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'first' => new CheckAmount(),
            'second' => new CheckAmount(),
            'third' => new CheckAmount(),
            'total' => 'required|integer|max:400000',
        ], [
            'total.max' => 'A 3 zseb összege nem lehet több mint 400.000 Ft!',
        ]);
        
        if ($validator->fails()) {
            return to_route('home')->with('error', $validator->messages());
        } else {
            $validatedData = $request->validate([
                'first' => 'required',
                'second' => 'required',
                'third' => 'required',
                'total' => 'required',
            ]);
            
            $validatedData['first'] = json_encode($validatedData['first']);
            $validatedData['second'] = json_encode($validatedData['second']);
            $validatedData['third'] = json_encode($validatedData['third']);
            $validatedData['total'] = $validatedData['total'];
        
            Cafeteria::updateOrCreate(['id' => 1], $validatedData);

            return to_route('home')->with('message', 'Sikeres beküldés!');
        }
    }
}