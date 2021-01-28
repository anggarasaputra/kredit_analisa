<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogNasabahTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('l_nasabah', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->nullable();
			$table->string('nik')->nullable();
			$table->string('nama')->nullable();
			$table->date('tanggal_lahir')->nullable();
			$table->string('tempat_lahir')->nullable();
			$table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
			$table->string('status_perkawinan')->nullable();
			$table->string('pekerjaan')->nullable();
			$table->double('penghasilan_bersih')->nullable();
			$table->string('telepon')->nullable();
			$table->string('email')->nullable();
			$table->string('nomor_whatsapp')->nullable();
			$table->text('alamat')->nullable();
			$table->text('keluarga')->nullable();
			$table->timestamps();
			$table->softDeletes();
			
			$table->index(['deleted_at', 'parent_id', 'nik']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('l_nasabah');
	}
}
