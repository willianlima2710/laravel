<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtarecebersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctarecebers', function (Blueprint $table) {
            $table->bigIncrements('id_ctareceber');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_pessoa')->references('id_pessoa')->on('pessoas')->onDelete('cascade');
            $table->foreign('id_tppagamento')->references('id_tppagamento')->on('tppagamentos')->onDelete('set null');
            $table->unsignedBigInteger('id_pessoa');
            $table->string('cd_pessoa',10);
            $table->string('nm_pessoa',100);
            $table->string('nr_documento',30)->nullable(true); // pode ser o numero do contrato ou documento           
            $table->smallInteger('nr_parcela'); // numero da parcela numeral 01..02..03
            $table->string('st_parcela',10); // numero da parcela em sigla 01/10,02/10,03/10
            $table->date('dt_vencimento');
            $table->date('dt_pagamento')->nullable(true);
            $table->date('dt_carne')->nullable(true);
            $table->double('vl_apagar')->nullable(true); 
            $table->double('vl_pago')->nullable(true); // (valorapagar+juros+multa)-desconto
            $table->double('vl_juros')->nullable(true); 
            $table->double('vl_multa')->nullable(true); 
            $table->double('vl_desconto')->nullable(true);        
            $table->unsignedBigInteger('id_tppagamento')->nullable(true); // tipo de pagamento
            $table->unsignedBigInteger('id_banco')->nullable(true); // codigo do banco
            $table->unsignedBigInteger('id_planoconta')->nullable(true); // plano de contas
            $table->string('nr_cheque',20)->nullable(true); // se o tipo de pagamento for em cheque
            $table->string('nr_nossonum',20)->nullable(true); // numero do nosso numero
            $table->string('nr_dvnossonum',10)->nullable(true); // digito do numero do nosso numero
            $table->integer('nr_remessa')->nullable(true); // numero da remessa
            $table->date('dt_rembanco')->nullable(true); // data da remessa para o banco
            $table->string('st_boleto',1)->default('1'); // 0- boleto impresso / 1- banco envia
            $table->string('st_status',1)->default('0'); // 0- aberto / 1- pago
            $table->boolean('st_ativo')->nullable(true)->default(true); // titulo ativo ?
            $table->string('ds_historico',100)->nullable(true);
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
        Schema::dropIfExists('ctarecebers');
    }
}
