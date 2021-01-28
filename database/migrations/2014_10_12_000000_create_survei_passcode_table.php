<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveiPasscodeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('s_survei_passcode', function (Blueprint $table) {
			$table->increments('id');
			$table->string('survei_id');
			$table->string('passcode');
			$table->datetime('expired_at');
			$table->timestamps();
			$table->softDeletes();

            $table->index(['deleted_at', 'survei_id', 'passcode']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('s_survei_passcode');
	}
}
