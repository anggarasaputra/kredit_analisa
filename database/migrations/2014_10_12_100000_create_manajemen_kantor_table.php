<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManajemenKantorTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_kantor', function (Blueprint $table) {
			$table->string('id');
			$table->string('kantor_id')->nullable();
			$table->string('nama');
			$table->text('alamat');
			$table->text('geolocation');
			$table->string('telepon', 20);
			$table->enum('tipe', ['holding', 'pusat', 'cabang']);
			$table->enum('jenis', ['bpr', 'koperasi'])->nullable();
			$table->timestamps();
			$table->softDeletes();
		
			$table->primary('id');

			$table->index(['deleted_at', 'nama']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('m_kantor');
	}
}
