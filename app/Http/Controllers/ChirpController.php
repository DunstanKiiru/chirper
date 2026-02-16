<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $chirps = Chirp::with('user')
              ->latest()
              ->take(50) //limit to 50 recent chirps
              ->get();

        return view('home',['chirps' => $chirps]);
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
        // validate request
        $validated = $request->validate([
            'message' =>'required|string|max:255',
        ],[
            'message.required'=>'please write shomething to chirp!',
            'message.max' =>'chirps must be 255 characters or less',
        ]
        );

        //create chirp

        Chirp::create([
            'message'=> $validated['message'],
            'user_id'=>null,
        ]);

        return redirect('/')->with('success','Your chirp has been created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //edit chirp

        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
