<?php

namespace App\Services;

use App\Models\Round;
use App\Models\Game;
use App\Models\Question;

class GameService
{
    public function createRound(Game $game, $team, $category_id, $difficulty)
    {
        $question = Question::where('category_id', $category_id)
            ->where('difficulty', $difficulty)
            ->inRandomOrder()
            ->first();

        return Round::create([
            'game_id' => $game->id,
            'team' => $team,
            'category_id' => $category_id,
            'question_id' => $question->id,
            'status' => 'pending',
        ]);
    }

    public function scoreRound(Round $round, $team_answer)
    {
        $correct = strtolower(trim($round->question->answer)) === strtolower(trim($team_answer));
        $round->score = $correct ? $round->question->difficulty : 0;
        $round->status = 'scored';
        $round->save();

        return $round->score;
    }
}
