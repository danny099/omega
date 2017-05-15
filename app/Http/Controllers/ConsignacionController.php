<?php

namespace App\Http\Controllers;
use App\Consignacion;
use App\Administrativa;
use Session;
use Illuminate\Http\Request;

class ConsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $input = $request->all(); //funcion para sacar todos los valores almacenados en los input

        Consignacion::create($input); //funcion para crear el registro

        $consignaciones = Consignacion::all();//funcion para recuperar todos los registros en la base de datos

        $lastId_consig = $consignaciones->last()->id;//funcion que consigue capturar el ultimo registro y sacar el id de este mismo

        $consignacion = Consignacion::find($lastId_consig);//funcion que permite encontrar un registro mediante un id

        $administrativa = Administrativa::find($consignacion->administrativa_id);//funcion que hace una consulta a una tabla relacionada en la base de datos y saca un registro mediante un id

        $nuevo = $administrativa->pagado + $consignacion->valor;//operacion para almacenar un valor en una varible.

        $administrativa->pagado = $nuevo;//asigancion del nuevo valor para actualizar en la base de datos relacionada.
        $administrativa->save();

        $saldo = $administrativa->saldo - $administrativa->pagado;

        $administrativa->saldo = $saldo;
        $administrativa->save();

        return redirect()->route('administrativas.index');

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
       $ide = Administrativa::find($id);
       $consignaciones = Consignacion::where('Consignacion.administrativa_id', '=', $id)->get();
       return view('consignaciones.edit',compact('consignaciones','id','ide'));
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

       $consignaciones = Consignacion::findOrFail($id);
       $administrativa = Administrativa::findOrFail($consignaciones->administrativa_id);

       if ( $administrativa->saldo > 0) {
         $resta = $administrativa->saldo - $consignaciones->valor;
         $nuevo_saldo = $resta + $request->valor;
         $administrativa->saldo = $nuevo_saldo;
         $administrativa->save();
       }

       $consignaciones->update($input);

       Session::flash('message', 'registro editado editado!');
       Session::flash('class', 'success');
       return redirect()->route('administrativas.index');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
       $consignaciones = Consignacion::findOrFail($id);
       $administrativas = Administrativa::findOrFail($consignaciones->administrativa_id);

       $nuevo_saldo = $administrativas->saldo + $consignaciones->valor;
       $administrativas->saldo = $nuevo_saldo;
       $administrativas->save();

       $pagado = $administrativas->pagado - $consignaciones->valor;
       $administrativas->pagado = $pagado;
       $administrativas->save();

       $consignaciones->delete();

       Session::flash('message', 'Consignacion  eliminada');
       Session::flash('class', 'danger');
       return redirect('administrativas');
     ;
     }
     }
