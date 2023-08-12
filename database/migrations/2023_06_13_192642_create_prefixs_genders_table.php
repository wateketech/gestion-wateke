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
        Schema::create('prefixs_genders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('prefix_id');
            $table->timestamps();

            $table->foreign('gender_id')->references('id')->on('genders')->constrained();
            $table->foreign('prefix_id')->references('id')->on('prefixs')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prefixs_genders');
    }
};
