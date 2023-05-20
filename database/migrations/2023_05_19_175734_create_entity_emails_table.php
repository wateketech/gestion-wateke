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
        Schema::create('entity_emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('type_id');
            $table->string('value');
            $table->boolean('is_primary')->default(0);
            $table->text('about')->nullable();
            $table->boolean('enable')->default(1);
            $table->timestamps();


            $table->foreign('entity_id')->references('id')->on('entitys')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('entity_email_types')->constrained();
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
        Schema::dropIfExists('entity_emails');
    }
};
