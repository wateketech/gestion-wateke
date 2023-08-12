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
        Schema::create('contact_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->string('name');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->json('geolocation')->nullable();
            $table->string('zip_code')->nullable();
            $table->boolean('enable')->default(1);
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->constrained();
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
        Schema::dropIfExists('contact_address');
    }
};
