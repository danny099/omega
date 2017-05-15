<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Juridica;
use App\Departamento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Session;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $clientes=Cliente::all();
      $juridicas=Juridica::all();
      $departamentos = Departamento::all();
      return view('clientes.index',compact('clientes','juridicas','departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clientes=Cliente::all();
      $departamentos = Departamento::all();
      return view('clientes.create',compact('clientes','departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cliente = $request->all();
        $cliente['nit'] =$request->nit;
        $cliente['cedula'] =$request->cedula;
        $cliente['nombre'] =$request->nombre;
        $cliente['telefono'] =$request->telefono;
        $cliente['direccion'] = $request->direccion;
        $cliente['email'] = $request->email;
        $cliente['departamento_id'] = $request->departamento;
        $cliente['municipio'] = $request->municipio;


        $cedularepe = Cliente::where('cedula',$request->cedula)->get();
        $nitrepe = Cliente::where('nit',$request->nit)->get();
        $emailrepe = Cliente::where('email',$request->email)->get();
    		if ($cedularepe->count() == 1) {
    			Session::flash('message', 'la cedula ya esta registrada!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.index');
    		}
        else if ($nitrepe->count() == 1) {
    			Session::flash('message', 'el nit ya esta registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.index');
    		}
        else if ($emailrepe->count() == 1) {
          Session::flash('message', 'el email ya esta registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.index');
        }
        else {
          Cliente::create($cliente);
          Session::flash('message', 'Cliente creado correctamente!');
          Session::flash('class', 'success');
          return redirect()->route('clientes.index');
        }


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
      $clientes = Cliente::findOrFail($id);

      return view('clientes.edit',compact('clientes','roles'));
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
      $cliente = Cliente::findOrFail($id);
      $input = $request->all();


        $cliente->update($input);
        Session::flash('message', 'Cliente  editado!');
        Session::flash('class', 'success');
        return redirect()->route('clientes.index');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cliente = Cliente::findOrFail($id);
      Session::flash('message', 'Cliente eliminado');
      Session::flash('class', 'danger');
      $cliente->delete();
      return redirect('clientes');

    }
}
