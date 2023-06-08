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
        Schema::create('contact_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('bank_id');
            $table->string('card_number');
            $table->string('card_holder');
            $table->date('expiration_date');
            $table->boolean('is_credit');
            $table->json('meta')->nullable();
            // $table->boolean('');
            // $table->boolean('');
            $table->text('about')->nullable();
            $table->boolean('enable')->default(1);
            $table->timestamps();


            $table->foreign('contact_id')->references('id')->on('contacts')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('contact_bank_account_types')->constrained();
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('contact_bank_account_banks')->constrained();
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
        Schema::dropIfExists('contact_bank_accounts');
    }
};
