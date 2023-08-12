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
        Schema::create('entity_instant_message_types', function (Blueprint $table) {
            $table->id();
            $table->string('label')->unique();
            $table->string('regEx')->nullable()->unique();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->string('url')->nullable();
            $table->string('about')->nullable();
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
        Schema::dropIfExists('entity_instant_message_types');
    }
};
