<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovels', function (Blueprint $table) {
            $table->id();
            $table->string("nome")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("cpf")->nullable();
            $table->string("endereco")->nullable();
            $table->string("cep")->nullable();
            $table->string("num")->nullable();
            $table->string("cidade")->nullable();
            $table->string("metros_quadrados")->nullable();
            $table->integer("qtd_quartos")->nullable();
            $table->string("valor")->nullable();
            $table->string("url_imovel")->nullable();
            $table->longText("descricao")->nullable();
            $table->string("status")->nullable();
            $table->string("link_map")->nullable();
            $table->longText("sobre")->nullable();
            $table->foreignId('id_estados')
                ->constrained('estados')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('id_bairros')
                ->constrained('bairros')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('id_tipo_imovel')
                ->constrained('tipo_imovels')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('imovels');
    }
}
