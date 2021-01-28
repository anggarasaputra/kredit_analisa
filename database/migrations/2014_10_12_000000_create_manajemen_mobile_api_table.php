<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManajemenMobileApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_mobile_api', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('secret');
            $table->string('tipe');
            $table->integer('versi');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_mobile_api');
    }
}
