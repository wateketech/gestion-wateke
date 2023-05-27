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
        Schema::create('contact_address_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id');
            $table->string('label');
            $table->string('value');
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('contact_has_address')->constrained();
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
        Schema::dropIfExists('contact_address_lines');
    }
};