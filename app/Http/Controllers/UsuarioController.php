<?php

namespace App\Http\Controllers;

use Request;
use App\Usuario;
use App\Rol;
use Hash;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::pluck('rol','id');
        return view('usuarios.create',compact('roles'));
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
        $input['cedula'] =Request::input('cedula');
        $input['nombres'] =Request::input('nombres');
        $input['apellidos'] =Request::input('apellidos');
        $input['email'] =Request::input('email');
        $input['password'] = Hash::make($input['password']);


        $cedularepe = Usuario::where('cedula',Request::input('cedula'))->get();
        $emailrepe = Usuario::where('email',Request::input('email'))->get();
        if ($cedularepe->count() == 1) {
          Session::flash('message', 'la cedula ya esta registrada!');
          Session::flash('class', 'danger');
          return redirect()->route('usuarios.create');
        }
        else if ($emailrepe->count() == 1) {
          Session::flash('message', 'el email ya esta registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('usuarios.create');
        }
        else {
          Usuario::create($input);
          Session::flash('message', 'Usuario creado correctamente!');
          Session::flash('class', 'success');
          return redirect()->route('usuarios.index');
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
        $usuarios = Usuario::findOrFail($id);

        $roles = Rol::pluck('rol','id');

        return view('usuarios.edit',compact('usuarios','roles'));
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

        $usuario = Usuario::findOrFail($id);
        $input = Request::all();

          $usuario->update($input);
          Session::flash('message', 'Usuario editado!');
          Session::flash('class', 'success');
          return redirect()->route('usuarios.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $usuario = Usuario::findOrFail($id);
      Session::flash('message', 'Usuario eliminado');
      $usuario->delete();
      return redirect('usuarios');


    }
}
