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
        Schema::create('contacts_has_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('contact_groups')->constrained();
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
        Schema::dropIfExists('contacts_has_groups');
    }
};
