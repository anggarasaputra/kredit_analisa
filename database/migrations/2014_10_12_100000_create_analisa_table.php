<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalisaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('p_analisa', function (Blueprint $table) {
			$table->increments('id');
			$table->string('pengajuan_id');
			$table->text('analis');
			$table->datetime('tanggal');
			$table->enum('character', ['sangat_baik', 'baik', 'cukup_baik', 'tidak_baik', 'buruk']);
			$table->enum('capacity', ['sangat_baik', 'baik', 'cukup_baik', 'tidak_baik', 'buruk']);
			$table->enum('capital', ['sangat_baik', 'baik', 'cukup_baik', 'tidak_baik', 'buruk']);
			$table->enum('condition', ['sangat_baik', 'baik', 'cukup_baik', 'tidak_baik', 'buruk']);
			$table->enum('collateral', ['sangat_baik', 'baik', 'cukup_baik', 'tidak_baik', 'buruk']);
			$table->string('jenis_pinjaman');
			$table->float('suku_bunga');
			$table->integer('jangka_waktu');
			$table->double('limit_angsuran');
			$table->integer('limit_jangka_waktu');
			$table->double('kredit_diusulkan');
			$table->double('angsuran_pokok');
			$table->double('angsuran_bunga');
			$table->timestamps();
			$table->softDeletes();
			
            $table->index(['deleted_at', 'pengajuan_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('p_analisa');
	}
}
