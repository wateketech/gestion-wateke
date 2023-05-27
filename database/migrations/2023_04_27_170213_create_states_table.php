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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("country_id");
            $table->string("country_code")->nullable();
            $table->string("country_name")->nullable();
            $table->string("state_code")->nullable();
            $table->string("type")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
};
