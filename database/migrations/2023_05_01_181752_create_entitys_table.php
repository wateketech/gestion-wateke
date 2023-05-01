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
            $table->string('alias')->nullable();
            $table->string('legal_name')->nullable();
            $table->string('comercial_name')->nullable();
            $table->text('about')->nullable();
            $table->boolean('enable')->default(1);
            $table->unsignedBigInteger('entity_type_id');
            $table->timestamps();


            $table->foreign('entity_type_id')->references('id')->on('entity_types')->constrained();
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
        Schema::dropIfExists('entitys');
    }
};
