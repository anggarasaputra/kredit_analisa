<?php

namespace Thunderlabid\Survei\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator, DB;

///////////////
// Exception //
///////////////
use Thunderlabid\Survei\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailCreating;
use Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailCreated;
use Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailUpdating;
use Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailUpdated;
// use Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailDeleting;
// use Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailDeleted;

use Thunderlabid\Survei\Traits\TanggalTrait;
use Thunderlabid\Survei\Traits\WaktuTrait;
use Thunderlabid\Survei\Traits\IDRTrait;

class SurveiDetail extends Model
{
	use SoftDeletes;
	use TanggalTrait;
	use WaktuTrait;
	use IDRTrait;

	protected $table	= 's_survei_detail';
	protected $fillable	= ['survei_id', 'jenis', 'dokumen_survei'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $appends 	= ['has_foto'];

	public static $types	= ['character', 'condition', 'capacity', 'capital', 'collateral'];
    
	protected $events 	= [
		'creating' 	=> SurveiDetailCreating::class,
		'created' 	=> SurveiDetailCreated::class,
		'updating' 	=> SurveiDetailUpdating::class,
		'updated' 	=> SurveiDetailUpdated::class,
		// 'deleted' 	=> SurveiDetailDeleted::class,
		// 'deleting' 	=> SurveiDetailDeleting::class,
	];
	
	// ------------------------------------------------------------------------------------------------------------
	// CONSTRUCT
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// BOOT
	// -----------------------------------------------------------------------------------------------------------
	
	// ------------------------------------------------------------------------------------------------------------
	// RELATION
	// ------------------------------------------------------------------------------------------------------------
	public function survei()
	{
		return $this->belongsTo(Survei::class, 'survei_id');
	}

	public function foto()
	{
		return $this->hasOne(SurveiFoto::class, 'survei_detail_id');
	}

	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
	
	public function setDokumenSurveiAttribute($variable)
	{
		if(str_is($this->jenis, 'capacity'))
		{
			$variable['capacity']['penghasilan']['utama']		= $this->formatMoneyFrom($variable['capacity']['penghasilan']['utama']);
			$variable['capacity']['penghasilan']['pasangan']	= $this->formatMoneyFrom($variable['capacity']['penghasilan']['pasangan']);
			$variable['capacity']['penghasilan']['usaha']		= $this->formatMoneyFrom($variable['capacity']['penghasilan']['usaha']);
			$variable['capacity']['pengeluaran']['biaya_rutin']	= $this->formatMoneyFrom($variable['capacity']['pengeluaran']['biaya_rutin']);
			$variable['capacity']['pengeluaran']['angsuran_kredit']		= $this->formatMoneyFrom($variable['capacity']['pengeluaran']['angsuran_kredit']);
		}

		if(str_is($this->jenis, 'capital'))
		{
			if(isset($variable['capital']['rumah']['angsuran_bulanan']))
			{
				$variable['capital']['rumah']['angsuran_bulanan']	= $this->formatMoneyFrom($variable['capital']['rumah']['angsuran_bulanan']);
			}
			$variable['capital']['rumah']['nilai_rumah']			= $this->formatMoneyFrom($variable['capital']['rumah']['nilai_rumah']);
			$variable['capital']['kendaraan']['nilai_kendaraan']	= $this->formatMoneyFrom($variable['capital']['kendaraan']['nilai_kendaraan']);
			$variable['capital']['usaha']['nilai_aset']				= $this->formatMoneyFrom($variable['capital']['usaha']['nilai_aset']);
			$variable['capital']['usaha']['omzet_bulanan']			= $this->formatMoneyFrom($variable['capital']['usaha']['omzet_bulanan']);

			if(isset($variable['capital']['hutang']))
			{
				foreach ($variable['capital']['hutang'] as $k => $v) {
					$variable['capital']['hutang'][$k]['jumlah_pinjaman'] 	= $this->formatMoneyFrom($variable['capital']['hutang'][$k]['jumlah_pinjaman']);
					$variable['capital']['hutang'][$k]['jumlah_angsuran'] 	= $this->formatMoneyFrom($variable['capital']['hutang'][$k]['jumlah_angsuran']);
				}
			}
		}


		if(str_is($this->jenis, 'collateral') && str_is($variable['collateral']['jenis'], 'bpkb') && isset($variable['collateral']['bpkb']['harga_taksasi']))
		{
			$variable['collateral']['bpkb']['harga_taksasi']		= $this->formatMoneyFrom($variable['collateral']['bpkb']['harga_taksasi']);
			$variable['collateral']['bpkb']['harga_bank']			= $this->formatMoneyFrom($variable['collateral']['bpkb']['harga_bank']);
			$variable['collateral']['bpkb']['masa_berlaku_stnk']	= $this->formatDateFrom($variable['collateral']['bpkb']['masa_berlaku_stnk']);
		}

		if(str_is($this->jenis, 'collateral') && str_is($variable['collateral']['jenis'], 'shm') && isset($variable['collateral']['shm']['njop_tanah']))
		{
			if(isset($variable['collateral']['shm']['njop_bangunan']))
			{
				$variable['collateral']['shm']['njop_bangunan']		= $this->formatMoneyFrom($variable['collateral']['shm']['njop_bangunan']);
			}
			if(isset($variable['collateral']['shm']['nilai_bangunan']))
			{
				$variable['collateral']['shm']['nilai_bangunan']	= $this->formatMoneyFrom($variable['collateral']['shm']['nilai_bangunan']);
			}
			$variable['collateral']['shm']['njop_tanah']	= $this->formatMoneyFrom($variable['collateral']['shm']['njop_tanah']);
			$variable['collateral']['shm']['nilai_tanah']	= $this->formatMoneyFrom($variable['collateral']['shm']['nilai_tanah']);
			$variable['collateral']['shm']['harga_taksasi']	= $this->formatMoneyFrom($variable['collateral']['shm']['harga_taksasi']);
			
		}

		if(str_is($this->jenis, 'collateral') && str_is($variable['collateral']['jenis'], 'shgb') && isset($variable['collateral']['shgb']['njop_tanah']))
		{
			if(isset($variable['collateral']['shgb']['njop_bangunan']))
			{
				$variable['collateral']['shgb']['njop_bangunan']		= $this->formatMoneyFrom($variable['collateral']['shgb']['njop_bangunan']);
			}
			if(isset($variable['collateral']['shgb']['nilai_bangunan']))
			{
				$variable['collateral']['shgb']['nilai_bangunan']	= $this->formatMoneyFrom($variable['collateral']['shgb']['nilai_bangunan']);
			}
			;
			$variable['collateral']['shgb']['njop_tanah']		= $this->formatMoneyFrom($variable['collateral']['shgb']['njop_tanah']);
			$variable['collateral']['shgb']['nilai_tanah']		= $this->formatMoneyFrom($variable['collateral']['shgb']['nilai_tanah']);
			$variable['collateral']['shgb']['harga_taksasi']	= $this->formatMoneyFrom($variable['collateral']['shgb']['harga_taksasi']);			
		}

		$dokumen_survei 	= json_encode($variable);

		$this->attributes['dokumen_survei']	= $dokumen_survei;
	}

	// ------------------------------------------------------------------------------------------------------------
	// ACCESSOR
	// ------------------------------------------------------------------------------------------------------------
	public function getIsDeletableAttribute()
	{
		return true;
	}

	public function getIsSavableAttribute()
	{
		//////////////////
		// Create Rules //
		//////////////////
		$rules['survei_id']									= ['required', 'exists:s_survei,id'];
		$rules['jenis']										= ['required', 'in:'. implode(',',SELF::$types)];
		
		//CHARACTER
		$rules['dokumen_survei.character.lingkungan_tinggal']	= ['required_if:jenis,character', 'in:dikenal,kurang_dikenal,tidak_dikenal'];
		$rules['dokumen_survei.character.lingkungan_kerja']		= ['required_if:jenis,character', 'in:dikenal,kurang_dikenal,tidak_dikenal'];
		$rules['dokumen_survei.character.watak']				= ['required_if:jenis,character', 'in:baik,cukup_baik,tidak_baik'];
		$rules['dokumen_survei.character.pola_hidup']			= ['required_if:jenis,character', 'in:mewah,sederhana'];
		$rules['dokumen_survei.character.informasi.*']			= ['required_if:jenis,character'];
		
		//CONDITION
		$rules['dokumen_survei.condition.pekerjaan']				= ['required_if:jenis,condition'];
		$rules['dokumen_survei.condition.persaingan_usaha']			= ['required_if:dokumen_survei.condition.pekerjaan,wiraswasta', 'in:padat,sedang,biasa'];
		$rules['dokumen_survei.condition.prospek_usaha']			= ['required_if:dokumen_survei.condition.pekerjaan,wiraswasta', 'in:padat,sedang,biasa'];
		$rules['dokumen_survei.condition.perputaran_usaha']			= ['required_if:dokumen_survei.condition.pekerjaan,wiraswasta', 'in:padat,sedang,lambat'];
		$rules['dokumen_survei.condition.pengalaman_usaha']			= ['required_if:jenis,condition'];
		$rules['dokumen_survei.condition.resiko_usaha_kedepan']		= ['required_if:dokumen_survei.condition.pekerjaan,wiraswasta', 'in:bagus,biasa,suram'];
		$rules['dokumen_survei.condition.jumlah_pelanggan_harian']	= ['required_if:dokumen_survei.condition.pekerjaan,wiraswasta'];

		//CAPACITY
		$rules['dokumen_survei.capacity.pekerjaan']						= ['required_if:jenis,capacity'];
		$rules['dokumen_survei.capacity.manajemen_usaha']				= ['required_if:jenis,capacity', 'in:baik,cukup_baik,tidak_baik'];
		$rules['dokumen_survei.capacity.penghasilan.utama']				= ['required_if:jenis,capacity', 'numeric'];
		$rules['dokumen_survei.capacity.penghasilan.pasangan']			= ['numeric'];
		$rules['dokumen_survei.capacity.penghasilan.usaha']				= ['numeric'];
		$rules['dokumen_survei.capacity.penghasilan.rincian']			= ['required_if:jenis,capacity'];
		$rules['dokumen_survei.capacity.pengeluaran.biaya_rutin']		= ['numeric'];
		$rules['dokumen_survei.capacity.pengeluaran.angsuran_kredit']	= ['numeric'];
		$rules['dokumen_survei.capacity.pengeluaran.rincian']			= ['required_if:jenis,capacity'];
		$rules['dokumen_survei.capacity.tanggungan_keluarga']			= ['required_if:jenis,capacity'];

		//CAPITAL
		$rules['dokumen_survei.capital.rumah.status']			= ['required_if:jenis,capital','in:milik_sendiri,keluarga,dinas,sewa,angsuran'];
		$rules['dokumen_survei.capital.rumah.sewa_sejak']		= ['required_if:dokumen_survei.capital.rumah.status,sewa'];
		$rules['dokumen_survei.capital.rumah.masa_sewa']		= ['required_if:dokumen_survei.capital.rumah.status,sewa'];
		$rules['dokumen_survei.capital.rumah.angsuran_bulanan']	= ['required_if:dokumen_survei.capital.rumah.status,angsuran'];
		$rules['dokumen_survei.capital.rumah.lama_angsuran']	= ['required_if:dokumen_survei.capital.rumah.status,angsuran'];
		$rules['dokumen_survei.capital.rumah.lama_menempati']	= ['required_if:jenis,capital', 'numeric'];
		$rules['dokumen_survei.capital.rumah.luas_rumah']		= ['required_if:jenis,capital', 'numeric'];
		$rules['dokumen_survei.capital.rumah.nilai_rumah']		= ['required_if:jenis,capital', 'numeric'];

		$rules['dokumen_survei.capital.kendaraan.jumlah_kendaraan_roda_4']	= ['required_if:jenis,capital', 'numeric'];
		$rules['dokumen_survei.capital.kendaraan.jumlah_kendaraan_roda_2']	= ['required_if:jenis,capital', 'numeric'];
		$rules['dokumen_survei.capital.kendaraan.nilai_kendaraan']			= ['required_if:jenis,capital', 'numeric'];
		
		$rules['dokumen_survei.capital.usaha.nama_usaha']		= ['max:255'];
		$rules['dokumen_survei.capital.usaha.bidang_usaha']		= ['max:255'];
		// $rules['dokumen_survei.capital.usaha.lama_usaha']		= ['numeric'];
		$rules['dokumen_survei.capital.usaha.status']			= ['in:milik_sendiri,milik_keluarga,kerjasama_bagi_hasil'];
		// $rules['dokumen_survei.capital.usaha.bagi_hasil']		= ['required_if:dokumen_survei.capital.usaha.status,kerjasama_bagi_hasil', 'numeric'];
		$rules['dokumen_survei.capital.usaha.nilai_aset']		= ['numeric'];
		$rules['dokumen_survei.capital.usaha.omzet_bulanan']	= ['numeric'];
		
		$rules['dokumen_survei.capital.hutang.*.lembaga_keuangan']	= ['max:255'];
		$rules['dokumen_survei.capital.hutang.*.jumlah_pinjaman']	= ['numeric'];
		$rules['dokumen_survei.capital.hutang.*.jumlah_angsuran']	= ['numeric'];
		// $rules['dokumen_survei.capital.hutang.*.jangka_waktu']		= ['numeric'];

		//COLLATERAL
		$rules['dokumen_survei.collateral.jenis']			= ['required_if:jenis,collateral', 'in:bpkb,shm,shgb'];

		// $rules['dokumen_survei.collateral.bpkb.merk']			= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.tipe']			= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.nomor_polisi']	= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.nomor_polisi']	= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.warna']			= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.tahun']			= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'date_format:"Y"', 'before:'.date('Y', strtotime('now'))];
		// $rules['dokumen_survei.collateral.bpkb.atas_nama']		= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.alamat']			= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.nomor_bpkb']		= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.nomor_mesin']	= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.nomor_rangka']	= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.masa_berlaku_stnk']	= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'date_format:"Y-m-d"'];
		// $rules['dokumen_survei.collateral.bpkb.fungsi_sehari_hari']	= ['required_if:dokumen_survei.collateral.jenis,bpkb'];
		// $rules['dokumen_survei.collateral.bpkb.faktur']				= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.bpkb.kwitansi_jual_beli']	= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.bpkb.kwitansi_kosong']	= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.bpkb.ktp_an_bpkb']		= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.bpkb.kondisi_kendaraan']	= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'in:baik,cukup_baik,buruk'];
		// $rules['dokumen_survei.collateral.bpkb.status_kepemilikan']	= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'in:an_sendiri,an_orang_lain_milik_sendiri,an_orang_lain_dengan_surat_kuasa'];
		// $rules['dokumen_survei.collateral.bpkb.asuransi']			= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'in:all_risk,tlo,tidak_ada'];
		// $rules['dokumen_survei.collateral.bpkb.harga_taksasi']		= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'numeric'];
		// $rules['dokumen_survei.collateral.bpkb.persentasi_bank']	= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'numeric'];
		// $rules['dokumen_survei.collateral.bpkb.harga_bank']			= ['required_if:dokumen_survei.collateral.jenis,bpkb', 'numeric'];
		
		// $rules['dokumen_survei.collateral.shm.atas_nama_sertifikat']= ['required_if:dokumen_survei.collateral.jenis,shm'];
		// $rules['dokumen_survei.collateral.shm.nomor_sertifikat']	= ['required_if:dokumen_survei.collateral.jenis,shm'];
		// $rules['dokumen_survei.collateral.shm.alamat']			= ['required_if:dokumen_survei.collateral.jenis,shm'];
		// $rules['dokumen_survei.collateral.shm.tipe']			= ['required_if:dokumen_survei.collateral.jenis,shm', 'in:tanah,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shm.luas_tanah']		= ['required_if:dokumen_survei.collateral.jenis,shm'];
		$rules['dokumen_survei.collateral.shm.panjang_tanah']	= ['numeric'];
		// $rules['dokumen_survei.collateral.shm.panjang_tanah']	= ['required_if:dokumen_survei.collateral.jenis,shm'];
		// $rules['dokumen_survei.collateral.shm.lebar_tanah']		= ['required_if:dokumen_survei.collateral.jenis,shm'];
		// $rules['dokumen_survei.collateral.shm.luas_bangunan']	= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shm.panjang_bangunan']= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shm.lebar_bangunan']	= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shm.fungsi_bangunan']	= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan', 'in:ruko,rukan,rumah'];
		// $rules['dokumen_survei.collateral.shm.bentuk_bangunan']	= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan', 'in:tingkat,tidak_tingkat'];
		// $rules['dokumen_survei.collateral.shm.konstruksi_bangunan']	= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan', 'in:permanen,semi_permanen'];
		// $rules['dokumen_survei.collateral.shm.lantai_bangunan']		= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan', 'in:keramik,tegel_biasa'];
		// $rules['dokumen_survei.collateral.shm.dinding']		= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan', 'in:tembok,semi_tembok'];
		// $rules['dokumen_survei.collateral.shm.listrik']		= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shm.air']			= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan', 'in:pdam,sumur'];
		// $rules['dokumen_survei.collateral.shm.jalan']		= ['required_if:dokumen_survei.collateral.jenis,shm', 'in:tanah,batu,aspal'];
		// $rules['dokumen_survei.collateral.shm.letak_lokasi_terhadap_jalan']	= ['required_if:dokumen_survei.collateral.jenis,shm', 'in:sama,lebih_rendah,lebih_tinggi'];
		// $rules['dokumen_survei.collateral.shm.lingkungan']		= ['required_if:dokumen_survei.collateral.jenis,shm', 'in:perumahan,kampung,pertokoan,pasar,perkantoran,industri'];
		// $rules['dokumen_survei.collateral.shm.ajb']				= ['required_if:dokumen_survei.collateral.jenis,shm', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.shm.pbb_terakhir']	= ['required_if:dokumen_survei.collateral.jenis,shm', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.shm.imb']				= ['required_if:dokumen_survei.collateral.jenis,shm', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.shm.asuransi']		= ['required_if:dokumen_survei.collateral.jenis,shm', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.shm.nilai_tanah']		= ['required_if:dokumen_survei.collateral.jenis,shm', 'numeric'];
		// $rules['dokumen_survei.collateral.shm.njop_tanah']		= ['required_if:dokumen_survei.collateral.jenis,shm', 'numeric'];
		// $rules['dokumen_survei.collateral.shm.nilai_bangunan']	= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan', 'numeric'];
		// $rules['dokumen_survei.collateral.shm.njop_bangunan']	= ['required_if:dokumen_survei.collateral.shm.tipe,tanah_dan_bangunan', 'numeric'];
		$rules['dokumen_survei.collateral.shm.persentasi_taksasi']	= ['numeric'];
		// $rules['dokumen_survei.collateral.shm.persentasi_taksasi']	= ['required_if:dokumen_survei.collateral.jenis,shm', 'numeric'];
		// $rules['dokumen_survei.collateral.shm.harga_taksasi']		= ['required_if:dokumen_survei.collateral.jenis,shm', 'numeric'];

		// $rules['dokumen_survei.collateral.shgb.atas_nama_sertifikat']	= ['required_if:dokumen_survei.collateral.jenis,shgb'];
		// $rules['dokumen_survei.collateral.shgb.nomor_sertifikat']		= ['required_if:dokumen_survei.collateral.jenis,shgb'];
		// $rules['dokumen_survei.collateral.shgb.masa_berlaku_sertifikat']= ['required_if:dokumen_survei.collateral.jenis,shgb', 'date_format:"Y"'];
		// $rules['dokumen_survei.collateral.shgb.alamat']				= ['required_if:dokumen_survei.collateral.jenis,shgb'];
		// $rules['dokumen_survei.collateral.shgb.tipe']				= ['required_if:dokumen_survei.collateral.jenis,shgb', 'in:tanah,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shgb.luas_tanah']			= ['required_if:dokumen_survei.collateral.jenis,shgb'];
		// $rules['dokumen_survei.collateral.shgb.panjang_tanah']		= ['required_if:dokumen_survei.collateral.jenis,shgb'];
		// $rules['dokumen_survei.collateral.shgb.lebar_tanah']		= ['required_if:dokumen_survei.collateral.jenis,shgb'];
		// $rules['dokumen_survei.collateral.shgb.luas_bangunan']		= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shgb.panjang_bangunan']	= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shgb.lebar_bangunan']		= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shgb.fungsi_bangunan']	= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan', 'in:ruko,rukan,rumah'];
		// $rules['dokumen_survei.collateral.shgb.bentuk_bangunan']	= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan', 'in:tingkat,tidak_tingkat'];
		// $rules['dokumen_survei.collateral.shgb.konstruksi_bangunan']= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan', 'in:permanen,semi_permanen'];
		// $rules['dokumen_survei.collateral.shgb.lantai_bangunan']	= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan', 'in:keramik,tegel_biasa'];
		// $rules['dokumen_survei.collateral.shgb.dinding']	= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan', 'in:tembok,semi_tembok'];
		// $rules['dokumen_survei.collateral.shgb.listrik']	= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan'];
		// $rules['dokumen_survei.collateral.shgb.air']		= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan', 'in:pdam,sumur'];
		// $rules['dokumen_survei.collateral.shgb.jalan']		= ['required_if:dokumen_survei.collateral.jenis,shgb', 'in:tanah,batu,aspal'];
		// $rules['dokumen_survei.collateral.shgb.letak_lokasi_terhadap_jalan']	= ['required_if:dokumen_survei.collateral.jenis,shgb', 'in:sama,lebih_rendah,lebih_tinggi'];
		// $rules['dokumen_survei.collateral.shgb.lingkungan']	= ['required_if:dokumen_survei.collateral.jenis,shgb', 'in:perumahan,kampung,pertokoan,pasar,perkantoran,industri'];
		// $rules['dokumen_survei.collateral.shgb.ajb']			= ['required_if:dokumen_survei.collateral.jenis,shgb', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.shgb.pbb_terakhir']	= ['required_if:dokumen_survei.collateral.jenis,shgb', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.shgb.imb']			= ['required_if:dokumen_survei.collateral.jenis,shgb', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.shgb.asuransi']		= ['required_if:dokumen_survei.collateral.jenis,shgb', 'in:ada,tidak_ada'];
		// $rules['dokumen_survei.collateral.shgb.nilai_tanah']	= ['required_if:dokumen_survei.collateral.jenis,shgb', 'numeric'];
		// $rules['dokumen_survei.collateral.shgb.njop_tanah']		= ['required_if:dokumen_survei.collateral.jenis,shgb', 'numeric'];
		// $rules['dokumen_survei.collateral.shgb.nilai_bangunan']	= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan', 'numeric'];
		// $rules['dokumen_survei.collateral.shgb.njop_bangunan']	= ['required_if:dokumen_survei.collateral.shgb.tipe,tanah_dan_bangunan', 'numeric'];
		// $rules['dokumen_survei.collateral.shgb.persentasi_taksasi']	= ['required_if:dokumen_survei.collateral.jenis,shgb', 'numeric'];
		// $rules['dokumen_survei.collateral.shgb.harga_taksasi']		= ['required_if:dokumen_survei.collateral.jenis,shgb', 'numeric'];
		
		// $rules['dokumen_survei.collateral.foto.*.url']			= ['required_if:jenis,collateral', 'url'];
		// $rules['dokumen_survei.collateral.foto.*.keterangan']	= ['required_if:jenis,collateral'];
		
		$data 					= $this->attributes;
		$data['dokumen_survei'] = json_decode($data['dokumen_survei'], true);

		//////////////
		// Validate //
		//////////////
		$validator = Validator::make($data, $rules);
		if ($validator->fails())
		{
			$this->errors = $validator->messages();
			return false;
		}
		else
		{
			$this->errors = null;
			return true;
		}
	}

	public function getDokumenSurveiAttribute()
	{
		$variable 	= json_decode($this->attributes['dokumen_survei'], true);

		if(str_is($this->jenis, 'capacity'))
		{
			$variable['capacity']['penghasilan']['utama']		= $this->formatMoneyTo($variable['capacity']['penghasilan']['utama']);
			$variable['capacity']['penghasilan']['pasangan']	= $this->formatMoneyTo($variable['capacity']['penghasilan']['pasangan']);
			$variable['capacity']['penghasilan']['usaha']		= $this->formatMoneyTo($variable['capacity']['penghasilan']['usaha']);
			$variable['capacity']['pengeluaran']['biaya_rutin']	= $this->formatMoneyTo($variable['capacity']['pengeluaran']['biaya_rutin']);
			$variable['capacity']['pengeluaran']['angsuran_kredit']	= $this->formatMoneyTo($variable['capacity']['pengeluaran']['angsuran_kredit']);
		}

		if(str_is($this->jenis, 'capital'))
		{
			if(isset($variable['capital']['rumah']['angsuran_bulanan']))
			{
				$variable['capital']['rumah']['angsuran_bulanan']	= $this->formatMoneyTo($variable['capital']['rumah']['angsuran_bulanan']);
			}
			$variable['capital']['rumah']['nilai_rumah']			= $this->formatMoneyTo($variable['capital']['rumah']['nilai_rumah']);
			$variable['capital']['kendaraan']['nilai_kendaraan']	= $this->formatMoneyTo($variable['capital']['kendaraan']['nilai_kendaraan']);
			$variable['capital']['usaha']['nilai_aset']				= $this->formatMoneyTo($variable['capital']['usaha']['nilai_aset']);
			$variable['capital']['usaha']['omzet_bulanan']			= $this->formatMoneyTo($variable['capital']['usaha']['omzet_bulanan']);

			if(isset($variable['capital']['hutang']))
			{
				foreach ($variable['capital']['hutang'] as $k => $v) {
					$variable['capital']['hutang'][$k]['jumlah_pinjaman'] 	= $this->formatMoneyTo($variable['capital']['hutang'][$k]['jumlah_pinjaman']);
					$variable['capital']['hutang'][$k]['jumlah_angsuran'] 	= $this->formatMoneyTo($variable['capital']['hutang'][$k]['jumlah_angsuran']);
				}
			}
		}

		if(str_is($this->jenis, 'collateral') && str_is($variable['collateral']['jenis'], 'bpkb'))
		{
			$variable['collateral']['bpkb']['harga_taksasi']		= $this->formatMoneyTo($variable['collateral']['bpkb']['harga_taksasi']);
			$variable['collateral']['bpkb']['harga_bank']			= $this->formatMoneyTo($variable['collateral']['bpkb']['harga_bank']);
			$variable['collateral']['bpkb']['masa_berlaku_stnk']	= $this->formatDateTo($variable['collateral']['bpkb']['masa_berlaku_stnk']);
		}

		if(str_is($this->jenis, 'collateral') && str_is($variable['collateral']['jenis'], 'shm'))
		{
			if(isset($variable['collateral']['shm']['njop_bangunan']))
			{
				$variable['collateral']['shm']['njop_bangunan']		= $this->formatMoneyTo($variable['collateral']['shm']['njop_bangunan']);
			}
			if(isset($variable['collateral']['shm']['njop_bangunan']))
			{
				$variable['collateral']['shm']['nilai_bangunan']	= $this->formatMoneyTo($variable['collateral']['shm']['nilai_bangunan']);
			}
			$variable['collateral']['shm']['njop_tanah']	= $this->formatMoneyTo($variable['collateral']['shm']['njop_tanah']);
			$variable['collateral']['shm']['nilai_tanah']	= $this->formatMoneyTo($variable['collateral']['shm']['nilai_tanah']);
			$variable['collateral']['shm']['harga_taksasi']	= $this->formatMoneyTo($variable['collateral']['shm']['harga_taksasi']);
			
		}

		if(str_is($this->jenis, 'collateral') && str_is($variable['collateral']['jenis'], 'shgb'))
		{
			$variable['collateral']['shgb']['njop_bangunan']	= $this->formatMoneyTo($variable['collateral']['shgb']['njop_bangunan']);
			$variable['collateral']['shgb']['nilai_bangunan']	= $this->formatMoneyTo($variable['collateral']['shgb']['nilai_bangunan']);
			$variable['collateral']['shgb']['njop_tanah']		= $this->formatMoneyTo($variable['collateral']['shgb']['njop_tanah']);
			$variable['collateral']['shgb']['nilai_tanah']		= $this->formatMoneyTo($variable['collateral']['shgb']['nilai_tanah']);
			$variable['collateral']['shgb']['harga_taksasi']	= $this->formatMoneyTo($variable['collateral']['shgb']['harga_taksasi']);			
		}

		return $variable;
	}

	public function getHasFotoAttribute()
	{
		if($this->jenis == 'collateral' && count($this->foto))
		{
			return true;
		}

		return false;
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}

	public static function rule_of_valid_character()
	{
		$rules['lingkungan_tinggal']	= ['required'];
		$rules['lingkungan_kerja']		= ['required'];
		$rules['watak']					= ['required'];
		$rules['pola_hidup']			= ['required'];

		return $rules;
	}

	public static function rule_of_valid_condition()
	{
		$rules['persaingan_usaha']			= ['required_if:pekerjaan,wiraswasta'];
		$rules['prospek_usaha']				= ['required_if:pekerjaan,wiraswasta'];
		$rules['perputaran_usaha']			= ['required_if:pekerjaan,wiraswasta'];
		$rules['pengalaman_usaha']			= ['required'];
		$rules['resiko_usaha_kedepan']		= ['required_if:pekerjaan,wiraswasta'];
		$rules['jumlah_pelanggan_harian']	= ['required_if:pekerjaan,wiraswasta'];

		return $rules;
	}

	public static function rule_of_valid_capital()
	{
		$rules['rumah.status']			= ['required'];
		$rules['rumah.lama_menempati']	= ['required'];
		$rules['rumah.luas_rumah']		= ['required'];
		$rules['rumah.nilai_rumah']		= ['required'];
		
		$rules['kendaraan.jumlah_kendaraan_roda_4']	= ['required'];
		$rules['kendaraan.jumlah_kendaraan_roda_2']	= ['required'];
		$rules['kendaraan.nilai_kendaraan']			= ['required'];

		$rules['usaha.nama_usaha']		= ['required_if:pekerjaan,wiraswasta'];
		$rules['usaha.bidang_usaha']	= ['required_if:pekerjaan,wiraswasta'];
		$rules['usaha.lama_usaha']		= ['required_if:pekerjaan,wiraswasta'];
		$rules['usaha.status']			= ['required_if:pekerjaan,wiraswasta'];
		$rules['usaha.bagi_hasil']		= ['required_if:usaha.status,kerjasama_bagi_hasil'];
		$rules['usaha.nilai_aset']		= ['required_if:pekerjaan,wiraswasta'];
		$rules['usaha.omzet_bulanan']	= ['required_if:pekerjaan,wiraswasta'];

		$rules['hutang.*.lembaga_keuangan']	= ['required_if:pekerjaan,wiraswasta'];
		$rules['hutang.*.jumlah_pinjaman']	= ['required_if:pekerjaan,wiraswasta'];
		$rules['hutang.*.jumlah_angsuran']	= ['required_if:pekerjaan,wiraswasta'];
		$rules['hutang.*.jangka_waktu']		= ['required_if:pekerjaan,wiraswasta'];

		return $rules;
	}

	public static function rule_of_valid_capacity()
	{
		$rules['manajemen_usaha']				= ['required'];
		$rules['penghasilan.utama']				= ['required'];
		$rules['penghasilan.pasangan']			= ['required'];
		$rules['penghasilan.usaha']				= ['required'];
		$rules['penghasilan.rincian']			= ['required'];
		$rules['pengeluaran.biaya_rutin']		= ['required'];
		$rules['pengeluaran.angsuran_kredit']	= ['required'];
		$rules['pengeluaran.rincian']			= ['required'];
		$rules['tanggungan_keluarga']			= ['required'];

		return $rules;
	}

	public static function rule_of_valid_collateral_bpkb()
	{
		$rules['merk']				= ['required'];
		$rules['tipe']				= ['required'];
		$rules['nomor_polisi']		= ['required'];
		$rules['warna']				= ['required'];
		$rules['tahun']				= ['required'];
		$rules['atas_nama']			= ['required'];
		// $rules['alamat']			= ['required'];
		$rules['nomor_bpkb']		= ['required'];
		$rules['nomor_mesin']		= ['required'];
		$rules['nomor_rangka']		= ['required'];
		$rules['masa_berlaku_stnk']	= ['required'];
		$rules['fungsi_sehari_hari']= ['required'];
		$rules['faktur']			= ['required'];
		$rules['kwitansi_jual_beli']= ['required'];
		$rules['kwitansi_kosong']	= ['required'];
		$rules['ktp_an_bpkb']		= ['required'];
		$rules['kondisi_kendaraan']	= ['required'];
		$rules['status_kepemilikan']= ['required'];
		$rules['asuransi']			= ['required'];
		$rules['nilai_kendaraan']	= ['required'];
		$rules['persentasi_taksasi']= ['required'];
		$rules['harga_taksasi']		= ['required'];
		$rules['persentasi_bank']	= ['required'];
		$rules['harga_bank']		= ['required'];
		$rules['has_foto']			= ['required', 'between:1,1'];

		return $rules;
	}

	public static function rule_of_valid_collateral_sertifikat($jenis, $tipe)
	{
		$rules['atas_nama_sertifikat']			= ['required'];
		$rules['nomor_sertifikat']				= ['required'];

		if($jenis=='shgb')
		{
			$rules['masa_berlaku_sertifikat']	= ['required'];
		}

		$rules['alamat']			= ['required'];
		$rules['tipe']				= ['required'];
		$rules['luas_tanah']		= ['required'];
		$rules['panjang_tanah']		= ['required'];
		$rules['lebar_tanah']		= ['required'];

		if($tipe=='tanah_dan_bangunan')
		{
			$rules['luas_bangunan']			= ['required'];
			$rules['panjang_bangunan']		= ['required'];
			$rules['lebar_bangunan']		= ['required'];
			$rules['fungsi_bangunan']		= ['required'];
			$rules['bentuk_bangunan']		= ['required'];
			$rules['konstruksi_bangunan']	= ['required'];
			$rules['lantai_bangunan']		= ['required'];
			$rules['dinding']				= ['required'];
			$rules['listrik']				= ['required'];
			$rules['nilai_bangunan']		= ['required'];
			$rules['njop_bangunan']			= ['required'];
		}

		$rules['air']						= ['required'];
		$rules['jalan']						= ['required'];
		$rules['letak_lokasi_terhadap_jalan']	= ['required'];
		$rules['lingkungan']		= ['required'];
		$rules['ajb']				= ['required'];
		$rules['pbb_terakhir']		= ['required'];
		$rules['imb']				= ['required'];
		$rules['asuransi']			= ['required'];
		$rules['nilai_tanah']		= ['required'];
		$rules['njop_tanah']		= ['required'];
		$rules['persentasi_taksasi']			= ['required'];
		$rules['harga_taksasi']		= ['required'];
		$rules['has_foto']			= ['required', 'between:1,1'];

		return $rules;
	}
}
