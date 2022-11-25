<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJazigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jazigos', function (Blueprint $table) {
            $table->bigIncrements('id_jazigo');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('cd_jazigo',10);
            $table->string('nm_jazigo',100);
            $table->string('cd_quadra',10)->nullable(true);
            $table->string('cd_rua',10)->nullable(true);
            $table->string('cd_setor',10)->nullable(true);
            $table->boolean('st_ocupado')->nullable(true)->default(false); // jazigo ocupado ?
            $table->boolean('st_ativo')->nullable(true)->default(true); // jazigo ativo ?
            $table->string('st_granito',1)->nullable(true)->default('2'); // 0- SIM - EMPRESA/1- SIM - CLIENTE/2 - NÃO
            $table->binary('nm_obs')->nullable(true);
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
        Schema::dropIfExists('jazigos');
    }
}
