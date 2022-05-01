<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros', function (Blueprint $table) {
            $table->bigIncrements('idparametro');
            $table->uuid('uuid');
            $table->bigInteger('idempresa')->nullable()->comment('ID da Empresa, caso nulo é um parametro Geral');
            $table->string('parametro')->comment('Nome unico do Parametro EX: EMAIL_HOST');
            $table->string('descricao')->comment('Descricao do Perfil: Ex. Host do Email');
            $table->string('valor')->nullable()->comment('Valor do parametro Ex: mail.hostmail.com');
            $table->string('comentario')->nullable()->comment('Uma Descrição Explicando o Paramentro');
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
        Schema::dropIfExists('parametros');
    }
}
