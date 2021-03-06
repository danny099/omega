<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrativa;
use App\Cliente;
use App\Juridica;
use App\Usuario;
use App\Auditoria;
use Auth;

class DirectivaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contra = Administrativa::all();
        $clien = Cliente::all();
        $juri = Juridica::all();
        $usuar = Usuario::all();
        $audti = Auditoria::all();


        $contratos = count($contra);
        $clientes = count($clien) + count($juri);
        $usuarios = count($usuar);
        $auditorias = count($audti);
        $var = Auth::user()->id;
        $perfil = Usuario::findOrFail($var);
        return view('inicio',compact('contratos','clientes','usuarios','auditorias','perfil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
