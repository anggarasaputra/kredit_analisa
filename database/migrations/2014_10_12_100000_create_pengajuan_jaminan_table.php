<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanJaminanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('p_jaminan', function (Blueprint $table) {
			$table->increments('id');
			$table->string('pengajuan_id');
			$table->enum('jenis', ['bpkb', 'shm', 'shgb']);
			$table->double('nilai_jaminan');
			$table->integer('tahun_perolehan');
			$table->text('dokumen_jaminan');
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
		Schema::dropIfExists('p_jaminan');
	}
}
