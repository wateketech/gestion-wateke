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
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->string('value');
            $table->string('about')->default(' ');
            $table->timestamp('manually_time')->default( now() );;
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->constrained();
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
        Schema::dropIfExists('user_task');
    }
};
