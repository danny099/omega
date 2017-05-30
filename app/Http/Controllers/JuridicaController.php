<?php

namespace App\Http\Controllers;
use App\Juridica;
use App\Cliente;
use App\Departamento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
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
      $departamentos = Departamento::all();
      return view('juridica.create',compact('juridicas','departamentos'));
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
        $cliente['razon_social'] =$request->razon;
        $cliente['nit'] =$request->nit;
        $cliente['nombre_representante'] = ucfirst(mb_strtolower($request->nombre));
        $cliente['cedula'] =$request->cedula;
        $cliente['direccion'] = $request->direccion;
        $cliente['telefono'] =$request->telefono;
        $cliente['email'] = $request->email;
        $cliente['departamento_id'] = $request->departamento;
        $cliente['municipio'] = $request->municipio;

        $cedularepe = Juridica::where('cedula',$request->cedula)->get();
        $nitrepe = Juridica::where('nit',$request->nit)->get();
        $emailrepe = Juridica::where('email',$request->email)->get();
    		if ($cedularepe->count() == 1) {
    			Session::flash('message', 'La cédula ya está registrada!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.index');
    		}
        else if ($nitrepe->count() == 1) {
    			Session::flash('message', 'El nit ya está registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.index');
    		}
        else if ($emailrepe->count() == 1) {
          Session::flash('message', 'El email ya está registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('clientes.index');
        }
        else {
          Juridica::create($cliente);
          Session::flash('message', 'Persona juridica creada correctamente!');
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
      $input = $request->all();


        $juridica->update($input);
        Session::flash('message', 'Persona juridica editada!');
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
