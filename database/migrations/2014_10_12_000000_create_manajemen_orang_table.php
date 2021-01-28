<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManajemenOrangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_orang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password', 64);
            $table->text('alamat')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at', 'nip']);
            $table->index(['deleted_at', 'email']);
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
        Schema::dropIfExists('m_orang');
    }
}
