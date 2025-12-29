<!-- resources/views/judge/dashboard.blade.php -->
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Judge Dashboard</h1>
                    <p class="text-gray-600 mt-2">Manage your quiz games</p>
                </div>
                <a href="{{ route('games.create') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition transform hover:scale-105">
                    + New Game
                </a>
            </div>

            @if($games->isEmpty())
                <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">🎮</div>
                    <p class="text-gray-600 text-lg">No games yet</p>
                    <a href="{{ route('games.create') }}" class="inline-block mt-4 text-blue-600 font-semibold hover:underline">Create your first game</a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($games as $game)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                                <h3 class="text-xl font-bold text-white">{{ $game->team_1_name }} vs {{ $game->team_2_name }}</h3>
                                <p class="text-blue-100 text-sm mt-1">Judge: {{ $game->judge_name }}</p>
                            </div>

                            <div class="p-6">
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    @php
                                        $team1_score = $game->rounds()->where('team', 'team_1')->sum('score');
                                        $team2_score = $game->rounds()->where('team', 'team_2')->sum('score');
                                    @endphp
                                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                                        <p class="text-3xl font-bold text-blue-600">{{ $team1_score }}</p>
                                        <p class="text-xs text-gray-600 mt-1">{{ $game->team_1_name }}</p>
                                    </div>
                                    <div class="bg-red-50 rounded-lg p-4 text-center">
                                        <p class="text-3xl font-bold text-red-600">{{ $team2_score }}</p>
                                        <p class="text-xs text-gray-600 mt-1">{{ $game->team_2_name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mb-6 pb-6 border-b">
                                    <span class="text-sm text-gray-600">{{ $game->rounds->count() }} rounds</span>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $game->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($game->status) }}
                                    </span>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('games.show', $game) }}" class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-semibold text-center hover:bg-blue-700 transition">
                                        Play
                                    </a>
                                    <a href="{{ route('games.scoreboard', $game) }}" class="flex-1 bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-semibold text-center hover:bg-gray-300 transition">
                                        Board
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
