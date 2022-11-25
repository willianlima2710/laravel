<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtapagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctapagars', function (Blueprint $table) {
            $table->bigIncrements('id_ctapagar');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_fornecedor')->references('id_pessoa')->on('pessoas')->onDelete('cascade');
            $table->foreign('id_tppagamento')->references('id_tppagamento')->on('tppagamentos')->onDelete('set null');
            $table->unsignedBigInteger('id_fornecedor');
            $table->string('nm_fornecedor',100);
            $table->string('nr_documento',30)->nullable(true);
            $table->smallInteger('nr_parcela'); // numero da parcela numeral 01..02..03
            $table->date('dt_vencimento');
            $table->date('dt_pagamento')->nullable(true);
            $table->double('vl_apagar')->nullable(true); 
            $table->double('vl_pago')->nullable(true); // (valorapagar+juros+multa)-desconto
            $table->double('vl_juros')->nullable(true); 
            $table->double('vl_multa')->nullable(true); 
            $table->double('vl_desconto')->nullable(true);        
            $table->unsignedBigInteger('id_tppagamento')->nullable(true); // tipo de pagamento
            $table->unsignedBigInteger('id_banco')->nullable(true); // codigo do banco
            $table->unsignedBigInteger('id_planoconta')->nullable(true); // plano de contas
            $table->integer('cd_agencia')->nullable(true);
            $table->string('nr_conta',20)->nullable(true);
            $table->string('nr_cheque',20)->nullable(true);         
            $table->string('st_status',1)->default('0'); // 0- aberto / 1- pago / 2 - inativo
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
        Schema::dropIfExists('ctapagars');
    }
}
