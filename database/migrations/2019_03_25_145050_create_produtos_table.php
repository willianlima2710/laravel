<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id_produto');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_fornecedor')->references('id_pessoa')->on('pessoas')->onDelete('set null');
            $table->string('nm_produto',100);
            $table->unsignedBigInteger('id_fornecedor')->nullable(true);
            $table->string('nm_fornecedor',100);
            $table->double('vl_compra')->nullable(true);
            $table->double('vl_venda')->nullable(true);
            $table->string('cd_unidade',3);
            $table->double('qt_estoque')->nullable(true);
            $table->double('qt_minestoque')->nullable(true)->default(1);
            $table->string('cd_barra',30)->nullable(true);
            $table->boolean('st_convalescente')->nullable(true)->default(false);
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
        Schema::dropIfExists('produtos');
    }
}
