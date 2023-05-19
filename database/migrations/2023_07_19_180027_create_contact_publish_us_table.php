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
        Schema::create('contact_publish_us', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('type_id');
            $table->string('value');
            $table->text('about')->nullable();
            $table->boolean('enable')->default(1);
            $table->timestamps();


            $table->foreign('contact_id')->references('id')->on('contacts')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('contact_publish_us_types')->constrained();
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
        Schema::dropIfExists('contact_publish_us');
    }
};