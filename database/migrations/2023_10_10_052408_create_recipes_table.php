<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('recipes', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('instructions');
            $table->text('cooking_details');
            $table->string('type');
            $table->string('photo');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('category_id')->references('id')->on('categorys');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('Recipe');
    }
};
