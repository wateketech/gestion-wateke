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
        Schema::create('entidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direccion_id');
            $table->string('nombre');
            $table->string('num_oficina');
            $table->string('numbre_fiscal');
            $table->string('nif');
            $table->string('es_minorista');
            $table->string('es_central');
            $table->string('iata');
            $table->string('rp');
            $table->string('gds');
            $table->string('observ');

            $table->foreign('grupo_gestion_id')->references('id')->on('grupo_gestion')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('direccion_id')->references('id')->on('direccion')->constrained()
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
        Schema::dropIfExists('entidad');
    }
};
