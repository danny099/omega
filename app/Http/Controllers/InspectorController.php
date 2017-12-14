<?php

namespace App\Http\Controllers;

use App\Inspector;
use Illuminate\Http\Request;

class InspectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspectores = Inspector::all();
        return view('inspectores.indes',compact('inspectores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inspectores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inspector  $inspector
     * @return \Illuminate\Http\Response
     */
    public function show(Inspector $inspector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inspector  $inspector
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspector $inspector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inspector  $inspector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspector $inspector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inspector  $inspector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspector $inspector)
    {
        //
    }
}
