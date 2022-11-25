<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCemiteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cemiterios', function (Blueprint $table) {
            $table->bigIncrements('id_cemiterio');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('nm_cemiterio',100);            
            $table->string('nm_endereco',100)->nullable(true);            
            $table->string('nr_numender',20)->nullable(true);
            $table->string('nm_bairro',60)->nullable(true);
            $table->string('nm_cidade',60)->nullable(true);
            $table->string('nm_estado',2)->nullable(true);      
            $table->string('nr_telefone',30)->nullable(true);    
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
        Schema::dropIfExists('cemiterios');
    }
}
