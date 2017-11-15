<?php

namespace App\Http\Controllers;
use App\Juridica;
use App\Cliente;
use App\Departamento;
use App\Municipio;
use App\Cotizacion;
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
    // funcion que permite mostrar los clientes juridicos que hay en la base de datos
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
     // funcion que permite mostrar una vista con un formulario para crear los clientes juridicos
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
     // funcion que permite guardar en la base de datos los clientes juridicos
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

        if (empty($cliente['email']) ) {
          Juridica::create($cliente);
          Session::flash('message', 'Cliente creado correctamente!');
          Session::flash('class', 'success');
          return redirect()->route('clientes.index');
        }

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
     // funcion que me permite ver un formulario con los datos consultados de un registro y poderlos editar
    public function edit($id)
    {
      $juridica = Juridica::findOrFail($id);
      $departamentos = Departamento::all();

      if (is_null($juridica->municipio)) {
        $municipio ='';
      }else {
        $municipio = Municipio::findOrFail($juridica->municipio);
      }


      return view('juridica.edit',compact('juridica','roles','departamentos','municipio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // funcion que me permite acutalizar los datos de un cliente juridico
    public function update(Request $request, $id)
    {
      $juridica = Juridica::findOrFail($id);
      $input = $request->all();

      $datos['razon_social'] =$request->razon_social;
      $datos['nit'] =$request->nit;
      $datos['nombre_representante'] = ucfirst(mb_strtolower($request->nombre_representante));
      $datos['cedula'] =$request->cedula;
      $datos['direccion'] = $request->direccion;
      $datos['telefono'] =$request->telefono;
      $datos['email'] = $request->email;
      $datos['departamento_id'] = $request->departamento_id;
      $datos['municipio'] = $request->municipio;

      $juridica->update($datos);

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
     // funcion que me permite eliminar un cliente juridico
    public function destroy($id)
    {

      $cot2 = Cotizacion::where('cotizacion.juridica_id', '=', $id)->get();
      $var = count($cot2);

      if ($var == 0) {
        $juridica = Juridica::findOrFail($id);
        Session::flash('message', 'Persona juridica eliminada');
        Session::flash('class', 'danger');
        $juridica->delete();
        return redirect('clientes');

      }else {
        Session::flash('message', 'No se puede eliminar el cliente si tiene creadas cotizaciones');
        Session::flash('class', 'danger');
        return redirect('clientes');
      }
    }
}
