<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//LOGIN API

Route::group(['namespace' => 'API'], function(){
	Route::any('/check/device',					['uses' => 'LoginController@post_login_device']);
	Route::any('/check/user',					['uses' => 'LoginController@post_login_with_username']);
	Route::any('/simulasi/{mode}',				['uses' => 'PermohonanController@simulasi', 'middleware' => 'device']);
	Route::any('/permohonan/store',				['uses' => 'PermohonanController@store', 'middleware' => 'device']);
	Route::any('/permohonan/index',				['uses' => 'PermohonanController@index', 'middleware' => 'device']);
	
	//UPLOAD FILE
	Route::any('/simpan/gambar',	['uses' => 'UploadGambarController@store', 'middleware' => 'device']);
	Route::any('/hapus/gambar',		['uses' => 'UploadGambarController@destroy', 'middleware' => 'device']);

	//SURVEI
	Route::any('/survei/index',										['uses' => 'SurveiController@index', 'middleware' => 'device']);
	Route::any('/survei/{pengajuan_id}/foto/{survei_detail_id}',	['uses' => 'SurveiController@simpan_foto', 'middleware' => 'device']);
});

Route::middleware('device')->group( function() {
	Route::any('/pengaturan', function (Request $request) 
	{
		if($request->has('nip_karyawan'))
		{
			return Response::json(['status' => 1, 'data' => ['minimum_pengajuan' => 2500000, 'minimum_shgb' => Carbon\Carbon::now()->format('Y'), 'remain_pengajuan' => 1, 'max_jaminan_kendaraan' => 2, 'max_jaminan_tanah_dan_bangunan' => 3]]);
		}

		$phone 			= $request->get('mobile');
		$jlh_pengajuan	= \Thunderlabid\Pengajuan\Models\Pengajuan::status('permohonan')->where('nasabah->telepon', $phone['telepon'])->count();

		return Response::json(['status' => 1, 'data' => ['minimum_pengajuan' => 2500000, 'minimum_shgb' => Carbon\Carbon::now()->format('Y'), 'minimum_bpkb' => Carbon\Carbon::now()->subYears(25)->format('Y'), 'remain_pengajuan' => (3 - $jlh_pengajuan), 'max_jaminan_kendaraan' => 2, 'max_jaminan_tanah_dan_bangunan' => 3]]);
	});
});
