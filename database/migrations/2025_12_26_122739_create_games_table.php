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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('judge_name');
            $table->string('team_1_name');
            $table->string('team_2_name');
            $table->enum('status', ['active', 'completed'])->default('active');
            $table->enum('current_turn', ['team_1', 'team_2'])->default('team_1');
            $table->unsignedBigInteger('current_round_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
