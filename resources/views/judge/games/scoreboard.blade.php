<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-12">
                <h1 class="text-4xl font-bold text-white">Final Scoreboard</h1>
                <a href="{{ route('games.show', $game) }}"
                   class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold transition">←
                    Back</a>
            </div>

            <!-- Final Scores with Winner -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                @php
                    $team1_score = $game->rounds()->where('team', 'team_1')->sum('score');
                    $team2_score = $game->rounds()->where('team', 'team_2')->sum('score');
                    $team1_is_winner = $team1_score > $team2_score;
                    $team2_is_winner = $team2_score > $team1_score;
                @endphp

                <div
                    class="relative rounded-3xl p-10 text-white shadow-2xl {{ $team1_is_winner ? 'bg-gradient-to-br from-yellow-400 via-yellow-500 to-orange-500 ring-4 ring-yellow-300 transform scale-105' : 'bg-gradient-to-br from-blue-600 to-blue-700' }}">
                    @if($team1_is_winner)
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                            <div class="text-6xl">🏆</div>
                        </div>
                    @endif
                    <h3 class="text-3xl font-bold mb-2 {{ $team1_is_winner ? 'text-gray-900' : '' }}">{{ $game->team_1_name }}</h3>
                    <p class="text-7xl font-black mb-4 {{ $team1_is_winner ? 'text-gray-900' : '' }}">{{ $team1_score }}</p>
                    <p class="text-lg opacity-90">{{ $game->rounds()->where('team', 'team_1')->count() }} questions
                        answered</p>
                </div>

                <div
                    class="relative rounded-3xl p-10 text-white shadow-2xl {{ $team2_is_winner ? 'bg-gradient-to-br from-yellow-400 via-yellow-500 to-orange-500 ring-4 ring-yellow-300 transform scale-105' : 'bg-gradient-to-br from-red-600 to-red-700' }}">
                    @if($team2_is_winner)
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                            <div class="text-6xl">🏆</div>
                        </div>
                    @endif
                    <h3 class="text-3xl font-bold mb-2 {{ $team2_is_winner ? 'text-gray-900' : '' }}">{{ $game->team_2_name }}</h3>
                    <p class="text-7xl font-black mb-4 {{ $team2_is_winner ? 'text-gray-900' : '' }}">{{ $team2_score }}</p>
                    <p class="text-lg opacity-90">{{ $game->rounds()->where('team', 'team_2')->count() }} questions
                        answered</p>
                </div>
            </div>

            <!-- Detailed Rounds Table -->
            <div class="bg-gray-800 rounded-3xl shadow-2xl overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-gray-700 to-gray-800 border-b border-gray-600">
                    <h2 class="text-2xl font-bold text-white">All Rounds</h2>
                </div>

                @if($game->rounds->isEmpty())
                    <p class="text-center text-gray-400 py-16 text-lg">No rounds played yet</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-700 border-b border-gray-600">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    #
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    Team
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    Difficulty
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    Question
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    Score
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                            @foreach($game->rounds as $round)
                                <tr class="hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-300">#{{ $round->id }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold">
                                            <span
                                                class="{{ $round->team === 'team_1' ? 'text-blue-400' : 'text-red-400' }}">
                                                {{ $round->team === 'team_1' ? $game->team_1_name : $game->team_2_name }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-300">{{ $round->category->name }}</td>
                                    <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                                {{ $round->question->difficulty === 'easy' ? 'bg-green-900 text-green-300' : ($round->question->difficulty === 'medium' ? 'bg-yellow-900 text-yellow-300' : 'bg-red-900 text-red-300') }}">
                                                {{ ucfirst($round->question->difficulty) }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-400 max-w-xs truncate">{{ $round->question->content }}</td>
                                    <td class="px-6 py-4 text-center text-sm font-bold">
                                        @if($round->status === 'scored')
                                            <span
                                                class="text-lg {{ $round->score > 0 ? 'text-green-400' : 'text-gray-500' }}">{{ $round->score }}</span>
                                        @else
                                            <span class="text-gray-600">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                                {{ $round->status === 'scored' ? 'bg-green-900 text-green-300' : 'bg-yellow-900 text-yellow-300' }}">
                                                {{ ucfirst($round->status) }}
                                            </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
