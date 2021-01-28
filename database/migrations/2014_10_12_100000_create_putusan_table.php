<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePutusanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('p_putusan', function (Blueprint $table) {
			$table->increments('id');
			$table->string('pengajuan_id');
			$table->datetime('tanggal');
			$table->text('pembuat_keputusan');
			$table->boolean('is_baru');
			$table->double('plafon_pinjaman');
			$table->float('suku_bunga');
			$table->integer('jangka_waktu');
			$table->integer('perc_provisi');
			$table->double('provisi');
			$table->double('administrasi');
			$table->double('legal');
			$table->text('checklists')->nullable();
			$table->enum('putusan', ['tolak', 'setuju']);
			$table->text('catatan')->nullable();
			$table->timestamps();
			$table->softDeletes();
			
            $table->index(['deleted_at', 'pengajuan_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('p_putusan');
	}
}
