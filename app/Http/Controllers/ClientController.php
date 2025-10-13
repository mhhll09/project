<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;
use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.dashboard.homepage');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreclientRequest $request)
    {
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $client = client::all()->where('email', $request->email)->where('password', $request->password)->first();

        if ($client == true) {
            return view('home.dashboard.homepage', compact('client'));
        }else{
            dd($request);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateclientRequest $request, client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(client $client)
    {
        //
    }
}
