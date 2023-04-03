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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('description');
            $table->string('phone_number');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->string('address');
            $table->string('picture');
            $table->decimal('rating', 3, 1)->default(0.0);
            $table->unsignedBigInteger('view')->default(0);
            $table->integer('restaurant_status')->default(0);
            $table->integer('restaurant_opening_status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};
