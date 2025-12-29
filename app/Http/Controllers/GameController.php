<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Category;
use App\Models\Round;
use App\Services\GameService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function dashboard()
    {
        $games = Game::with('rounds')->orderByDesc('id')->get();
        return view('judge.dashboard', compact('games'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('judge.games.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judge_name' => 'required|string|max:255',
            'team_1_name' => 'required|string|max:255',
            'team_2_name' => 'required|string|max:255|different:team_1_name',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        $game = Game::create([
            'judge_name' => $validated['judge_name'],
            'team_1_name' => $validated['team_1_name'],
            'team_2_name' => $validated['team_2_name'],
            'status' => 'active',
            'current_turn' => 'team_1',
        ]);

        // Store selected categories
        $game->categories()->sync($validated['categories']);

        return redirect()->route('games.show', $game)->with('success', 'Game created successfully!');
    }

    public function show(Game $game)
    {
        $game->load(['rounds.category', 'rounds.question', 'currentRound']);
        $categories = $game->categories;
        return view('judge.games.show', compact('game', 'categories'));
    }

    public function createRound(Request $request, Game $game)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'difficulty' => 'required|in:easy,medium,hard',
        ]);

        // Use current turn
        $team = $game->current_turn;

        $round = $this->gameService->createRound(
            $game,
            $team,
            $validated['category_id'],
            $validated['difficulty']
        );

        $game->update(['current_round_id' => $round->id]);

        return redirect()->route('games.round-view', $round);
    }

    public function roundView(Round $round)
    {
        $round->load(['game', 'category', 'question']);
        return view('judge.games.round-view', compact('round'));
    }

    public function scoreRound(Request $request, Round $round)
    {
        $validated = $request->validate([
            'award_team' => 'required|in:team_1,team_2,no_one',
        ]);

        // Calculate points based on difficulty
        $difficulty_points = [
            'easy' => 1,
            'medium' => 2,
            'hard' => 3,
        ];
        $points = $difficulty_points[$round->question->difficulty] ?? 0;

        // Create a result round for the awarded team (or no one)
        if ($validated['award_team'] !== 'no_one') {
            // Create new round for the awarded team
            Round::create([
                'game_id' => $round->game_id,
                'team' => $validated['award_team'],
                'category_id' => $round->category_id,
                'question_id' => $round->question_id,
                'score' => $points,
                'status' => 'scored',
            ]);
        }

        // Mark original round as scored
        $round->update(['status' => 'scored']);

        // Switch turn to other team
        $game = $round->game;
        $nextTeam = $game->current_turn === 'team_1' ? 'team_2' : 'team_1';
        $game->update(['current_turn' => $nextTeam, 'current_round_id' => null]);

        return redirect()->route('games.show', $game)->with('success', 'Round scored!');
    }

    public function scoreboard(Game $game)
    {
        $game->load(['rounds.category', 'rounds.question']);
        return view('judge.games.scoreboard', compact('game'));
    }
}
