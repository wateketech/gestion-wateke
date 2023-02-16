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
        Schema::create('telefono_ent', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entidad_id');
            $table->string('telefono');
            $table->string('observ');

            $table->foreign('entidad_id')->references('id')->on('entidad')->constrained()
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
        Schema::dropIfExists('telefono_ent');
    }
};
