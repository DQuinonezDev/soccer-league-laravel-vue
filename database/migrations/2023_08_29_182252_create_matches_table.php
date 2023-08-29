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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('league_id');
            $table->foreign('league_id')->references('id')->on('leagues');
            
            $table->unsignedBigInteger('homeTeam_id');
            $table->foreign('homeTeam_id')->references('id')->on('teams');
            
            $table->unsignedBigInteger('awayTeam_id');
            $table->foreign('awayTeam_id')->references('id')->on('teams');
            
            $table->date('match_date');
            $table->time('match_time');
            
            $table->unsignedBigInteger('first_leg_id')->nullable();
            $table->foreign('first_leg_id')->references('id')->on('matches');
            

            $table->timestamps();
            $table->unique(['league_id', 'homeTeam_id', 'awayTeam_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
