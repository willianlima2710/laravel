<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosDepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_dep', function (Blueprint $table) {
            $table->bigIncrements('id_contratodep');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_contrato')->references('id_contrato')->on('contratos')->onDelete('cascade');
            $table->foreign('id_pessoa')->references('id_pessoa')->on('pessoas')->onDelete('cascade');
            $table->foreign('id_jazigo')->references('id_jazigo')->on('jazigos')->onDelete('set null');
            $table->foreign('id_plano')->references('id_plano')->on('planos')->onDelete('set null');
            $table->foreign('id_cemiterio')->references('id_cemiterio')->on('cemiterios')->onDelete('set null');            
            $table->foreign('id_funeraria')->references('id_funeraria')->on('funerarias')->onDelete('set null');
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_pessoa'); //-- automatico vindo do contrato
            $table->string('cd_pessoa',10)->nullable(true);
            $table->string('nm_pessoa',100);
            $table->unsignedBigInteger('id_jazigo')->nullable(true); //-- jazigo
            $table->unsignedBigInteger('id_plano')->nullable(true); //-- plano
            $table->unsignedBigInteger('id_cemiterio')->nullable(true); //-- cemiterio
            $table->unsignedBigInteger('id_funeraria')->nullable(true); //-- funeraria
            $table->string('nr_placa',10)->nullable(true); //-- numero da placa no jazigo
            $table->string('nr_contrato',10)->nullable(true); //-- automatico vindo do contrato
            $table->smallInteger('cd_sequencia'); // sequencia de 1... do dependente
            $table->string('nm_dependente',100);
            $table->string('nr_telefone1',30)->nullable(true); //-- telefone1
            $table->string('nr_telefone2',30)->nullable(true); //-- telefone2
            $table->unsignedBigInteger('id_estcivil')->nullable(true);
            $table->unsignedBigInteger('id_parentesco')->nullable(true);
            $table->string('st_sexo',1)->nullable(true)->default('0'); // 0-masculino/1-feminino
            $table->date('dt_nascimento')->nullable(true); 
            $table->smallInteger('nr_idade')->nullable(true);          
            $table->boolean('st_depextra')->nullable(true)->default(false); // dependente extra
            $table->string('nr_cpf',30)->nullable(true);
            $table->string('nr_rg',30)->nullable(true);
            $table->string('st_status',1)->nullable(true)->default('0'); // 0-vivo/1-falecido
            $table->date('dt_falecimento')->nullable(true); 
            $table->date('dt_sepultamento')->nullable(true);
            $table->double('vl_sepultamento')->nullable(true);  
            $table->smallInteger('nr_carencia')->nullable(true); 
            $table->boolean('st_titular')->nullable(true)->default(false); // é o titular
            $table->boolean('st_ativo')->nullable(true)->default(true); // dependente ativo ?
            $table->boolean('st_atendido')->nullable(true)->default(false); // dependente atendido ?
            $table->boolean('st_continuidade')->nullable(true)->default(false); // dependente continua o contrato ?                      
            $table->unsignedBigInteger('id_obito')->nullable(true); // grava o id do obito para futuras operações
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
        Schema::dropIfExists('contratos_dep');
    }
}
