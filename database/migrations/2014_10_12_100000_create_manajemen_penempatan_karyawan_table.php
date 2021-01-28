<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManajemenPenempatanKaryawanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_penempatan_karyawan', function (Blueprint $table) {
			$table->increments('id');
			$table->string('kantor_id');
			$table->integer('orang_id');
			$table->string('role');
			$table->text('scopes');
			$table->text('policies');
			$table->datetime('tanggal_masuk');
			$table->datetime('tanggal_keluar')->nullable();
			$table->timestamps();
			$table->softDeletes();

            $table->index(['deleted_at', 'kantor_id', 'orang_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('m_penempatan_karyawan');
	}
}
