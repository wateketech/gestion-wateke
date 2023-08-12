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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->boolean('is_html')->default(0);
            $table->text('message');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('frequency_id');
            $table->unsignedBigInteger('priority_id');
            $table->boolean('is_persistent')->default(0);
            $table->timestamp('deaddate');
            $table->timestamp('redirect')->nullable();
            $table->boolean('enable')->default(1);
            $table->timestamps();
            $table->json('meta')->nullable();


            $table->foreign('type_id')->references('id')->on('notification_types')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('frequency_id')->references('id')->on('notification_frequencys')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('priority_id')->references('id')->on('notification_prioritys')->constrained();
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
        Schema::dropIfExists('notifications');
    }
};
