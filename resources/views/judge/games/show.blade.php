<!-- resources/views/judge/games/show.blade.php -->
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h1 class="text-4xl font-bold text-white">{{ $game->team_1_name }} vs {{ $game->team_2_name }}</h1>
                    <p class="text-blue-300 mt-2">Judge: {{ $game->judge_name }}</p>
                </div>
                <a href="{{ route('judge.dashboard') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold transition">← Back</a>
            </div>

            <!-- Live Scores -->
            <div class="grid grid-cols-2 gap-6 mb-12">
                @php
                    $team1_score = $game->rounds()->where('team', 'team_1')->sum('score');
                    $team2_score = $game->rounds()->where('team', 'team_2')->sum('score');
                    $is_team1_turn = $game->current_turn === 'team_1';
                @endphp

                <div class="rounded-2xl p-8 shadow-2xl transition transform {{ $is_team1_turn ? 'bg-gradient-to-br from-blue-500 to-blue-700 scale-105 ring-4 ring-blue-300' : 'bg-gray-800' }}">
                    <h3 class="text-xl font-semibold {{ $is_team1_turn ? 'text-white' : 'text-gray-400' }}">{{ $game->team_1_name }}</h3>
                    <p class="text-6xl font-black mt-2 {{ $is_team1_turn ? 'text-white' : 'text-gray-500' }}">{{ $team1_score }}</p>
                    <p class="mt-2 {{ $is_team1_turn ? 'text-blue-100' : 'text-gray-500' }}">{{ $game->rounds()->where('team', 'team_1')->count() }} questions</p>
                    @if($is_team1_turn)
                        <div class="mt-4 inline-block bg-white text-blue-600 px-3 py-1 rounded-full text-sm font-bold animate-pulse">
                            🎯 YOUR TURN
                        </div>
                    @endif
                </div>

                <div class="rounded-2xl p-8 shadow-2xl transition transform {{ !$is_team1_turn ? 'bg-gradient-to-br from-red-500 to-red-700 scale-105 ring-4 ring-red-300' : 'bg-gray-800' }}">
                    <h3 class="text-xl font-semibold {{ !$is_team1_turn ? 'text-white' : 'text-gray-400' }}">{{ $game->team_2_name }}</h3>
                    <p class="text-6xl font-black mt-2 {{ !$is_team1_turn ? 'text-white' : 'text-gray-500' }}">{{ $team2_score }}</p>
                    <p class="mt-2 {{ !$is_team1_turn ? 'text-red-100' : 'text-gray-500' }}">{{ $game->rounds()->where('team', 'team_2')->count() }} questions</p>
                    @if(!$is_team1_turn)
                        <div class="mt-4 inline-block bg-white text-red-600 px-3 py-1 rounded-full text-sm font-bold animate-pulse">
                            🎯 YOUR TURN
                        </div>
                    @endif
                </div>
            </div>

            <!-- Active Round Notification -->
            @if($game->currentRound && $game->currentRound->status === 'pending')
                <div class="bg-gradient-to-r from-yellow-400 to-orange-400 rounded-2xl p-6 mb-12 shadow-lg border-2 border-yellow-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-yellow-900 font-bold text-lg">⏳ Round in Progress</p>
                            <p class="text-yellow-800 mt-1">{{ $game->currentRound->category->name }} - {{ ucfirst($game->currentRound->question->difficulty) }}</p>
                        </div>
                        <a href="{{ route('games.round-view', $game->currentRound) }}" class="bg-yellow-900 text-white px-6 py-2 rounded-lg font-semibold hover:bg-yellow-800 transition">
                            Continue →
                        </a>
                    </div>
                </div>
            @endif

            <!-- Category Selection Grid -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-white mb-6">Pick Category & Difficulty</h2>
                <div class="space-y-6">
                    @foreach($categories as $category)
                        <div>
                            <h3 class="text-lg font-semibold text-blue-200 mb-3">{{ $category->name }}</h3>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach(['easy' => ['name' => 'Easy', 'color' => 'green'], 'medium' => ['name' => 'Medium', 'color' => 'yellow'], 'hard' => ['name' => 'Hard', 'color' => 'red']] as $diff => $diffData)
                                    @php
                                        $count = \App\Models\Question::where('category_id', $category->id)
                                            ->where('difficulty', $diff)->count();
                                    @endphp
                                    <form action="{{ route('games.create-round', $game) }}" method="POST" class="h-full">
                                        @csrf
                                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                                        <input type="hidden" name="difficulty" value="{{ $diff }}">

                                        <button type="submit"
                                                class="w-full h-24 rounded-xl font-bold text-lg transition transform hover:scale-105 hover:shadow-xl active:scale-95
                                            {{ $diffData['color'] === 'green' ? 'bg-gradient-to-br from-green-500 to-green-600 hover:from-green-400 hover:to-green-500 text-white' : ($diffData['color'] === 'yellow' ? 'bg-gradient-to-br from-yellow-500 to-yellow-600 hover:from-yellow-400 hover:to-yellow-500 text-white' : 'bg-gradient-to-br from-red-500 to-red-600 hover:from-red-400 hover:to-red-500 text-white') }}
                                            {{ $count === 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ $count === 0 ? 'disabled' : '' }}>
                                            <div>{{ $diffData['name'] }}</div>
                                            <div class="text-xs opacity-75 mt-1">{{ $count }} available</div>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Rounds Timeline -->
            @if($game->rounds->count() > 0)
                <div>
                    <h2 class="text-2xl font-bold text-white mb-6">Game History</h2>
                    <div class="space-y-3">
                        @foreach($game->rounds->sortByDesc('id')->take(10) as $round)
                            <div class="bg-gray-800 rounded-xl p-4 border-l-4 {{ $round->team === 'team_1' ? 'border-blue-500' : 'border-red-500' }} hover:bg-gray-700 transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-white">
                                            <span class="{{ $round->team === 'team_1' ? 'text-blue-400' : 'text-red-400' }}">
                                                {{ $round->team === 'team_1' ? $game->team_1_name : $game->team_2_name }}
                                            </span>
                                            <span class="text-gray-400 ml-2">{{ $round->category->name }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ ucfirst($round->question->difficulty) }} •
                                            {{ ucfirst($round->status) }} •
                                            {{ $round->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold {{ $round->score > 0 ? 'text-green-400' : 'text-gray-500' }}">
                                            {{ $round->score ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
