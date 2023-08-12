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
        Schema::create('user_has_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamp('deaddate');
            $table->string('about')->nullable()->default('');
            $table->boolean('enable')->nullable()->default(1);
            $table->timestamps();


            $table->foreign('entity_id')->references('id')->on('entitys')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');

            $table->unique(['entity_id', 'user_id', 'deaddate']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_visits');
    }
};
