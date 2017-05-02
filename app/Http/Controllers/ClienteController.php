<?php

namespace App\Http\Controllers;
use App\Cliente;
use Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
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

      return view('clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clientes=Cliente::all();

      return view('clientes.create',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = Request::all();

        $input['nit'] =Request::input('nit');
        $input['cedula'] =Request::input('cedula');
        $input['nombre'] =Request::input('nombre');
        $input['contacto'] =Request::input('contacto');
        $input['telefono'] =Request::input('telefono');
        $input['direccion'] = Request::input('direccion');
        $input['email'] = Request::input('email');


        $cedularepe = Cliente::where('cedula',Request::input('cedula'))->get();
        $nitrepe = Cliente::where('nit',Request::input('nit'))->get();
        $emailrepe = Cliente::where('email',Request::input('email'))->get();
    		if ($cedularepe->count() == 1) {
    			Session::flash('message', 'la cedula ya esta registrada!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.create');
    		}
        else if ($nitrepe->count() == 1) {
    			Session::flash('message', 'el nit ya esta registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.create');
    		}
        else if ($emailrepe->count() == 1) {
          Session::flash('message', 'el email ya esta registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.create');
        }
        else {
          Cliente::create($input);
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
      $input = Request::all();


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
