<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your appication. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Route::domain('localhost')->group(function(){
	Route::get('/', 						['as'	=> 'login', 						'uses' => 'LoginController@login']);
	Route::post('/', 						['as'	=> 'login.post', 					'uses' => 'LoginController@post_login']);
	Route::get('/logout', 					['as'	=> 'logout', 						'uses' => 'LoginController@logout']);

	Route::get('/forget_password', 			['as'	=> 'forget_password', 				'uses' => 'LoginController@forget_password']);
	Route::post('/register', 				['as'	=> 'register.post', 				'uses' => 'LoginController@post_register']);
	Route::post('/forget_password', 		['as'	=> 'forget_password.post', 			'uses' => 'LoginController@post_forget_password']);

	Route::get('/password', 	['as'	=> 'password.get', 		'uses' => 'LoginController@password_get']);
	Route::post('/password', 	['as'	=> 'password.post', 	'uses' => 'LoginController@password_post']);

	Route::get('/pilih/koperasi',			['as'	=> 'pilih.koperasi','uses' => 'DashboardController@pilih_koperasi']);

	Route::middleware(['auth', 'pilih_koperasi'])->group( function() {
		Route::get('/home',					['as'	=> 'home',			'uses' => 'DashboardController@home']);
		Route::get('/simulasi/{mode}',		['as'	=> 'simulasi',		'uses' => 'DashboardController@simulasi']);
		Route::get('/download/{filename}',	['as' 	=> 'download', 		'uses' => 'DownloadController@download']);
	
		Route::prefix('pengajuan')->namespace('Pengajuan')->as('pengajuan.')->group( function() {

			Route::get('index/ajax', 		['uses' => 'PengajuanController@ajax', 'as' => 'pengajuan.ajax']);
			// Route::get('/{status}',				['as'	=> 'pengajuan.index', 	'uses' => 'PengajuanController@index']);
			// Route::get('/{status}/{id}/show',	['as'	=> 'pengajuan.show', 	'uses' => 'PengajuanController@show']);
			Route::delete('/{status}/{id}',					['as'	=> 'pengajuan.destroy', 'uses' => 'PengajuanController@destroy']);
			Route::post('/pengajuan/assign/analisa/{id}',	['as'	=> 'pengajuan.assign_analisa', 	'uses' => 'PengajuanController@assign_analisa']);
			Route::post('/pengajuan/assign/putusan/{id}',	['as'	=> 'pengajuan.assign_putusan', 	'uses' => 'PengajuanController@assign_putusan']);
			Route::post('/pengajuan/validasi/putusan/{id}',	['as'	=> 'pengajuan.validasi_putusan', 	'uses' => 'PengajuanController@validasi_putusan']);
			
			// Route::middleware('scope:permohonan')->group( function() {
				Route::resource('permohonan', 					'PermohonanController');
				Route::post('/permohonan/assign/survei/{id}',	['as'	=> 'permohonan.assign_survei', 	'uses' => 'PermohonanController@assign_survei']);
			// });
			// Route::middleware('scope:survei')->group( function() {
				Route::resource('survei', 			'SurveiController');
			// });

			// Route::middleware('scope:analisa')->group( function() {
				Route::resource('analisa', 			'AnalisaController');
			// });

			// Route::middleware('scope:putusan')->group( function() {
				Route::resource('putusan', 			'PutusanController');
			// });
			
			// Route::middleware('scope:realisasi')->group( function() {
				Route::get('/realisasi/{id}/done',	['as'	=> 'realisasi.done', 	'uses' => 'RealisasiController@done']);
			// });

			// Route::middleware('scope:passcode')->group( function() {
				Route::resource('passcode', 		'PasscodeController');
			// });

			Route::get('/realisasi/{id}/print/{mode}',		['as'	=> 'pengajuan.print', 	'uses' => 'PengajuanController@print', 'middleware' => 'scope:realisasi']);
		});
		
		Route::prefix('manajemen')->namespace('Manajemen')->as('manajemen.')->group( function() {
			Route::resource('kantor', 		'KantorController');
			Route::post('kantor/batch', 	['uses' => 'KantorController@batch', 	'as' => 'kantor.batch']);
			Route::get('kantor/index/ajax', ['uses' => 'KantorController@ajax', 	'as' => 'kantor.ajax']);
			
			Route::resource('karyawan', 	'KaryawanController');
			Route::post('karyawan/batch',		 		['uses' => 'KaryawanController@batch', 	'as' => 'karyawan.batch']);
			Route::get('karyawan/batch/upload', 		['uses' => 'KaryawanController@upload', 'as' => 'karyawan.upload']);
			Route::any('karyawan/index/ajax',			['uses' => 'KaryawanController@ajax', 	'as' => 'karyawan.ajax']);
		});

	});
	Route::any('regensi',	['uses' => 'HelperController@getRegensi', 		'as' => 'regensi.index']);
	Route::any('distrik',	['uses'	=> 'HelperController@getDistrik',		'as' => 'distrik.index']);
	Route::any('desa',		['uses' => 'HelperController@getDesa',			'as' => 'desa.index']);

	Route::any('jabatan',	['uses' => 'HelperController@jabatan',			'as' => 'jabatan.index']);
	Route::any('scopes',	['uses' => 'HelperController@scopes',			'as' => 'scopes.index']);
	
	Route::any('upload/image', 		['as' => 'upload.image.store',		'uses' => 'HelperController@storeGambar']);
	Route::any('remove/image',		['as' => 'upload.image.destroy',	'uses' => 'HelperController@destroyGambar']);

	//ajax data log
	Route::any('log/nasabah', 		['as' => 'log.nasabah',		'uses' => 'LogController@nasabah']);
	Route::any('log/bpkb', 			['as' => 'log.bpkb',		'uses' => 'LogController@bpkb']);
	Route::any('log/sertifikat', 	['as' => 'log.sertifikat',	'uses' => 'LogController@sertifikat']);
	

	// privacy policy
	Route::any('privacy/policy',	['as' => 'privacy.policy',	'uses' => 'PageController@privacy_policy']);
#});


Route::get('/test', function() {
	$api = new Thunderlabid\Instagramapi\API('3290936526.5128893.67c47da60f00415cb35444c693584f2b');
	dd($api->self_followed_by());
});