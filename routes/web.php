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








Route::group(['middleware' => 'auth'],function(){

  // Route::get('/home', 'HomeController@index');

	Route::get('home', array('before' => 'auth', function(){
		return view('home');
	}));

  Route::get('/index', function () {
      return view('index');
  });

  /**************************************************************/
  /**************************************************************/
	Route::resource('inicio','DirectivaController');
  Route::resource('roles','RolController');

  /**************************************************************/
  /**************************************************************/
	Route::resource('observaciones','ObservacionController');


	/**************************************************************/
	/**************************************************************/
  Route::resource('otrosi','OtrosiController');
	// Route::get('view/{id}','OtrosiController@view');
	Route::get('deleteotrosi/{id}','OtrosiController@destroy');
  /**************************************************************/
  /**************************************************************/
  Route::resource('transformaciones','TransformacionController');
	// Route::get('transformaciones/{id}/crear','TransformacionController@create');
	Route::post('editart','TransformacionController@editar');
	Route::get('deletetransfor/{id}','TransformacionController@destroy');
  /**************************************************************/
  /**************************************************************/
  Route::resource('distribuciones','DistribucionController');
	Route::post('editard','DistribucionController@editar');
	Route::get('deletedistri/{id}','DistribucionController@destroy');

  /**************************************************************/
  /**************************************************************/
  Route::resource('pu_final','Pu_finalController');
	Route::post('editarpu','Pu_finalController@editar');
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
	Route::get('pdf','AdministrativaController@viewpdf');
	Route::get('deleteadminstrativa/{id}','AdministrativaController@destroy');
  Route::get('created','AdministrativaController@create');


	Route::get('selectmuni','AdministrativaController@getMuni');
  /**************************************************************/
  /**************************************************************/
  Route::resource('usuarios','UsuarioController');
  Route::get('deleteusuarios/{id}','UsuarioController@destroy');
  /**************************************************************/
  /**************************************************************/
	Route::resource('consignaciones','ConsignacionController');
	Route::post('editarconsignacion','ConsignacionController@editar');
	Route::get('deleteconsignacion/{id}','ConsignacionController@destroy');
	/**************************************************************/
	/**************************************************************/
	Route::resource('cuenta_cobros','Cuenta_cobroController');
	Route::post('editarcobros','Cuenta_cobroController@editar');
	Route::get('deletecuenta/{id}','Cuenta_cobroController@destroy');
	/**************************************************************/
	/**************************************************************/
	Route::resource('facturas','FacturaController');
	Route::post('edita/{id}','FacturaController@edita');
	Route::get('deletefactura/{id}','FacturaController@destroy');
	/**************************************************************/
	/**************************************************************/
	Route::resource('adicionales','ValorAdicionalController');
	Route::post('editaradicionales','ValorAdicionalController@editar');
	Route::get('deleteadicional/{id}','ValorAdicionalController@destroy');

	/**************************************************************/
	/**************************************************************/
	Route::get('pdf/{id}','PdfController@viewPdf');
	Route::get('pdf-cotizacion/{id}','PdfController@cotizacionPdf');

	/**************************************************************/
	// /**

	Route::get('admin','adminController@index');
	});

	/**************************************************************/
	/**************************************************************/
	Route::resource('auditorias','AuditoriaController');
	/**************************************************************/
	/**************************************************************/
	Route::resource('cotizaciones','CotizacionController');
	Route::get('deletecot/{id}','CotizacionController@destroy');

	/**************************************************************/
	/**************************************************************/

	Route::resource('documentos','DocumentoController');
	Route::get('deletedocumentos/{id}','DocumentoController@destroy');
