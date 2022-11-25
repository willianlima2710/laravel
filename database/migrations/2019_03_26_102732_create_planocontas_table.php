<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanocontasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planocontas', function (Blueprint $table) {
            $table->bigIncrements('id_planoconta');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('nm_planoconta',100);            
            $table->integer('cd_conta');
            $table->integer('cd_pai');            
            $table->integer('nr_ordem');
            $table->integer('cd_reduzido');
            $table->string('st_tipo',1)->nullable(true)->default('0'); // 0-credito/1-debito
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
        Schema::dropIfExists('planocontas');
    }
}
