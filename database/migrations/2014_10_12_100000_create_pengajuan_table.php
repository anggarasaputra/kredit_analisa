<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('p_pengajuan', function (Blueprint $table) {
			$table->string('id');
			$table->double('pokok_pinjaman');
			$table->double('kemampuan_angsur');
			$table->boolean('is_mobile');
			$table->text('nasabah');
			$table->text('dokumen_pelengkap');
			$table->string('kode_kantor');
			$table->text('ao')->nullable();
			$table->timestamps();
			$table->softDeletes();
			
			$table->primary('id');

            $table->index(['deleted_at', 'kode_kantor']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('p_pengajuan');
	}
}
