<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Http\Requests\StoreCatatanRequest;
use App\Http\Requests\UpdateCatatanRequest;
use Illuminate\Support\Facades\Auth;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.catatan.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatatanRequest $request)
    {
       // dd($request->validated());
        $data = $request->validated();
        Catatan::create([
            'judul' => $request->validated('judul'),
            'isi' => $request->validated('isi'),
            'user' => Auth::id()
        ]);
        

        return redirect()->route('google.login');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catatan $catatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catatan $catatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatatanRequest $request, Catatan $catatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catatan $catatan)
    {
        //
    }
}
