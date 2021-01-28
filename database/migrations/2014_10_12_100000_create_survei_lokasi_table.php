<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveiLokasiTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('s_survei_lokasi', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('survei_id');
			$table->string('nama')->nullable();
			$table->string('telepon')->nullable();
			$table->text('alamat')->nullable();
			
			$table->string('kelurahan')->nullable();
			$table->string('kecamatan')->nullable();
			$table->string('kota')->nullable();

			$table->string('agenda')->nullable();
			$table->timestamps();
			$table->softDeletes();

            $table->index(['deleted_at', 'kecamatan', 'kota']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('s_survei_lokasi');
	}
}
