<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', array('before' => 'validate', function(){
	return view('login');
}));

Route::post('check', 'LoginController@check');

Route::get('logout', 'LoginController@logout');

Route::get('home', array('before' => 'auth', function(){
	return view('index');
}));






Route::group(['middleware' => 'auth'],function(){

  Route::get('/home', 'HomeController@index');
  Route::get('/index', function () {
      return view('index');
  });

  /**************************************************************/
  /**************************************************************/
  Route::resource('roles','RolController');

  /**************************************************************/
  /**************************************************************/
  Route::resource('otrosi','OtrosiController');
	Route::get('deleteotrosi','OtrosiController@destroy');
  /**************************************************************/
  /**************************************************************/
  Route::resource('transformaciones','TransformacionController');
	// Route::get('transformaciones/{id}/crear','TransformacionController@create');
	Route::get('deletetransfor/{id}','TransformacionController@destroy');
  /**************************************************************/
  /**************************************************************/
  Route::resource('distribuciones','DistribucionController');
	Route::get('deletedistri/{id}','DistribucionController@destroy');

  /**************************************************************/
  /**************************************************************/
  Route::resource('pu_final','Pu_finalController');
	Route::get('deletepu/{id}','Pu_finalController@destroy');

  /**************************************************************/
  /**************************************************************/
  Route::resource('clientes','ClienteController');
  Route::get('deleteclientes/{id}','ClienteController@destroy');

  /**************************************************************/
  /**************************************************************/
	Route::resource('juridica','JuridicaController');
	Route::get('deletejuridica/{id}','juridicaController@destroy');


	/**************************************************************/
  Route::resource('administrativas','AdministrativaController');
  Route::get('deleteadminstrativa/{id}','AdministrativaController@destroy');

	Route::get('selectmuni','AdministrativaController@getMuni');
  /**************************************************************/
  /**************************************************************/
  Route::resource('usuarios','UsuarioController');
  Route::get('deleteusuarios/{id}','UsuarioController@destroy');
  /**************************************************************/
  /**************************************************************/
	Route::resource('consignaciones','ConsignacionController');
	/**************************************************************/
	/**************************************************************/
	Route::resource('cuenta_cobros','Cuenta_cobroController');
	/**************************************************************/
	/**************************************************************/
	Route::resource('facturas','FacturaController');
	  Route::get('deletefactura/{id}','FacturaController@destroy');
	/**************************************************************/
	/**************************************************************/

});
