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

	// Route::get('home', array('before' => 'auth', function(){
	// 	return view('home');
	// }));


	Route::group(['middleware' => 'gerente'],function(){
		Route::resource('cotizaciones','CotizacionController');
		Route::resource('clientes','ClienteController');
		Route::get('deleteclientes/{id}','ClienteController@destroy');
		Route::get('documentoscon', 'DocumentoController@indexContrato');
		Route::post('documentoscon', 'DocumentoController@store');
		Route::get('documentoscon/{id}/edit', 'DocumentoController@editar');
		Route::get('documentoscon/create', 'DocumentoController@crearcontrato');

	});

	Route::group(['middleware' => 'administrativa'],function(){
		Route::resource('otrosi','OtrosiController');
		// Route::get('view/{id}','OtrosiController@view');
		Route::get('deleteotrosi/{id}','OtrosiController@destroy');
		Route::resource('administrativas','AdministrativaController');
		Route::get('pdf','AdministrativaController@viewpdf');
		Route::get('deleteadminstrativa/{id}','AdministrativaController@destroy');
		Route::get('created','AdministrativaController@create');
		Route::resource('consignaciones','ConsignacionController');
		Route::post('editarconsignacion','ConsignacionController@editar');
		Route::get('deleteconsignacion/{id}','ConsignacionController@destroy');
		Route::resource('cuenta_cobros','Cuenta_cobroController');
		Route::post('editarcobros','Cuenta_cobroController@editar');
		Route::get('deletecuenta/{id}','Cuenta_cobroController@destroy');
		Route::resource('facturas','FacturaController');
		Route::post('edita/{id}','FacturaController@edita');
		Route::get('deletefactura/{id}','FacturaController@destroy');
		Route::resource('adicionales','ValorAdicionalController');
		Route::post('editaradicionales','ValorAdicionalController@editar');
		Route::get('deleteadicional/{id}','ValorAdicionalController@destroy');
		Route::resource('transformaciones','TransformacionController');
		// Route::get('transformaciones/{id}/crear','TransformacionController@create');
		Route::post('editart','TransformacionController@editar');
		Route::get('deletetransfor/{id}','TransformacionController@destroy');
		Route::resource('distribuciones','DistribucionController');
		Route::post('editard','DistribucionController@editar');
		Route::get('deletedistri/{id}','DistribucionController@destroy');
		Route::resource('pu_final','Pu_finalController');
		Route::post('editarpu','Pu_finalController@editar');
		Route::get('deletepu/{id}','Pu_finalController@destroy');
		Route::resource('cotizaciones','CotizacionController');
		

	});

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
  // Route::get('doc/{id}','AdministrativaController@doc');


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
	/**************************************************************/
	/**************************************************************/
	Route::get('documentoscon', 'DocumentoController@indexContrato');
	Route::post('documentoscon', 'DocumentoController@store');
	Route::get('documentoscon/{id}/edit', 'DocumentoController@editar');
	Route::get('documentoscon/create', 'DocumentoController@crearcontrato');
	/**************************************************************/
	/**************************************************************/
	Route::get('cotizacion/{id}','PdfController@cotizacionPdf');
	// Route::get('doc/{id}','DocumentoController@doc');
	// Route::get('doc/{id}','DocumentoController@doc');
	/**************************************************************/
	/**************************************************************/
	Route::get('perfil','UsuarioController@verPerfil');
	Route::get('editarPerfil','UsuarioController@editarPerfil');

	Route::post( 'importExcel' , 'ExcelController@importExcel');


	/**************************************************************/
	/**************************************************************/

	Route::get('criterio/{tipo}','CriterioController@index');
	Route::post('criterio/create/{tipo}','CriterioController@create');
	Route::post('criterio','CriterioController@store');
	Route::get('criterio/edit/{id}/{tipo}','CriterioController@edit');
	Route::post('criterio/update','CriterioController@update');
	Route::get('criterio/delete/{id}/{tipo}','CriterioController@destroy');
	Route::get('pdfCriterio/{id}/{tipo}','PdfController@pdfTecnica');

	});

	/**************************************************************/
	/**************************************************************/



Auth::routes();

Route::get('/home', 'HomeController@index');
