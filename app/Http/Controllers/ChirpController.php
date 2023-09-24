<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'color' => ['required', 'min:3'],
            'animal' => ['required', 'min:3'],
        ]);

        Chirp::create([
            'color' => $request->get('color'),
            'animal' => $request->get('animal'),
            'userIdC' => auth()->id()
        ]); 
        return to_route('chirps.index')->with('success', 'El registro se ha insertado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        $chirps = Chirp::all();
        return response()->json($chirps);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
