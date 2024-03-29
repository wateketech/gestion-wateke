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
        Schema::create('contact_date_types', function (Blueprint $table) {
            $table->id();
            $table->string('label')->unique();
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('enable')->default(1);
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
        Schema::dropIfExists('contact_date_types');
    }
};
