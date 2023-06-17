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
        Schema::create('entity_logos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->string('label')->nullable();
            $table->string('name');
            $table->string('store');
            $table->json('meta')->nullable();
            $table->string('label')->nullable();
            $table->boolean('is_primary')->default(0);
            $table->boolean('enable')->default(1);
            $table->timestamps();


            $table->foreign('entity_id')->references('id')->on('entitys')->constrained();
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
        Schema::dropIfExists('entity_logos');
    }
};
