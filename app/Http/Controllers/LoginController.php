<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Redirect;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  // funcion que me permite comprobar las credenciales para dar permiso de acceso al sistema, iniciar sesion
  public function check(Request $request){

    $name = $request->input('cedula');
    $pass = $request->input('password');

        if(Auth::attempt(['cedula'=>$name,'password'=>$pass]))
        {
            return Redirect::intended('inicio');

        }else

          Session::flash('message', 'El usuario o la contraseña son incorrectos!!');
          Session::flash('class', 'danger');
          return Redirect::to('/');
    }

    // funcion que me permite desloguearme
    public function logout(){
            Auth::logout();
        return Redirect::to('/');
    }
}
