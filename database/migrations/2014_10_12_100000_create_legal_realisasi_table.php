<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalRealisasiTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('p_legal_realisasi', function (Blueprint $table) {
			$table->increments('id');
			$table->string('pengajuan_id');
			$table->string('nomor');
			$table->string('jenis');
			$table->text('isi');
			$table->timestamps();
			$table->softDeletes();

            $table->index(['deleted_at', 'pengajuan_id', 'jenis']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('p_legal_realisasi');
	}
}
