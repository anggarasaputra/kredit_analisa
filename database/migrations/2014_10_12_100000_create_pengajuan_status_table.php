<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanStatusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('p_status', function (Blueprint $table) {
			$table->increments('id');
			$table->string('pengajuan_id');
			$table->datetime('tanggal');
			$table->string('status');
			$table->enum('progress', ['perlu', 'sedang', 'sudah']);
			$table->text('catatan')->nullable();
			$table->text('karyawan')->nullable();
			$table->timestamps();
			$table->softDeletes();

            $table->index(['deleted_at', 'pengajuan_id', 'status']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('p_status');
	}
}
