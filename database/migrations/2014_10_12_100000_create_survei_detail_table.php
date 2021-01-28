<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveiDetailTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('s_survei_detail', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('survei_id');
			$table->enum('jenis', ['character', 'condition', 'capacity', 'capital', 'collateral']);
			$table->text('dokumen_survei');
			$table->timestamps();
			$table->softDeletes();
			
            $table->index(['deleted_at', 'survei_id', 'jenis']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('s_survei_detail');
	}
}
