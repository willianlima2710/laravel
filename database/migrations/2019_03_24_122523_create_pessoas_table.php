<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('id_pessoa');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_estcivil')->references('id_estcivil')->on('estcivils')->onDelete('set null');
            $table->foreign('id_religiao')->references('id_religiao')->on('religiaos')->onDelete('set null');
            $table->foreign('id_funcao')->references('id_funcao')->on('funcoes')->onDelete('set null');
            $table->string('cd_pessoa',10)->nullable(true);
            $table->string('nm_pessoa',100);
            $table->string('nm_endereco',100);
            $table->string('nr_numender',20);
            $table->string('nm_complender',100)->nullable(true);
            $table->string('nm_bairro',60);
            $table->string('nm_cidade',60);
            $table->string('nr_cep',20);            
            $table->string('nm_estado',2);            
            $table->string('nr_telefone1',30)->nullable(true);
            $table->string('nr_telefone2',30)->nullable(true);
            $table->string('nr_telefone3',30)->nullable(true);
            $table->string('nr_telefone4',30)->nullable(true);
            $table->string('nm_pai',100)->nullable(true);
            $table->string('nr_paitelefone',30)->nullable(true);
            $table->boolean('st_paivivo')->nullable(true)->default(true);
            $table->string('nm_mae',100)->nullable(true);
            $table->string('nr_maetelefone',30)->nullable(true);
            $table->boolean('st_maeviva')->nullable(true)->default(true);
            $table->string('nm_conjuge',100)->nullable(true);
            $table->string('nr_conjugetelefone',30)->nullable(true);
            $table->string('nr_cpfcnpj',30)->index();
            $table->string('nr_rgie',30)->nullable(true)->index();
            $table->string('nm_email',191)->nullable(true);
            $table->string('nm_site',191)->nullable(true);
            $table->string('nm_profissao',100)->nullable(true);
            $table->unsignedBigInteger('id_estcivil')->nullable(true);
            $table->date('dt_nascimento')->nullable(true);
            $table->unsignedBigInteger('id_religiao')->nullable(true);
            $table->string('nm_nacionalidade',100)->nullable(true)->default('BRASILEIRA');
            $table->string('nm_naturalidade',100)->nullable(true);                        
            $table->string('st_sexo',1)->nullable(true)->default('0'); // 0-masculino/1-feminino
            $table->string('st_pessoa',1)->default('0'); // 0-fisica/1-juridica
            $table->string('st_tipo',1)->default('0'); // 0-cliente/1-fornecedor/2-funcionario/3-empresa(corporativo)
            $table->string('nm_contato',100)->nullable(true);                                    
            $table->double('vl_comprod')->nullable(true); // % de comissão nos produtos
            $table->double('vl_comserv')->nullable(true); // % de comissão nos serviços
            $table->boolean('st_comcob')->nullable(true)->default(false); // gera comissão na cobrança
            $table->double('vl_salario')->nullable(true); // valor do salario
            $table->date('dt_admissao')->nullable(true);
            $table->date('dt_demissao')->nullable(true);
            $table->string('nr_pis',30)->nullable(true);
            $table->string('nr_ctps',30)->nullable(true);
            $table->unsignedBigInteger('id_funcao')->nullable(true);
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
        Schema::dropIfExists('pessoas');
    }
}
