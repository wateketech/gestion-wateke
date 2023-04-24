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
        Schema::create('user_has_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notification_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamp('viewed');
            // $table->timestamp('status');

            $table->string('about')->nullable()->default('');
            $table->timestamps();


            $table->foreign('notification_id')->references('id')->on('notifications')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->constrained();
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
        Schema::dropIfExists('user_has_notifications');
    }
};
