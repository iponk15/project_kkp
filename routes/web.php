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


Auth::routes();

// star routing global function select2
Route::group(['as' => 'globalfunction.', 'prefix' => 'globalfunction', 'namespace' => 'GlobalFunction'], function(){
    Route::get('getdata/{table}/{prefix}', 'Select2Controller@getdata')->name('getdata');
    Route::get('getrole', 'Select2Controller@getrole')->name('getrole');
    Route::get('getNoRekamedis', 'Select2Controller@getNoRekamedis')->name('getNoRekamedis');
    Route::get('getNoRekamedis', 'Select2Controller@getNoRekamedis')->name('getNoRekamedis');
    Route::get('getDokter', 'Select2Controller@getDokter')->name('getDokter');
    Route::get('getDokterSps', 'Select2Controller@getDokterSps')->name('getDokterSps');
});
// end routing global function select2

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'HomeController@index')->name('home');

    // start routing menu users
    Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'MasterData'], function(){
        Route::get('index', 'UserController@index')->name('index');
        Route::post('ktable', 'UserController@ktable')->name('ktable');
        Route::get('show', 'UserController@show')->name('show');
        Route::post('store', 'UserController@store')->name('store');
        Route::get('edit/{id}', 'UserController@edit')->name('edit');
        Route::post('update/{id}', 'UserController@update')->name('update');
        route::post('changeStatus/{id?}/{status}', 'UserController@changeStatus')->name('changeStatus');
        route::post('delete/{id}', 'UserController@delete')->name('delete');
    });
    // end routing menu users

    // start routing menu unit kerja
    Route::group(['as' => 'uker.', 'prefix' => 'uker', 'namespace' => 'MasterData'], function(){
        Route::get('index', 'UkerController@index')->name('index');
        Route::post('ktable', 'UkerController@ktable')->name('ktable');
        Route::get('show', 'UkerController@show')->name('show');
        Route::post('store', 'UkerController@store')->name('store');
        Route::get('edit/{id}', 'UkerController@edit')->name('edit');
        Route::post('update/{id}', 'UkerController@update')->name('update');
        route::post('changeStatus/{id?}/{status}', 'UkerController@changeStatus')->name('changeStatus');
        route::post('delete/{id}', 'UkerController@delete')->name('delete');
    });
    // end routing menu unit kerja

    // start routing menu kategori obat
    Route::group(['as' => 'katobat.', 'prefix' => 'katobat', 'namespace' => 'MasterData'], function(){
        Route::get('index', 'KatobatController@index')->name('index');
        Route::post('ktable', 'KatobatController@ktable')->name('ktable');
        Route::get('show', 'KatobatController@show')->name('show');
        Route::post('store', 'KatobatController@store')->name('store');
        Route::get('edit/{id}', 'KatobatController@edit')->name('edit');
        Route::post('update/{id}', 'KatobatController@update')->name('update');
        route::post('changeStatus/{id?}/{status}', 'KatobatController@changeStatus')->name('changeStatus');
        route::post('delete/{id}', 'KatobatController@delete')->name('delete');
    });
    // end routing menu kategori obat

    // start routing menu jenis obat
    Route::group(['as' => 'jenobat.', 'prefix' => 'jenobat', 'namespace' => 'MasterData'], function(){
        Route::get('index', 'JenobatController@index')->name('index');
        Route::post('ktable', 'JenobatController@ktable')->name('ktable');
        Route::get('show', 'JenobatController@show')->name('show');
        Route::post('store', 'JenobatController@store')->name('store');
        Route::get('edit/{id}', 'JenobatController@edit')->name('edit');
        Route::post('update/{id}', 'JenobatController@update')->name('update');
        route::post('changeStatus/{id?}/{status}', 'JenobatController@changeStatus')->name('changeStatus');
        route::post('delete/{id}', 'JenobatController@delete')->name('delete');
    });
    // end routing menu jenis obat\

    // start routing menu jenis obat
    Route::group(['as' => 'obat.', 'prefix' => 'obat', 'namespace' => 'MasterData'], function(){
        Route::get('index', 'ObatController@index')->name('index');
        Route::post('ktable', 'ObatController@ktable')->name('ktable');
        Route::get('show', 'ObatController@show')->name('show');
        Route::post('store', 'ObatController@store')->name('store');
        Route::get('edit/{id}', 'ObatController@edit')->name('edit');
        Route::post('update/{id}', 'ObatController@update')->name('update');
        route::post('changeStatus/{id?}/{status}', 'ObatController@changeStatus')->name('changeStatus');
        route::post('delete/{id}', 'ObatController@delete')->name('delete');
        Route::post('inputStok', 'ObatController@inputStok')->name('inputStok');
        Route::post('storeStokObat', 'ObatController@storeStokObat')->name('storeStokObat');
        Route::post('ktableStokObat/{obat_id}', 'ObatController@ktableStokObat')->name('ktableStokObat');
    });
    // end routing menu jenis obat

    // start routing menu role
    Route::group(['as' => 'role.', 'prefix' => 'role', 'namespace' => 'MasterData'], function(){
        Route::get('index', 'RoleController@index')->name('index');
        Route::post('ktable', 'RoleController@ktable')->name('ktable');
        Route::get('show', 'RoleController@show')->name('show');
        Route::post('store', 'RoleController@store')->name('store');
        Route::get('edit/{id}', 'RoleController@edit')->name('edit');
        Route::post('update/{id}', 'RoleController@update')->name('update');
        route::post('changeStatus/{id?}/{status}', 'RoleController@changeStatus')->name('changeStatus');
        route::post('delete/{id}', 'RoleController@delete')->name('delete');
    });
    // end routing menu role

    // start routing menu poli
    Route::group(['as' => 'poli.', 'prefix' => 'poli', 'namespace' => 'MasterData'], function(){
        Route::get('index', 'PoliController@index')->name('index');
        Route::post('ktable', 'PoliController@ktable')->name('ktable');
        Route::get('show', 'PoliController@show')->name('show');
        Route::post('store', 'PoliController@store')->name('store');
        Route::get('edit/{id}', 'PoliController@edit')->name('edit');
        Route::post('update/{id}', 'PoliController@update')->name('update');
        route::post('changeStatus/{id?}/{status}', 'PoliController@changeStatus')->name('changeStatus');
        route::post('delete/{id}', 'PoliController@delete')->name('delete');
    });
    // end routing menu poli

    // start routing menu pasien
    Route::group(['as' => 'pasien.', 'prefix' => 'pasien', 'namespace' => 'Pasien'], function(){
        Route::get('index', 'PasienController@index')->name('index');
        Route::post('ktable', 'PasienController@ktable')->name('ktable');
        Route::get('show', 'PasienController@show')->name('show');
        Route::post('store', 'PasienController@store')->name('store');
        Route::get('edit/{id}', 'PasienController@edit')->name('edit');
        Route::post('update/{id}', 'PasienController@update')->name('update');
        route::post('changeStatus/{id?}/{status}', 'PasienController@changeStatus')->name('changeStatus');
        route::post('delete/{id}', 'PasienController@delete')->name('delete');
    });
    // end routing menu pasien

    // start routing menu input pasien
    Route::group(['as' => 'inputpasien.', 'prefix' => 'inputpasien', 'namespace' => 'Pasien'], function(){
        Route::get('index', 'InputPasienController@index')->name('index');
        route::post('pasienbaru', 'InputPasienController@pasienbaru')->name('pasienbaru');
        route::post('pasienterdaftar', 'InputPasienController@pasienterdaftar')->name('pasienterdaftar');
        route::post('storePasienBaru', 'InputPasienController@storePasienBaru')->name('storePasienBaru');
        route::post('updatePasienTerdaftar', 'InputPasienController@updatePasienTerdaftar')->name('updatePasienTerdaftar');
        route::post('getDataPsien', 'InputPasienController@getDataPsien')->name('getDataPsien');
    });
    // end routing menu input pasien

    // start routing menu pasien sedang berobat
    Route::group(['as' => 'pasienin.', 'prefix' => 'pasienin', 'namespace' => 'Pasien'], function(){
        Route::get('index', 'PasienInController@index')->name('index');
        Route::post('ktable', 'PasienInController@ktable')->name('ktable');
        Route::get('formPeriksa/{psntrans_id}', 'PasienInController@formPeriksa')->name('formPeriksa');
        Route::post('storeFormPeriksa/{psntrans_id}', 'PasienInController@storeFormPeriksa')->name('storeFormPeriksa');
        Route::get('formPeriksaDokter/{psntrans_id}', 'PasienInController@formPeriksaDokter')->name('formPeriksaDokter');
        Route::post('updateFormDokter/{psntrans_id}', 'PasienInController@updateFormDokter')->name('updateFormDokter');
        Route::get('riwayatRekdis/{pasien_id}', 'PasienInController@riwayatRekdis')->name('riwayatRekdis');
        Route::post('showFormResepDok', 'PasienInController@showFormResepDok')->name('showFormResepDok');
        Route::post('cekStokObat', 'PasienInController@cekStokObat')->name('cekStokObat');
        Route::post('storeResepObat/{psnrekdis_id}', 'PasienInController@storeResepObat')->name('storeResepObat');
        Route::post('editFormResepDok', 'PasienInController@editFormResepDok')->name('editFormResepDok');
        Route::post('updateResepObat/{psnrekdis_id}', 'PasienInController@updateResepObat')->name('updateResepObat');
        Route::post('showFormRujukanSpesialis', 'PasienInController@showFormRujukanSpesialis')->name('showFormRujukanSpesialis');
        Route::post('storeFormRjkSps/{psnrekdis_id}', 'PasienInController@storeFormRjkSps')->name('storeFormRjkSps');
        Route::post('editFormRujukanSpesialis/{rjksps_id}', 'PasienInController@editFormRujukanSpesialis')->name('editFormRujukanSpesialis');
        Route::post('updateFormRjkSps/{rjksps_id}', 'PasienInController@updateFormRjkSps')->name('updateFormRjkSps');
        Route::post('rukuanLab', 'PasienInController@rukuanLab')->name('rukuanLab');
        Route::post('selesaiDokter', 'PasienInController@selesaiDokter')->name('selesaiDokter');
    });
    // end routing menu pasien sedang berobat

    // start routing menu resep
    Route::group(['as' => 'listresep.', 'prefix' => 'listresep', 'namespace' => 'Resep'], function(){
        Route::get('index', 'ListResepController@index')->name('index');
        Route::post('ktable', 'ListResepController@ktable')->name('ktable');
        Route::get('showResepObat/{psntrans_id}', 'ListResepController@showResepObat')->name('showResepObat');
        Route::post('approveResep', 'ListResepController@approveResep')->name('approveResep');
    });
    // end routing menu resep

    // start routing menu resep
    Route::group(['as' => 'pasieninfo.', 'prefix' => 'pasieninfo', 'namespace' => 'Pasien'], function(){
        Route::get('index/{psntrans_id}', 'PasienInfoController@index')->name('index');
        Route::post('infoPeriksaSuster', 'PasienInfoController@infoPeriksaSuster')->name('infoPeriksaSuster');
        Route::post('infoResepObat', 'PasienInfoController@infoResepObat')->name('infoResepObat');
        Route::post('infoRekamedis', 'PasienInfoController@infoRekamedis')->name('infoRekamedis');
        Route::post('ktableRekamedis/{psntrans_id}', 'PasienInfoController@ktableRekamedis')->name('ktableRekamedis');
        Route::post('showInfoRekamedis', 'PasienInfoController@showInfoRekamedis')->name('showInfoRekamedis');
    });
    // end routing menu resep

    // start routing menu pasien cek lab
    Route::group(['as' => 'ceklab.', 'prefix' => 'ceklab', 'namespace' => 'Pasien'], function(){
        Route::get('index', 'CekLabController@index')->name('index');
        Route::post('ktable', 'CekLabController@ktable')->name('ktable');
        Route::get('showCekLab/{psntrans_id}', 'CekLabController@showCekLab')->name('showCekLab');
        Route::post('showFormLab', 'CekLabController@showFormLab')->name('showFormLab');
        Route::post('storeCekLab/{psnrekdis_id}', 'CekLabController@storeCekLab')->name('storeCekLab');
    });
    // end routing menu pasien cek lab

    // start routing menu pasien cek lab
    Route::group(['as' => 'pasienout.', 'prefix' => 'pasienout', 'namespace' => 'Pasien'], function(){
        Route::get('index', 'PasienOutController@index')->name('index');
        Route::post('ktable', 'PasienOutController@ktable')->name('ktable');
    });
});
