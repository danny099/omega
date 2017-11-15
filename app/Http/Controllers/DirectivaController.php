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

    // directivas tiene una funcion que nos permite saber la estadistica de cuantos contratos, clientes, usarios, y cambios de registros hay en el sistema
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


}
