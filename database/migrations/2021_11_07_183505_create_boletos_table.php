<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletosTable extends Migration
{
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->date('data_boleto')->nullable();
            $table->string('mensalidade')->nullable();
            $table->string('descricao_boleto')->nullable();
            $table->foreignId('id_cliente')
                ->constrained('clientes')
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
        Schema::dropIfExists('boletos');
    }
}
