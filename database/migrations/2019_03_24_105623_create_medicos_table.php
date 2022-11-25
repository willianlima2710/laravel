<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->bigIncrements('id_medico');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('nm_medico',100);
            $table->string('nr_crm',40)->unique();
            $table->string('nm_especialidade',100)->nullable(true);
            $table->string('nm_endereco',100)->nullable(true);
            $table->string('nr_numender',20)->nullable(true);
            $table->string('nm_bairro',60)->nullable(true);
            $table->string('nm_cidade',60)->nullable(true);
            $table->string('nr_cep',20)->nullable(true);            
            $table->string('nm_estado',2)->nullable(true);
            $table->string('nm_plano1',60)->nullable(true);
            $table->string('nm_plano2',60)->nullable(true);
            $table->string('nm_plano3',60)->nullable(true);
            $table->double('vl_desconto1')->nullable(true);
            $table->double('vl_desconto2')->nullable(true);
            $table->double('vl_desconto3')->nullable(true);
            $table->string('nm_profissional',60)->nullable(true);
            $table->string('nm_clinica',60)->nullable(true);
            $table->double('vl_particular')->nullable(true);
            $table->double('vl_convenio')->nullable(true);
            $table->string('nm_telefone1',30)->nullable(true);
            $table->string('nm_telefone2',30)->nullable(true);
            $table->string('nm_telefone3',30)->nullable(true);            
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
        Schema::dropIfExists('medicos');
    }
}
