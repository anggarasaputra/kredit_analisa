<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogBpkbTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('l_bpkb', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->nullable();
			$table->string('tipe')->nullable();
			$table->string('merk')->nullable();
			$table->string('tahun')->nullable();
			$table->string('nomor_bpkb')->nullable();
			$table->string('atas_nama')->nullable();
			$table->string('jenis')->nullable();
			$table->string('tahun_perolehan')->nullable();
			$table->double('nilai')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->index(['deleted_at', 'parent_id', 'nomor_bpkb']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('l_bpkb');
	}
}
