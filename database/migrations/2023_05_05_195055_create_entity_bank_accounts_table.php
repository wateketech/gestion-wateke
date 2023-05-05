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
        Schema::create('entity_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('bank_id');
            $table->integer('card_number');
            $table->string('card_holder');
            $table->date('expiration_date');
            $table->boolean('is_credit');
            $table->text('about')->nullable();
            $table->boolean('enable');
            $table->timestamps();


            $table->foreign('entity_id')->references('id')->on('entitys')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('entity_bank_account_types')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('entity_bank_account_banks')->constrained();
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
        Schema::dropIfExists('entity_bank_accounts');
    }
};
