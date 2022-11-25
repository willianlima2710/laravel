<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFxacidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fxacidades', function (Blueprint $table) {
            $table->bigIncrements('id_fxacidade');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('nm_fxacidade',100);
            $table->smallInteger('nr_idadeinicial');
            $table->smallInteger('nr_idadefinal');
            $table->double('vl_acrescentar');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fxacidades');
    }
}
