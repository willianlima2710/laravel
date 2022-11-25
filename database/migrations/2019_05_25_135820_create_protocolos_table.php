<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolos', function (Blueprint $table) {
            $table->bigIncrements('id_protocolo');
            $table->unsignedBigInteger('id_user')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_pessoa')->references('id_pessoa')->on('pessoas')->onDelete('cascade');
            $table->string('nr_protocolo',20)->nullable(true);
            $table->unsignedBigInteger('id_pessoa');
            $table->string('cd_pessoa',10);
            $table->string('nm_pessoa',100);
            $table->binary('nm_protocolo')->nullable(true);
            $table->date('dt_protocolo');
            $table->time('hr_protocolo');
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
        Schema::dropIfExists('protocolos');
    }
}
