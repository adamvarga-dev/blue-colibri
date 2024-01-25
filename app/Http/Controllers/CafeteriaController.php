<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use Illuminate\Http\Request;
use Validator;

class CafeteriaController extends Controller
{   
    public function store(Request $request)
    {   
        dd($request->input());
        $validatedData = $request->validate([
            'first.*' => 'required|integer|max:200000',
            'second.*' => 'required|integer|max:200000',
            'third.*' => 'required|integer|max:200000',
        ]);
    
        // Serialize the data before saving
        $validatedData['first'] = json_encode($validatedData['first']);
        $validatedData['second'] = json_encode($validatedData['second']);
        $validatedData['third'] = json_encode($validatedData['third']);
    
        // Save to the database
        Cafeteria::create($validatedData);
    
        return to_route('home')->with('message', 'Sikeres beküldés!');
    }
}