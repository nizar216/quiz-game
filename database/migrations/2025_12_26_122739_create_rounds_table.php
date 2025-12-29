<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->enum('team', ['team_1', 'team_2']);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('question_id');
            $table->text('team_answer')->nullable();
            $table->integer('score')->nullable();
            $table->enum('status', ['pending', 'scored'])->default('pending');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rounds');
    }
};
