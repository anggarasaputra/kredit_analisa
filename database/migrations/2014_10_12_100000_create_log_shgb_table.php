<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogShgbTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('l_shgb', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->nullable();
			$table->string('tipe')->nullable();
			$table->string('nomor_sertifikat')->nullable();
			$table->string('masa_berlaku_sertifikat')->nullable();
			$table->string('atas_nama')->nullable();
			$table->integer('luas_tanah')->nullable();
			$table->integer('luas_bangunan')->nullable();
			$table->text('alamat')->nullable();
			$table->string('tahun_perolehan')->nullable();
			$table->double('nilai')->nullable();
			$table->timestamps();
			$table->softDeletes();
			
			$table->index(['deleted_at', 'parent_id', 'nomor_sertifikat']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('l_shgb');
	}
}
