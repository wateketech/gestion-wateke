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
        Schema::create('entity_bank_account_types', function (Blueprint $table) {
            $table->id();
            $table->string('label')->unique();
            $table->string('img')->nullable();
            $table->string('color')->nullable();
            $table->json('regEx')->nullable();
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
        Schema::dropIfExists('entity_bank_account_types');
    }
};
