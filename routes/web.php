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

/*Route::get('/', function () {
    return view('welcome');
});
*/
/*
Route::get('/', function () {
    return view('web/home');
});
*/

Route::get('/', 'WebController@index');
Route::get('register', 'RegisterController@getRegister');
Route::post('postRegister', 'RegisterController@postRegister');
Route::get('login', [ 'as' => 'login', 'uses' => 'LoginController@getLogin']);
Route::post('postLogin', 'LoginController@postLogin');
Route::get('regmember', 'MemberController@getMember');
Route::post('createMember', 'MemberController@createMember');
Route::post('validasinamambr', 'MemberController@validasiNama');
Route::get('carimember', 'TransaksiController@dataMember');
Route::get('showmember', 'TransaksiController@showDataMember');
Route::get('transmember', 'TransaksiController@getTransaksi');
Route::get('biayatransaksi', 'TransaksiController@biayaTransaksi');
Route::post('posttransaksi', 'TransaksiController@postTrans');
Route::get('datatransaksi', 'DataTransController@getDataTrans');
Route::get('datatransaksi/page', 'DataTransController@tabelTrans');
Route::get('datatransaksi/id{id}/edit', 'DataTransController@editTrans');
Route::put('/datatransaksi/id{id}', 'DataTransController@updateTrans');
Route::get('/datatransaksi/id{id}/delete', 'DataTransController@deleteTrans');
Route::get('datamember', 'DataMemberController@getdatamember');
Route::get('datamember/page', 'DataMemberController@tabelmember');
Route::get('/datamember/{id}/detail', 'DataMemberController@detailmember');
Route::put('/datamember/{id}', 'DataMemberController@updatemember');
Route::get('/datamember/{id}/delete', 'DataMemberController@deletemember');
Route::get('databarang', 'DatabarangController@getDataBarang');
Route::get('/databarang/tambahdatabarang', 'TambahdatabarangController@getTambahDataBarang');
Route::post('/databarang/tambahdatabarang/postdata', 'TambahdatabarangController@insertDataBarang');
Route::get('/databarang/page', 'DatabarangController@tabelBarang');
Route::get('/databarang/id{id}/edit', 'DatabarangController@editDataBarang');
Route::put('/databarang/id{id}', 'DatabarangController@updateDataBarang');
Route::get('/databarang/id{id}/delete', 'DatabarangController@deleteDataBarang');
Route::get('logout', function()
  {
    Auth::logout();
    return redirect('/');
  }
);
