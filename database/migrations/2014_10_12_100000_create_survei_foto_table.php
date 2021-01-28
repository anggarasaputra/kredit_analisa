<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveiFotoTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('s_survei_foto', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('survei_detail_id');
			$table->text('arsip_foto');
			$table->timestamps();
			$table->softDeletes();

            $table->index(['deleted_at', 'survei_detail_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('s_survei_foto');
	}
}
