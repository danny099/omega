<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use Session;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::all();

        return view('documentos.index',compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documentos.create');
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
        $documetos['detalles'] = $request->editor1;
        $documetos['nombre'] = $request->nombre;

        Documento::create($documetos);

        Session::flash('message', 'Contrato editado!');
        Session::flash('class', 'success');
        return redirect()->route('documentos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documento = Documento::find($id);
        return view('documentos.edit',compact('documento'));
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
        $input = $request->all();
        $datos['nombre'] = $request->nombre;
        $datos['detalles'] = $request->editor1;
        
        $documento = Documento::findOrFail($id);

        $documento->update($datos);
        Session::flash('message', 'Contrato editado!');
        Session::flash('class', 'success');
        return redirect()->route('documentos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documeto = Documento::findOrFail($id);
        Session::flash('message', 'Documento eliminado');
        Session::flash('class', 'danger');
        $documeto->delete();
        return redirect('documentos');
    }
}
