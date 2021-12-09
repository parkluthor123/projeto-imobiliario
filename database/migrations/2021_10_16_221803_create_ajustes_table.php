<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjustesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajustes', function (Blueprint $table) {
            $table->id();
            $table->string('footer_num1')->nullable();
            $table->string('footer_num2')->nullable();
            $table->string('topbar_num')->nullable();
            $table->string('instagram_title')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook_title')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin_title')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('email')->nullable();
            $table->string('endereco')->nullable();
            $table->longText('iframe')->nullable();
            $table->string('link_endereco')->nullable();
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
        Schema::dropIfExists('ajustes');
    }
}
