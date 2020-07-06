<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'EmpresasCController@index')->name('home');

//regemp
Route::POST('/regemp', 'RegempController@store')->name('regemp.store');
Route::delete('/regemp', 'RegempController@destroy')->name('regemp.destroy');
Route::get('/regemp', 'RegempController@index')->name('regemp.index');
Route::patch('/regemp', 'RegempController@update')->name('regemp.update');

//usuarios
Route::POST('/User', 'UserController@store')->name('User.store');
Route::delete('/User', 'UserController@destroy')->name('User.destroy');
Route::get('/User', 'UserController@index')->name('User.index');
Route::patch('/User', 'UserController@update')->name('User.update');

//usuarios_empresas
Route::GET('/UserEmp', 'UserEmpCController@index')->name('UserEmpC.index');
Route::POST('/UserEmp', 'UserEmpCController@store')->name('UserEmpC.store');
Route::DELETE('/UserEmp', 'UserEmpCController@destroy')->name('UserEmpC.destroy');

//Empresas
Route::GET('/empresas', 'EmpresasCController@index')->name('Empresas.index');

//Reglas de seguridad
Route::GET('/Reglas', 'ReglasCController@index')->name('ReglasC.index');
/*Route::POST('/User', 'UserController@store')->name('User.store');
Route::delete('/User', 'UserController@destroy')->name('User.destroy');
Route::patch('/User', 'UserController@update')->name('User.update');*/

//DetalleEmpresa
Route::GET('/DetEmpC', 'DetEmpCController@index')->name('DetEmpC.index');
Route::delete('/UserDel', 'DetEmpCController@destroy')->name('DetEmpCController.destroy');
/*Route::patch('/User', 'UserController@update')->name('User.update');*/


//Seguridad y Usuarios
Route::GET('/ReglasUsuario', 'ReglasUsuarioCController@index')->name('ReglasUsuarioC.index');
Route::POST('/ReglasUsuario', 'ReglasUsuarioCController@store')->name('ReglasUsuarioC.store');
Route::POST('/UsuarioEmp', 'ReglasUsuarioCController@edit')->name('ReglasUsuarioC.edit');
Route::GET('/UsuarioEmp2', 'ReglasUsuarioCController@update')->name('ReglasUsuarioC.update');



//documentos
Route::POST('/docs', 'DocumentosCController@index')->name('DocumentosC.index');
Route::POST('/docsCrearCarpeta', 'DocumentosCController@CrearCarpeta')->name('DocumentosC.CrearCarpeta');
Route::POST('/docsCrearArchivo', 'DocumentosCController@CrearArchivo')->name('DocumentosCController.CrearArchivo');
Route::POST('/docsBorrar', 'DocumentosCController@Borrar')->name('DocumentosCController.Borrar');
Route::POST('/docsBorrarArchivo', 'DocumentosCController@BorrarArchivo')->name('DocumentosCController.BorrarArchivo');
Route::GET('/docsDescArchivo', 'DocumentosCController@DescArchivo')->name('DocumentosCController.DescArchivo');
Route::POST('/docsVolver', 'DocumentosCController@Volver')->name('DocumentosC.Volver');




//meses
Route::GET('/meses', 'MesesCController@index')->name('MesesC.index');
Route::POST('/meses', 'MesesCController@store')->name('MesesC.store');
Route::POST('/mesesElim', 'MesesCController@destroy')->name('MesesCController.destroy');

//Cc
Route::POST('/cc', 'CcController@index')->name('CcC.index');
Route::POST('/ccAgregar', 'CcController@Agregar')->name('CcC.Agregar');
Route::POST('/ccEditar', 'CcController@Editar')->name('CcC.Editar');
Route::POST('/ccEliminar', 'CcController@Eliminar')->name('CcC.Eliminar');

//Facturas
Route::POST('/fc', 'FacturaController@index')->name('FacturaC.index');
Route::POST('/fcAgregar', 'FacturaController@Agregar')->name('FacturaC.Agregar');
Route::POST('/fcEditar', 'FacturaController@Editar')->name('FacturaC.Editar');
Route::POST('/fcEliminar', 'FacturaController@Eliminar')->name('FacturaC.Eliminar');
Route::POST('/fcMasiva', 'FacturaController@Masiva')->name('FacturaC.Masiva');

//Transacciones
Route::POST('/Tr', 'TranCController@index')->name('TranC.index');
Route::POST('/TrAgregar', 'TranCController@Agregar')->name('TranC.Agregar');
Route::POST('/TrEditar', 'TranCController@Editar')->name('TranC.Editar');
Route::POST('/TrEliminar', 'TranCController@Eliminar')->name('TranC.Eliminar');
Route::POST('/TrBuscar', 'TranCController@Buscar')->name('TranC.Buscar');
Route::POST('/TrConta', 'TranCController@Contabilizacion')->name('TranC.Contabilizacion');
Route::GET('/TrVeri', 'TranCController@VerificarArchivo')->name('TranCController.VerificarArchivo');
Route::POST('/TrAgregarArc', 'TranCController@AgregarArchivo')->name('TranCController.AgregarArchivo');


//Proveedores
Route::POST('/PrTr', 'ProvCController@index')->name('ProvC.index');
Route::POST('/PrTrAgregar', 'ProvCController@Agregar')->name('ProvC.Agregar');
Route::POST('/PrTrEditar', 'ProvCController@Editar')->name('ProvC.Editar');
Route::POST('/PrTrEliminar', 'ProvCController@Eliminar')->name('ProvC.Eliminar');

//Pruebas
Route::POST('/Prueba', 'PruebaCController@index')->name('PruebaC.index');

//contabilizacion
Route::POST('/Conta', 'ContaCController@index')->name('ContaC.index');
Route::POST('/ContaAgregarTranDoc', 'ContaCController@AgregarTranDoc')->name('ContaC.AgregarTranDoc');
Route::POST('/ContaAgregarTransiigo', 'ContaCController@AgregarTranSiigo')->name('ContaC.AgregarTranSiigo');


//Comprobantes
Route::GET('/Comprobantes', 'ComproCController@guardar')->name('ComproC.guardar');









