<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = [
        'game_id', 'team', 'category_id', 'question_id', 'score', 'status', 'team_answer'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getTeamNameAttribute()
    {
        return $this->team === 'team_1' ? $this->game->team_1_name : $this->game->team_2_name;
    }
}
