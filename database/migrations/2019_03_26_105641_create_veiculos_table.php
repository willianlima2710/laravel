<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->bigIncrements('id_veiculo');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('nm_veiculo',100);            
            $table->string('nr_placa',10)->nullable(true);
            $table->string('nm_marca',100)->nullable(true);
            $table->string('nm_cor',60)->nullable(true);
            $table->smallInteger('nr_ano')->nullable(true);
            $table->string('nm_seguradora',100)->nullable(true);
            $table->date('dt_vigencia')->nullable(true);
            $table->string('nm_condutor',100)->nullable(true);
            $table->date('dt_manutencao')->nullable(true);
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
        Schema::dropIfExists('veiculos');
    }
}
