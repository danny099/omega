<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inspector;
use Session;
class InspectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspectores = Inspector::all();
        return view('inspectores.index',compact('inspectores'));
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
        $input = $request->all();

        $inspector['nombres'] = $request->nombres;
        $inspector['apellidos'] = $request->apellidos;
        $inspector['matricula'] = $request->matricula;
        $inspector['rol_inspector'] = $request->rol_inspector;

        Inspector::create($inspector);

        Session::flash('message', 'Inspector creado');
        Session::flash('class', 'success');
        return redirect('inspectores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inspector = Inspector::findOrFail($id);

        return view('inspectores.edit',compact('inspector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    
    {
        $inspector = Inspector::findOrFail($id);

        $datos['nombres'] = $request->nombres;
        $datos['apellidos'] = $request->apellidos;
        $datos['matricula'] = $request->matricula;
        $datos['rol_inspector'] = $request->rol_inspector;

        $inspector->update($datos);

        Session::flash('message', 'Inspector editado');
        Session::flash('class', 'success');
        return redirect('inspectores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inspector = Inspector::findOrFail($id);

        $inspector->delete();
        Session::flash('message', 'Inspector eliminado');
        Session::flash('class', 'danger');
        return redirect('inspectores');
    }
}
