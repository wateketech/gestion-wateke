<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->timestamp('start');
            $table->string('longitude');
            $table->string('latitude');
            $table->timestamp('end');

            $table->string('about')->nullable()->default('');
            $table->timestamps();


            $table->foreign('visit_id')->references('id')->on('user_has_visits')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_visits');
    }
};
