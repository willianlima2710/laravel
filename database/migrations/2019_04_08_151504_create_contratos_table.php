<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id_contrato');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_pessoa')->references('id_pessoa')->on('pessoas')->onDelete('cascade');
            $table->foreign('id_plano')->references('id_plano')->on('planos')->onDelete('set null');
            $table->unsignedBigInteger('id_pessoa');
            $table->string('cd_pessoa',10);
            $table->string('nm_pessoa',100);
            $table->unsignedBigInteger('id_plano')->nullable(true);
            $table->unsignedBigInteger('id_vendedor')->nullable(true);
            $table->date('dt_inccontrato'); // data da inclusão do contrato
            $table->date('dt_fimcontrato')->nullable(true);// data do fim do contrato
            $table->date('dt_cancontrato')->nullable(true); // data de cancelamento do contrato
            $table->date('dt_cobcontrato')->nullable(true); // data de cobrança no juridico do contrato
            $table->smallInteger('nr_carencia')->nullable(true); // dias da carencia a partir da data do contrato
            $table->date('dt_termcarencia')->nullable(true); // calcula a data final da carencia data do contrato + dias
            $table->double('km_plano')->nullable(true); // km dentro do plano
            $table->double('vl_plano');
            $table->string('nr_contrato',10)->nullable(true);
            $table->smallInteger('qt_dependente')->nullable(true); 
            $table->string('st_cobranca',1)->nullable(true)->default('0'); // 0-carne / 1-boleto (tipo de cobrança)
            $table->double('vl_adicional')->nullable(true); 
            $table->double('vl_total'); // vl_plano+adicional
            $table->date('dt_valcarterinha')->nullable(true); // data de validade da carteirinha
            $table->smallInteger('qt_parcela')->nullable(true); // quantidade de parcela do contrato
            $table->date('dt_privencimento')->nullable(true); // data do primeiro vencimento
            $table->boolean('st_ativo')->nullable(true)->default(true);
            $table->string('st_status',1)->default('0'); // 0- normal / 1-juridico / 3 - cancelado
            $table->string('st_local',1)->default('1'); // 0- cobrança a domicilio / 1- banco,loterica.. / 2- no escritorio            
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
        Schema::dropIfExists('contratos');
    }
}
