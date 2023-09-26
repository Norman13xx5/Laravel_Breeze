<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function __construct()
    {
        // Solo los usuarios con permisos de index podrá ejecutar la función index
        $this->middleware('can:users.index')->only('index');

        // Solo los usuarios con permisos de edit podrán ejecutar la funcion edit & update
        $this->middleware('can:users.edit')->only('edit', 'update');
    }
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
        session()->flash('status', 'profile-updated');
        return redirect()->route('chirps.index');
        // return to_route('chirps.index')->with('success', 'El registro se ha insertado con éxito');
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
