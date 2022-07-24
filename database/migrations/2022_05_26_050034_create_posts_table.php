<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->text('content')->nullable();
           
            $table->string('image_flug')->nullable();
            $table->string('content_flug')->nullable();
            $table->boolean('status')->default(false);

            $table->string('ig_account')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
