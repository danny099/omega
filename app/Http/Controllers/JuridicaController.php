<?php

namespace App\Http\Controllers;
use App\Juridica;
use App\Cliente;
use Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Session;

class JuridicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $juridicas=Juridica::all();
      $clientes=Cliente::all();

      return view('clientes.index',compact('juridicas','clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $juridicas=Juridica::all();

      return view('juridica.create',compact('juridicas'));
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
        $input['razon_social'] =Request::input('razon_social');
        $input['nit'] =Request::input('nit');
        $input['nombre_representante'] =Request::input('nombre_representante');
        $input['cedula'] =Request::input('cedula');
        $input['direccion'] = Request::input('direccion');
        $input['telefono'] =Request::input('telefono');
        $input['email'] = Request::input('email');


        $cedularepe = Juridica::where('cedula',Request::input('cedula'))->get();
        $nitrepe = Juridica::where('nit',Request::input('nit'))->get();
        $emailrepe = Juridica::where('email',Request::input('email'))->get();
    		if ($cedularepe->count() == 1) {
    			Session::flash('message', 'la cedula ya esta registrada!');
          Session::flash('class', 'danger');
          return redirect()->route('juridica.create');
    		}
        else if ($nitrepe->count() == 1) {
    			Session::flash('message', 'el nit ya esta registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('juridica.create');
    		}
        else if ($emailrepe->count() == 1) {
          Session::flash('message', 'el email ya esta registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('juridica.create');
        }
        else {
          Juridica::create($input);
          Session::flash('message', 'Persona juridica creada correctamente!');
          Session::flash('class', 'success');
          return redirect()->route('juridica.index');
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
      $juridica = Juridica::findOrFail($id);

      return view('juridica.edit',compact('juridica','roles'));
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
      $juridica = Juridica::findOrFail($id);
      $input = Request::all();


        $juridica->update($input);
        Session::flash('message', 'Persona juridica  editada!');
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
      $juridica = Juridica::findOrFail($id);
      Session::flash('message', 'Persona juridica eliminada');
      Session::flash('class', 'danger');
      $juridica->delete();
      return redirect('clientes');

    }
}
