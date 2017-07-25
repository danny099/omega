<?php

namespace App\Http\Controllers;


use App\Usuario;
use App\Rol;
use Hash;
use Auth;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class UsuarioController extends Controller
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

        $usuarios = $request->all();
        $file = Input::file('foto');

        $usuarios['cedula'] = $request->cedula;
        $usuarios['nombres'] = ucwords(mb_strtolower($request->nombres));
        $usuarios['foto'] = Input::file("foto")->getClientOriginalName();
        $usuarios['apellidos'] = ucwords(mb_strtolower($request->apellidos));
        $usuarios['email'] = $request->email;
        $usuarios['password'] = Hash::make($request->password);


        $cedularepe = Usuario::where('cedula',$request->cedula);
        $emailrepe = Usuario::where('email',$request->email);
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
          Usuario::create($usuarios);

          $file->move('photos',$file->getClientOriginalName());
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
        $perfil = Usuario::findOrFail($id);
        return view('usuarios.show', compact('perfil'));
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
      $input = $request->all();

      $file1 = Input::file('foto');
      $file = $request->foto;
      $usuario = Usuario::findOrFail($id);
      $usuarios['cedula'] = $request->cedula;
      $usuarios['nombres'] = ucwords(mb_strtolower($request->nombres));

      if (isset($file)) {
        $usuarios['foto'] = Input::file("foto")->getClientOriginalName();
      }else {
        $usuarios['foto'] = 'default-user.png';
      }

      $usuarios['apellidos'] = ucwords(mb_strtolower($request->apellidos));
      $usuarios['email'] = $request->email;
      $usuarios['password'] = Hash::make($request->password);
      $usuarios['rol_id'] = $request->rol_id;
      $file1->move('photos',$file1->getClientOriginalName());

      $usuario->update($usuarios);
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
      Session::flash('class', 'danger');
      $usuario->delete();
      return redirect('usuarios');
    }
}
