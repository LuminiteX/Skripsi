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
        Schema::create('tables', function (Blueprint $table) {
            // $table->id();
            // $table->string('name');
            // $table->integer('guest_number');
            // $table->string('status')->default('available');
            // $table->string('location');
            // $table->timestamps();

            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->string('name');
            $table->integer('guest_number');
            $table->string('status')->default('available');
            $table->string('location');
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
};
