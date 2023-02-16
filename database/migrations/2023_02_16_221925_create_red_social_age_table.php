<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('red_social_age', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agente_id');
            $table->string('link');
            $table->string('observ');

            $table->foreign('agente_id')->references('id')->on('agente')->constrained()
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
        Schema::dropIfExists('red_social_age');
    }
};
