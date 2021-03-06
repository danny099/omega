<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Juridica;
use App\Departamento;
use App\Municipio;
use App\Cotizacion;
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
     public function __construct()
     {
         $this->middleware('admin');
     }

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
        $cliente['nombre'] =ucwords(mb_strtolower($request->nombre));
        $cliente['telefono'] = $request->telefono;
        $cliente['direccion'] = ucfirst(mb_strtolower($request->direccion));
        $cliente['email'] = mb_strtolower($request->email);
        $cliente['departamento_id'] = $request->departamento;
        $cliente['municipio'] = $request->municipio;


        $cedularepe = Cliente::where('cedula',$request->cedula)->get();
        $nitrepe = Cliente::where('nit',$request->nit)->get();
        $emailrepe = Cliente::where('email',$request->email)->get();

        if (empty($cliente['nit']) or empty($cliente['cedula']) or empty($cliente['email']) ) {
          Cliente::create($cliente);
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

      $departamentos = Departamento::all();
      // $departamentos = Departamento::findOrFail($clientes->departamento_id);

      $municipios = Municipio::findOrFail($clientes->municipio);

      return view('clientes.edit',compact('clientes','roles','departamentos','municipios'));
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

      $datos['nit'] =$request->nit;
      $datos['cedula'] =$request->cedula;
      $datos['nombre'] =ucwords(mb_strtolower($request->nombre));
      $datos['telefono'] = $request->telefono;
      $datos['direccion'] = ucfirst(mb_strtolower($request->direccion));
      $datos['email'] = mb_strtolower($request->email);
      $datos['departamento_id'] = $request->departamento_id;
      $datos['municipio'] = $request->municipio;


      $cliente->update($datos);
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

      $cot1 = Cotizacion::where('cotizacion.cliente_id', '=', $id)->get();

      $var = count($cot1);

      if ($var == 0) {
        $cliente = Cliente::findOrFail($id);
        Session::flash('message', 'Cliente eliminado');
        Session::flash('class', 'danger');
        $cliente->delete();
        return redirect('clientes');
      }else {
        Session::flash('message', 'No se puede eliminar el cliente si tiene creadas cotizaciones');
        Session::flash('class', 'danger');
        return redirect('clientes');
      }



    }
}
