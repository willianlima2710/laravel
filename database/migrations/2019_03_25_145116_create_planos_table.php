<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->bigIncrements('id_plano');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('nm_plano',100);            
            $table->double('vl_cobertura')->nullable(true);
            $table->double('vl_kmincluido')->nullable(true);
            $table->double('vl_plano')->nullable(true); // valor da mensalidade do plano
            $table->double('vl_salminino')->nullable(true); // % do salario minimo
            $table->double('vl_jurosdia')->nullable(true); // juros ao dia
            $table->double('vl_multa')->nullable(true); // multa apos o vencimento
            $table->double('vl_adesao')->nullable(true); // taxa de adesao
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
        Schema::dropIfExists('planos');
    }
}
