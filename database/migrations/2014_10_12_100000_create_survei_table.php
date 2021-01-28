<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveiTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('s_survei', function (Blueprint $table) {
			$table->increments('id');
			$table->datetime('tanggal')->nullable();
			$table->string('pengajuan_id');
			$table->string('kode_kantor');
			$table->boolean('is_lengkap')->default(false);
			$table->timestamps();
			$table->softDeletes();

            $table->index(['deleted_at', 'kode_kantor', 'tanggal']);
            $table->index(['deleted_at', 'pengajuan_id', 'tanggal']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('s_survei');
	}
}
