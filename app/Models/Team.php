<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name'];

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function gamesAsTeam1()
    {
        return $this->hasMany(Game::class, 'team_1_id');
    }

    public function gamesAsTeam2()
    {
        return $this->hasMany(Game::class, 'team_2_id');
    }
}
