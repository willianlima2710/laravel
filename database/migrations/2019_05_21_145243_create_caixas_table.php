<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaixasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixas', function (Blueprint $table) {
            $table->bigIncrements('id_caixa');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_pessoa')->references('id_pessoa')->on('pessoas')->onDelete('cascade');
            $table->foreign('id_tppagamento')->references('id_tppagamento')->on('tppagamentos')->onDelete('set null');
            $table->unsignedBigInteger('id_pessoa');
            $table->string('cd_pessoa',10)->nullable(true);            
            $table->string('nm_pessoa',100);
            $table->string('nr_documento',30)->nullable(true);
            $table->unsignedBigInteger('id')->nullable(true); // id do lançanmento no contas a receber / pagar
            $table->smallInteger('nr_parcela'); // numero da parcela numeral 01..02..03
            $table->date('dt_vencimento');
            $table->date('dt_pagamento');
            $table->date('dt_movimento');
            $table->double('vl_total')->nullable(true); 
            $table->double('vl_juros')->nullable(true); 
            $table->double('vl_multa')->nullable(true); 
            $table->double('vl_desconto')->nullable(true);        
            $table->double('vl_saldo')->nullable(true); 
            $table->unsignedBigInteger('id_tppagamento')->nullable(true); // tipo de pagamento
            $table->unsignedBigInteger('id_banco')->nullable(true); // codigo do banco
            $table->unsignedBigInteger('id_planoconta')->nullable(true); // plano de contas
            $table->integer('cd_agencia')->nullable(true);
            $table->string('nr_conta',20)->nullable(true);
            $table->string('nr_cheque',20)->nullable(true);         
            $table->string('st_modulo',1)->default('0'); // 0- caixa / 1- receber / 2 - pagar
            $table->string('st_creddeb',1)->default('0'); // 0- credito / 1- debito
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
        Schema::dropIfExists('caixas');
    }
}
