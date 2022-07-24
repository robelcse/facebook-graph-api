<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransanctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transanctions', function (Blueprint $table) {
            $table->id();
            $table->string('user_paypal');
            $table->string('ig_account_owner_paypal');
            $table->string('post_id');
            $table->string('ig_account');
            $table->integer('amount');
            $table->string('transanction_id')->nullable();
            $table->integer('status')->default(0);

            $table->string('user_unique_id')->nullable();
            $table->string('ig_account_owner_unique_id')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transanctions');
    }
}
