<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Observacion;
use Session;

class ObservacionController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     // funcion que me permite capturar los datos y guardarlos en la base de datos
    public function store(Request $request)
    {
        $input = $request->all();

        Observacion::create($input);
        Session::flash('message', 'Observación creada!');
        Session::flash('class', 'success');
        return redirect()->route('administrativas.index');

    }

}
