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
        Schema::create('role_has_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('role_id');
            $table->string('about')->default(' ');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->constrained();
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
        Schema::dropIfExists('role_has_tasks');
    }
};
