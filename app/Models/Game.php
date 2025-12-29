<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'judge_name', 'team_1_name', 'team_2_name', 'status', 'current_round_id', 'current_turn'
    ];

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function currentRound()
    {
        return $this->belongsTo(Round::class, 'current_round_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getCurrentTeamNameAttribute()
    {
        return $this->current_turn === 'team_1' ? $this->team_1_name : $this->team_2_name;
    }
}
