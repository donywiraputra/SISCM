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
Route::get('register', 'RegisterController@getRegister')->middleware('role:admin');
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
Route::get('datatransaksi/id{id}/edit', 'DataTransController@editTrans')->middleware('role:admin');
Route::put('/datatransaksi/id{id}', 'DataTransController@updateTrans');
Route::get('/datatransaksi/id{id}/delete', 'DataTransController@deleteTrans')->middleware('role:admin');
Route::get('datamember', 'DataMemberController@getdatamember');
Route::get('datamember/page', 'DataMemberController@tabelmember');
Route::get('/datamember/{id}/detail', 'DataMemberController@detailmember');
Route::put('/datamember/{id}', 'DataMemberController@updatemember');
Route::get('/datamember/{id}/delete', 'DataMemberController@deletemember')->middleware('role:admin');
Route::get('databarang', 'DatabarangController@getDataBarang');
Route::get('/databarang/tambahdatabarang', 'TambahdatabarangController@getTambahDataBarang')->middleware('role:admin');
Route::post('/databarang/tambahdatabarang/postdata', 'TambahdatabarangController@insertDataBarang');
Route::get('/databarang/page', 'DatabarangController@tabelBarang');
Route::get('/databarang/id{id}/edit', 'DatabarangController@editDataBarang')->middleware('role:admin');
Route::put('/databarang/id{id}', 'DatabarangController@updateDataBarang');
Route::get('/databarang/id{id}/delete', 'DatabarangController@deleteDataBarang')->middleware('role:admin');
Route::get('transaksidagang', 'TransaksidagangController@getTransaksiDagang');
Route::get('caribarang', 'TransaksidagangController@dataBarang');
Route::get('validasibarang', 'TransaksidagangController@validasiBarang');
Route::get('getsubtotal', 'TransaksidagangController@subTotalDagang');
Route::get('deletelist', 'TransaksidagangController@deleteList');
Route::post('/transaksidagang/posttransaksi', 'TransaksidagangController@insertTransaksiDagang');
Route::get('datatransdagang', 'DatatransdagangController@getDataTransDagang');
Route::get('/datatransdagang/page', 'DatatransdagangController@tabelTransDagang');
Route::get('/datatransdagang/{id}/delete', 'DatatransdagangController@deleteDataTransDagang')->middleware('role:admin');
Route::get('/datatransdagang/multidelete', 'DatatransdagangController@multiDeleteDataDagang')->middleware('role:admin');
Route::get('pengeluaran', 'PengeluaranController@getPengeluaran');
Route::get('pengeluaran/page', 'PengeluaranController@tabelPengeluaran');
Route::get('catatpengeluaran', 'CatatPengeluaranController@getCatatPengeluaran');
Route::post('simpanpengeluaran', 'CatatPengeluaranController@catatPengeluaran');
Route::get('/pengeluaran/{id}/edit', 'PengeluaranController@editPengeluaran')->middleware('role:admin');
Route::put('/pengeluaran/{id}', 'PengeluaranController@updatePengeluaran');
Route::get('/pengeluaran/{id}/delete', 'PengeluaranController@deletePengeluaran')->middleware('role:admin');
Route::get('/laporan', 'LaporanController@getLaporan');
Route::get('/laporan/data', 'LaporanController@getDataLaporan');
Route::get('bulanselect', 'LaporanController@selectBulan');
Route::get('/laporan/pdf', 'LaporanController@convert_pdf');
Route::get('datajenistransaksi', 'DataJenisTransaksiController@getDataJenisTransaksi');
Route::get('/datajenistransaksi/{id}/editbiaya', 'DataJenisTransaksiController@editJenisTransaksi')->middleware('role:admin');
Route::put('/datajenistransaksi/{id}', 'DataJenisTransaksiController@updateJenisTransaksi');
Route::get('datauser', 'DataUserController@getDataUser')->middleware('role:admin');
Route::get('datauser/{id}/edit', 'DataUserController@getEditUser')->middleware('role:admin');
Route::put('/datauser/{id}', 'DataUserController@updateUser');
Route::get('/datauser/{id}/editpassword', 'DataUserController@getGantiPass');
Route::put('/datauser/updatepass/{id}', 'DataUserController@updateUserPass');
Route::get('/datauser/{id}/delete', 'DataUserController@deleteUser')->middleware('role:admin');
Route::get('accesserror', function()
  {
    return view('web.accessError');
  }
);
Route::get('logout', function()
  {
    Auth::logout();
    return redirect('/');
  }
);
