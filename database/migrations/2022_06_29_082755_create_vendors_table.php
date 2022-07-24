<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('ig_account')->nullable();
            $table->text('access_token')->nullable();
            $table->string('facebook_email')->nullable();
            $table->string('facebook_profile_link')->nullable();
            $table->string('paypal_email')->nullable();
            $table->string('instagram_profile_link')->nullable();
            $table->integer('post_price')->nullable();
            $table->string('unique_id');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('vendors');
    }
}
