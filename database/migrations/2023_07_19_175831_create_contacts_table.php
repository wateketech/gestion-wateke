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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->nullable();
            $table->string('name');
            $table->string('middle_name')->nullable();
            $table->string('first_lastname')->nullable();
            $table->string('second_lastname')->nullable();
            $table->unsignedBigInteger('prefix_id')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->text('about')->nullable();
            $table->json('meta')->nullable();

            $table->boolean('enable')->default(1);
            $table->boolean('locked')->default(0);
            $table->boolean('is_editing')->default(0);
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->boolean('busy')->default(0);
            $table->json('busy_by')->nullable();
            $table->timestamps();

            $table->foreign('prefix_id')->references('id')->on('prefixs')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');

            $table->foreign('edited_by')->references('id')->on('users')->constrained();
            $table->foreign('created_by')->references('id')->on('users')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
