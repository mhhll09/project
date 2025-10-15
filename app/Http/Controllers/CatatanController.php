<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Http\Requests\StoreCatatanRequest;
use App\Http\Requests\UpdateCatatanRequest;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.catatan.index');
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
    public function store(StoreCatatanRequest $request)
    {
        //
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
