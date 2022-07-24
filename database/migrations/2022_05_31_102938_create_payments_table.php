<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_paypal')->nullable();
            $table->string('admin_paypal')->nullable();
            $table->string('amount')->nullable();
            $table->string('post_id')->nullable();
            $table->string('ig_account')->nullable();

            $table->string('user_unique_id')->nullable();
            $table->string('vendor_unique_id')->nullable();
            $table->string('admin_unique_id')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
