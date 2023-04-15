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
        Schema::create('entitys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('office_num');
            $table->string('legal_name');
            $table->boolean('is_mainoffice');
            $table->boolean('is_retail');
            // $table->unsignedBigInteger('grupo_gestion_id')->default(0);
            // $table->unsignedBigInteger('direccion_id');
            // $table->unsignedBigInteger('gds_id');
            $table->string('nif')->default(' ');
            $table->string('iata')->default(' ');
            $table->string('rp')->default(' ');
            $table->string('about')->default(' ');
            $table->string('enable')->default(true);

            // $table->foreign('grupo_gestion_id')->references('id')->on('grupo_gestion')->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            // $table->foreign('direccion_id')->references('id')->on('direccion')->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            // $table->foreign('gds_id')->references('id')->on('gds')->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

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
        Schema::dropIfExists('entitys');
    }
};
