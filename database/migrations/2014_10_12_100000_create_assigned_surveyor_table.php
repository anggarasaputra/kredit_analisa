<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignedSurveyorTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('s_assigned_surveyor', function (Blueprint $table) {
			$table->increments('id');
			$table->string('survei_id');
			$table->string('nip');
			$table->string('nama')->nullable();
			$table->timestamps();
			$table->softDeletes();

            $table->index(['deleted_at', 'survei_id', 'nip']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('s_assigned_surveyor');
	}
}
