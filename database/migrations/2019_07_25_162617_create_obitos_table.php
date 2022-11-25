<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obitos', function (Blueprint $table) {
            $table->bigIncrements('id_obito');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_estcivil')->references('id_estcivil')->on('estcivils')->onDelete('set null');
            $table->foreign('id_cemiterio')->references('id_cemiterio')->on('cemiterios')->onDelete('set null');
            $table->foreign('id_funeraria')->references('id_funeraria')->on('funerarias')->onDelete('set null');
            $table->foreign('id_capela')->references('id_capela')->on('capelas')->onDelete('set null');
            $table->string('nr_declaracao',20);
            $table->unsignedBigInteger('id_dependente');      
            $table->string('nm_dependente',100);
            $table->date('dt_nascimento')->nullable(true);
            $table->string('st_sexo',1)->nullable(true)->default('0'); // 0-masculino/1-feminino
            $table->string('nm_cor',100)->nullable(true);
            $table->string('nr_cpfcnpj',30)->nullable(true);
            $table->string('nr_rgie',30)->nullable(true);
            $table->string('nr_telefone1',30)->nullable(true);
            $table->string('nr_telefone2',30)->nullable(true);
            $table->string('nm_profissao',100)->nullable(true);
            $table->string('nm_nacionalidade',100)->nullable(true)->default('BRASILEIRA');
            $table->string('nm_naturalidade',100)->nullable(true);   
            $table->unsignedBigInteger('id_estcivil')->nullable(true);
            $table->string('nm_endereco',100)->nullable(true);
            $table->string('nr_numender',20)->nullable(true);
            $table->string('nm_complender',100)->nullable(true);
            $table->string('nm_bairro',60)->nullable(true);
            $table->string('nm_cidade',60)->nullable(true);
            $table->string('nm_estado',2)->nullable(true);
            $table->boolean('st_bens')->nullable(true)->default(false);
            $table->boolean('st_testamento')->nullable(true)->default(false);
            $table->boolean('st_reservista')->nullable(true)->default(false);
            $table->boolean('st_eleitor')->nullable(true)->default(false);
            $table->string('nm_pai',100)->nullable(true);
            $table->string('nm_mae',100)->nullable(true);
            $table->string('nr_contrato',10)->nullable(true);
            $table->date('dt_falecimento')->nullable(true);;
            $table->time('hr_falecimento')->nullable(true);; 
            $table->string('ds_falecimento',100)->nullable(true);
            $table->date('dt_sepultamento')->nullable(true);
            $table->time('hr_sepultamento')->nullable(true);
            $table->unsignedBigInteger('id_cemiterio')->nullable(true);
            $table->unsignedBigInteger('id_tppagamentocm')->nullable(true); // tipo de pagamento do cemiterio
            $table->double('vl_despesacm')->nullable(true); // valor da despesa com o cemiterio
            $table->string('nr_chequecm',20)->nullable(true); // numero do cheque pago cemiterio            
            $table->unsignedBigInteger('id_funeraria')->nullable(true);
            $table->unsignedBigInteger('id_tppagamentofn')->nullable(true); // tipo de pagamento da funeraria
            $table->double('vl_despesafn')->nullable(true); // valor da despesa com a funeraria
            $table->string('nr_chequefn',20)->nullable(true); // numero do cheque pago a funeraria            
            $table->unsignedBigInteger('id_capela')->nullable(true); 
            $table->unsignedBigInteger('id_tppagamentocp')->nullable(true); // tipo de pagamento da capela
            $table->double('vl_despesacp')->nullable(true); // valor da despesa com a capela
            $table->string('nr_chequecp',20)->nullable(true); // numero do cheque pago a capela          
            $table->string('ds_velorio',100)->nullable(true);
            $table->boolean('st_declaobito')->nullable(true)->default(false); // declaração de obito
            $table->boolean('st_tanatopraxia')->nullable(true)->default(false); // autorização tanatopraxia
            $table->boolean('st_translado')->nullable(true)->default(false); // translado de cadaver
            $table->boolean('st_notafaleci')->nullable(true)->default(false); // nota falecimento/convite
            $table->string('nm_medico',100)->nullable(true);
            $table->string('nr_crm',20)->nullable(true);
            $table->string('nm_causamorte',100)->nullable(true);
            $table->date('dt_atendimento');
            $table->time('hr_atendimento');
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
        Schema::dropIfExists('obitos');
    }
}
